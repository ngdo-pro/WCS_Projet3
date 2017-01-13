<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 10/01/17
 * Time: 06:09
 */

namespace SogenactifBundle\Controller;


use AppBundle\Entity\Baptism;
use AppBundle\Entity\BaptismHasUser;
use AppBundle\Entity\Payment;
use SogenactifBundle\Entity\Transaction;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TransactionController extends Controller
{
    /**
     * This action is building sogenactif's request and sending it through src/SogenactifBundle/Api/bin/request
     * French comments are api's
     * Payments means are displayed through the view, click on them will move User to Sogenactif's payment page
     * 
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sendingAction(Request $request){

        $projectPath    = $this->getParameter('project_path');
        $pathfilePath   = $projectPath . 'src/SogenactifBundle/Api/params/pathfile';
        $requestPath    = $projectPath . 'src/SogenactifBundle/Api/bin/request';
        $merchantId     = $this->getParameter('merchant_id');
        $merchantCountry= $this->getParameter('merchant_country');
        $currencyCode   = $this->getParameter('currency_code');
        $responseUrl    = $this->generateUrl('sogenactif_response', array(), true);
        $session        = $request->getSession();

        /** @var Transaction $transaction */
        $transaction    = $session->get("transaction");

        $transactionId  = $transaction->getId();
        $amount         = $transaction->getAmount();
        $customerId     = $transaction->getCustomerId();
        $customerEmail  = $transaction->getCustomerEmail();

        $parm           ="merchant_id=$merchantId";
        $parm           ="$parm merchant_country=$merchantCountry";
        $parm           ="$parm amount=$amount";
        $parm           ="$parm currency_code=$currencyCode";
        $parm           ="$parm pathfile=$pathfilePath";
        $parm           ="$parm transaction_id=$transactionId";

        //		Affectation dynamique des autres paramètres
        // 		Les valeurs proposées ne sont que des exemples
        // 		Les champs et leur utilisation sont expliqués dans le Dictionnaire des données
        //
        $parm           ="$parm normal_return_url=$responseUrl";
        $parm           ="$parm cancel_return_url=$responseUrl";
        $parm           ="$parm automatic_response_url=$responseUrl";
        //		$parm="$parm language=fr";
        $parm           ="$parm payment_means=CB,2,VISA,2,MASTERCARD,2";
        //		$parm="$parm header_flag=no";
        //		$parm="$parm capture_day=";
        //		$parm="$parm capture_mode=";
        //		$parm="$parm bgcolor=";
        //		$parm="$parm block_align=";
        //		$parm="$parm block_order=";
        //		$parm="$parm textcolor=";
        //		$parm="$parm receipt_complement=";
        //		$parm="$parm caddie=mon_caddie";
        $parm           ="$parm customer_id=$customerId";
        $parm           ="$parm customer_email=$customerEmail";
        //		$parm="$parm customer_ip_address=";
        //		$parm="$parm data=";
        //		$parm="$parm return_context=";
        //		$parm="$parm target=";
        //		$parm="$parm order_id=";


        //		Les valeurs suivantes ne sont utilisables qu'en pré-production
        //		Elles nécessitent l'installation de vos fichiers sur le serveur de paiement
        //
        // 		$parm="$parm normal_return_logo=";
        // 		$parm="$parm cancel_return_logo=";
        // 		$parm="$parm submit_logo=";
        // 		$parm="$parm logo_id=";
        // 		$parm="$parm logo_id2=";
        // 		$parm="$parm advert=";
        // 		$parm="$parm background_id=";
        // 		$parm="$parm templatefile=";

        $path_bin       = "$requestPath";

        //	Appel du binaire request
        // La fonction escapeshellcmd() est incompatible avec certaines options avancées
        // comme le paiement en plusieurs fois qui nécessite  des caractères spéciaux
        // dans le paramètre data de la requête de paiement.
        // Dans ce cas particulier, il est préférable d.exécuter la fonction escapeshellcmd()
        // sur chacun des paramètres que l.on veut passer à l.exécutable sauf sur le paramètre data.
        $parm           = escapeshellcmd($parm);
        $result         = exec("$path_bin $parm");

        //	sortie de la fonction : $result=!code!error!buffer!
        //	    - code=0	: la fonction génère une page html contenue dans la variable buffer
        //	    - code=-1 	: La fonction retourne un message d'erreur dans la variable error

        //On separe les differents champs et on les met dans une variable array

        $array        = explode ("!", "$result");

        //	récupération des paramètres

        $message        = $array[3];

        return $this->render("sogenactif/transaction/payment.html.twig", array(
            'message' => $message
        ));
    }

    /**
     * This action is triggered in 2 differents ways :
     * - User come back to website after his payment has succeeded or failed
     * - User never comes back to website after his payment (connection lost, window closed, etc...)
     *
     * responseAction will update database to reflect the success or failure of the payment
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function responseAction(Request $request){

        $projectPath        = $this->getParameter('project_path');
        $pathfilePath       = $projectPath . 'src/SogenactifBundle/Api/params/pathfile';
        $responsePath       = $projectPath . 'src/SogenactifBundle/Api/bin/response';
        /** data sent by the Api */
        $data               = $request->request->get('DATA');

        $message            = "message=$data";
        $pathfile           = "pathfile=$pathfilePath";
        $path_bin           = "$responsePath";

        // Appel du binaire response
        $message            = escapeshellcmd($message);
        $result             = exec("$path_bin $pathfile $message");

        $array            = explode ("!", $result);

        $em = $this->getDoctrine()->getManager();

        /** @var Transaction $transaction */
        $transaction = $em->getRepository("SogenactifBundle:Transaction")->find($array[6]);
        /** array details can be found in TransactionRepository */
        $transaction = $em->getRepository("SogenactifBundle:Transaction")->update($transaction, $array);

        $em->persist($transaction);

        /** @var Payment $payment */
        $payment = $transaction->getPayment();
        /** @var BaptismHasUser $baptismHasUser */
        $baptismHasUser = $payment->getBaptismHasUser();
        /** @var Baptism $baptism */
        $baptism = $baptismHasUser->getBaptism();

        /**
         * If payment is successful :
         *     - payment is confirmed
         *     - baptism is set to :
         *         - "open" if there is still places
         *         - "closed" if it was the last place
         *     - message passed to view is set to "true"
         * Else :
         *     - payment is cancelled
         *     - baptismHasUser is removed
         *     - If someone else is participating to the baptism :
         *         - Places come back to original count
         *     - Else :
         *         - baptism is removed
         *     - message passed to view is set to "false"
         */

        /**
         * $array[11] is the bank response code, if :
         *     - 00 : payment has succeeded
         *     - 05 : payment has failed
         *     - 17 : payment has been cancelled
         */
        if("00" === $array[11]){
            $payment->setStatus("confirmed");
            if($baptism->getPlaces() > 0){
                $baptism->setStatus("open");
            }else{
                $baptism->setStatus("closed");
            }
            $em->persist($baptism);
            $transactionStatusMessage = true;
        }else{
            $payment->setStatus("cancelled");
            $payment->setBaptismHasUser(null);
            $em->remove($baptismHasUser);
            $baptismHasUserCount = $em->getRepository("AppBundle:BaptismHasUser")->findOtherByBaptism($baptism);
            /** Since $baptismHasUser remove has not been flush, need to decrement it once */
            $baptismHasUserCount--;
            if ($baptismHasUserCount === 0){
                $em->remove($baptism);
            }else{
                $baptism->setPlaces($baptism->getPlaces()+1);
            }
            $transactionStatusMessage = false;
        }
        $em->persist($payment);

        $em->flush();

        return $this->render("sogenactif/transaction/response.html.twig", array(
            'message'   => $transactionStatusMessage
        ));
    }
}