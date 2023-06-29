<?php
require_once 'Connect.php';
class Payment extends Connect
{
    static function create($paymentID,$token,$payerID,$userId,$subId,$cost,$date){
        $pdo=parent::connect();
        $stmt = $pdo->prepare('INSERT INTO `payments`(`payment_id`, `token`, `payerID`, `user_id`, `sub_id`, `cost`, `date`) 
                                VALUES (:paymentID,:token,:payerID,:userId,:subId,:cost,:date);');
        $stmt->execute(array(':paymentID'=>$paymentID,':token'=>$token,':payerID'=>$payerID,':userId'=>$userId,':subId'=>$subId,':cost'=>$cost,':date'=>$date));
    }


}