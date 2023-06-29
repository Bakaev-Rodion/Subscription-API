<?php
require_once 'Connect.php';

class Publication extends Connect
{
    static function getAll(){
        $pdo=parent::connect();
        $stmt= $pdo->prepare('SELECT * FROM publications');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    static function create($title,$text,$jwt,$userId){
        if (self::exist($title)&&self::getAmount($jwt)) {
            $pdo=parent::connect();
            $stmt = $pdo->prepare('INSERT INTO `publications`(`title`, `text`,`user_id`) VALUES (:title,:text,:userId);');
            if ($stmt->execute(array(':title' => $title, ':text' => $text, ':userId' => $userId))) {
                if (self::changeAmount($jwt)) return true;
            }
        }
        return false;
    }
    private static function exist($title){
        $pdo=parent::connect();
        $stmt= $pdo->prepare('SELECT * FROM `publications` WHERE title=:title;');
        $stmt->execute(array(':title'=>$title));
        if(empty($stmt->fetchAll(PDO::FETCH_ASSOC))) return true;
        return false;
    }

    private static function changeAmount($jwt){
        $pdo=parent::connect();
        $stmt= $pdo->prepare('UPDATE `users` SET `publications_left` = publications_left-1 WHERE jwt = :jwt;');
        return $stmt->execute(array(':jwt'=>$jwt));
    }

    private static function getAmount($jwt){
        $pdo=parent::connect();
        $stmt= $pdo->prepare('SELECT `publications_left` FROM `users` WHERE jwt = :jwt;');
        $stmt->execute(array(':jwt'=>$jwt));
        if($stmt->fetch(PDO::FETCH_ASSOC)['publications_left']>0) return true;
        return false;
    }
}