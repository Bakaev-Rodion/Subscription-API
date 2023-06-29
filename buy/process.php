<?php
require_once '../db/Payment.php';
require_once '../db/User.php';
require_once '../db/Subs.php';
require_once 'PayPal.php';

if(!empty($_GET['paymentID'])&&!empty($_GET['token'])&&!empty($_GET['payerID'])&&!empty($_GET['sid'])&&!empty($_GET['uid'])){
    $paypal = new Paypal;
    $subInfo=Subs::getById($_GET['sid']);
    $paymentCheck = $paypal->validate($_GET['paymentID'], $_GET['token'],$_GET['payerID'], $_GET['sid']);
    if($paymentCheck && $paymentCheck->state == 'approved'){
        $date = date('Y-m-d H:i:s');
        User::activate($subInfo['id'],$subInfo['publications'],$_GET['uid'],$date);
        Payment::create($_GET['paymentID'],$_GET['token'],$_GET['payerID'],$_GET['uid'],$_GET['sid'],$subInfo['cost'],date('Y-m-d H:i:s'));
        echo json_encode(array('message'=>'Success'));
    }
    else{
        echo json_encode(array('message'=>'Something went wrong'));
    }
}