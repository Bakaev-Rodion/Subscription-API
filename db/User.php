<?php
require_once 'Connect.php';
class User extends Connect
{
    static function login($username,$password){         // for user authorization process
        $pdo=parent::connect();
        $stmt= $pdo->prepare('SELECT * FROM users WHERE username=:username AND password=:password');
        $stmt->execute(array(':username'=>$username,':password'=>md5($password)));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static function check($jwt){                       // for check is user authorized
        $pdo=parent::connect();
        $stmt= $pdo->prepare('SELECT * FROM users WHERE jwt=:jwt');
        $stmt->execute(array(':jwt'=>$jwt));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static function activate($subId,$publications,$userId,$date){
        $pdo=parent::connect();
        $stmt = $pdo->prepare('UPDATE `users` SET `active_sub` = :subId, `publications_left` = :publications,`bought_at`=:date WHERE id = :userId;');
        return $stmt->execute(array(':subId'=>$subId,':userId' => $userId, ':publications' => $publications,':date'=>$date));

    }
    static function hasPermission($user){
        if(!(strtotime($user['bought_at'])>=strtotime('-1 month'))) {
            $pdo=parent::connect();
            $stmt = $pdo->prepare('UPDATE `users` SET `active_sub` = NULL, `publications_left` = 0,`bought_at`=NULL WHERE id = :userId;');
            $stmt->execute(array(':userId'=>$user['id']));
            return false;
        }
        if($user['publications_left']<1) return false;
        return true;
    }
}
