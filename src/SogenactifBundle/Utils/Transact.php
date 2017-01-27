<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 27/01/17
 * Time: 07:15
 */

namespace SogenactifBundle\Utils;


use SogenactifBundle\Entity\Transaction;

class Transact
{
    public function request(Transaction $transaction, $requestParams)
    {
        $pathfilePath = $requestParams['pathfilePath'];
        $requestPath = $requestParams['requestPath'];
        $merchantId = $requestParams['merchantId'];
        $merchantCountry = $requestParams['merchantCountry'];
        $currencyCode = $requestParams['currencyCode'];
        $responseUrl = $requestParams['responseUrl'];

        $transactionId = $transaction->getId();
        $amount = $transaction->getAmount();
        $customerId = $transaction->getCustomerId();
        $customerEmail = $transaction->getCustomerEmail();

        $parm = "merchant_id=$merchantId";
        $parm = "$parm merchant_country=$merchantCountry";
        $parm = "$parm amount=$amount";
        $parm = "$parm currency_code=$currencyCode";
        $parm = "$parm pathfile=$pathfilePath";
        $parm = "$parm transaction_id=$transactionId";

        //		Affectation dynamique des autres paramètres
        // 		Les valeurs proposées ne sont que des exemples
        // 		Les champs et leur utilisation sont expliqués dans le Dictionnaire des données
        //
        $parm = "$parm normal_return_url=$responseUrl";
        $parm = "$parm cancel_return_url=$responseUrl";
        $parm = "$parm automatic_response_url=$responseUrl";
        //		$parm="$parm language=fr";
        $parm = "$parm payment_means=CB,2,VISA,2,MASTERCARD,2";
        //		$parm="$parm header_flag=no";
        //		$parm="$parm capture_day=";
        //		$parm="$parm capture_mode=";
        //		$parm="$parm bgcolor=";
        //		$parm="$parm block_align=";
        //		$parm="$parm block_order=";
        //		$parm="$parm textcolor=";
        //		$parm="$parm receipt_complement=";
        //		$parm="$parm caddie=mon_caddie";
        $parm = "$parm customer_id=$customerId";
        $parm = "$parm customer_email=$customerEmail";
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

        $path_bin = "$requestPath";

        //	Appel du binaire request
        // La fonction escapeshellcmd() est incompatible avec certaines options avancées
        // comme le paiement en plusieurs fois qui nécessite  des caractères spéciaux
        // dans le paramètre data de la requête de paiement.
        // Dans ce cas particulier, il est préférable d.exécuter la fonction escapeshellcmd()
        // sur chacun des paramètres que l.on veut passer à l.exécutable sauf sur le paramètre data.
        $parm = escapeshellcmd($parm);
        $result = exec("$path_bin $parm");

        //	sortie de la fonction : $result=!code!error!buffer!
        //	    - code=0	: la fonction génère une page html contenue dans la variable buffer
        //	    - code=-1 	: La fonction retourne un message d'erreur dans la variable error

        //On separe les differents champs et on les met dans une variable array

        $array = explode("!", "$result");

        //	récupération des paramètres

        $message = $array[3];

        return $message;
    }
}