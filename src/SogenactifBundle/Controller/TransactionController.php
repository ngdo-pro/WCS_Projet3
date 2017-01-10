<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 10/01/17
 * Time: 06:09
 */

namespace SogenactifBundle\Controller;


use AppBundle\Entity\Price;
use SogenactifBundle\Entity\Transaction;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

class TransactionController extends Controller
{
    public function sendingAction(Request $request){

        $projectPath    = $this->getParameter('project_path');
        $pathfilePath   = $projectPath . 'src/SogenactifBundle/Api/params/pathfile';
        $requestPath    = $projectPath . 'src/SogenactifBundle/Api/bin/request';
        $merchantId     = $this->getParameter('merchant_id');
        $merchantCountry= $this->getParameter('merchant_country');
        $currencyCode   = $this->getParameter('currency_code');
        $normalUrl = $this->generateUrl('sogenactif_normal', array(), true);
        $session = $request->getSession();

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
        $parm="$parm normal_return_url=$normalUrl";
        $parm="$parm cancel_return_url=$normalUrl";
        //		$parm="$parm automatic_response_url=http://www.maboutique.fr/cgi-bin/call_autoresponse.php";
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


        //		insertion de la commande en base de données (optionnel)
        //		A développer en fonction de votre système d'information

        // Initialisation du chemin de l'executable request (à modifier)
        // ex :
        // -> Windows : $path_bin = "c:/repertoire/bin/request.exe";
        // -> Unix    : $path_bin = "/home/repertoire/bin/request";
        //

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

        //On separe les differents champs et on les met dans une variable tableau

        $tableau        = explode ("!", "$result");

        //	récupération des paramètres

        $code           = $tableau[1];
        $error          = $tableau[2];
        $message        = $tableau[3];

        return $this->render("sogenactif/index.html.twig", array(
            'code' => $code,
            'error' => $error,
            'message' => $message
        ));
    }

    public function normalResponseAction(Request $request){

        $projectPath        = $this->getParameter('project_path');
        $pathfilePath       = $projectPath . 'src/SogenactifBundle/Api/params/pathfile';
        $responsePath       = $projectPath . 'src/SogenactifBundle/Api/bin/response';
        $data               = $request->request->get('DATA');

        $message            = "message=$data";
        $pathfile           = "pathfile=$pathfilePath";
        $path_bin           = "$responsePath";

        // Appel du binaire response
        $message            = escapeshellcmd($message);
        $result             = exec("$path_bin $pathfile $message");

        $tableau            = explode ("!", $result);
var_dump($tableau);
        $em = $this->getDoctrine()->getManager();

        /** @var Transaction $transaction */
        $transaction = $em->getRepository("SogenactifBundle:Transaction")->find($tableau[6]);
        $transaction->setAuthorisationId($tableau[13]);
        $transaction->setBankResponseCode($tableau[18]);
        $transaction->setCaddie($tableau[22]);
        $transaction->setCaptureDay($tableau[30]);
        $transaction->setCaptureMode($tableau[31]);
        $transaction->setCardNumber($tableau[15]);
        $transaction->setCardValidity($tableau[36]);
        $transaction->setCode($tableau[1]);
        $transaction->setComplementaryCode($tableau[19]);
        $transaction->setComplementaryInfo($tableau[20]);
        $transaction->setCustomerIpAddress($tableau[29]);
        $transaction->setCvvFlag($tableau[16]);
        $transaction->setCvvResponseCode($tableau[17]);
        $transaction->setData($tableau[32]);
        $transaction->setError($tableau[2]);
        $transaction->setLanguage($tableau[25]);
        $transaction->setMerchantCountry($tableau[4]);
        $transaction->setMerchantId($tableau[3]);
        $transaction->setMerchantLanguage($tableau[24]);
        $transaction->setOrderId($tableau[27]);
        $transaction->setOrderValidity($tableau[33]);
        $transaction->setPaymentCertificate($tableau[12]);
        $transaction->setPaymentDate(\DateTime::createFromFormat('Ymd', $tableau[10]));
        $transaction->setPaymentMeans($tableau[7]);
        $transaction->setReceiptComplement($tableau[23]);
        $transaction->setResponseCode($tableau[11]);
        $transaction->setReturnContext($tableau[21]);
        $transaction->setScoreColor($tableau[38]);
        $transaction->setScoreInfo($tableau[39]);
        $transaction->setScoreProfile($tableau[41]);
        $transaction->setScoreThreshold($tableau[40]);
        $transaction->setScoreValue($tableau[37]);
        $transaction->setStatementReference($tableau[35]);
        $transaction->setTransactionCondition($tableau[34]);
        $transaction->setTransmissionDate(\DateTime::createFromFormat('YmdHis', $tableau[8]));
        $transaction->setUpdated(new \DateTime());

        $em->persist($transaction);
        $em->flush();

        return $this->render("sogenactif/index.html.twig", array(
            'tableau'   => $tableau,
            'message'   => $message,
            'code'      => $tableau[1],
            'error'     => $tableau[2]
        ));
    }
}