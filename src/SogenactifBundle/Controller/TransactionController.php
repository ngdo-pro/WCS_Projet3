<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 10/01/17
 * Time: 06:09
 */

namespace SogenactifBundle\Controller;


use AppBundle\Entity\Price;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\User;

class TransactionController extends Controller
{
    public function sendingAction(Price $price, User $user){

    }
}