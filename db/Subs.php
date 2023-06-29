<?php
require_once 'Connect.php';

class Subs extends Connect
{

    static function create($name,$cost,$publications){
        $pdo=parent::connect();
        if (!self::existByName($name)) {
            $stmt = $pdo->prepare('INSERT INTO `subs`(`name`, `cost`, `publications`) VALUES (:name,:cost,:publications);');
            return $stmt->execute(array(':name' => $name, ':cost' => $cost, ':publications' => $publications));
        }
        return false;
    }

    static function getAll($active=null){   // true if want to see only active
        $pdo=parent::connect();
        $cond = null;
        if($active===true)
            $cond = " WHERE active = 1";
        $stmt= $pdo->prepare('SELECT * FROM subs'.$cond);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static function getCurrent($jwt){
        $pdo=parent::connect();
        $stmt= $pdo->prepare('SELECT subs.* FROM users RIGHT JOIN subs ON users.active_sub=subs.id WHERE users.jwt=:jwt');
        $stmt->execute(array(':jwt'=>$jwt));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static function getById($id){
        $pdo=parent::connect();
        $stmt= $pdo->prepare('SELECT * FROM subs WHERE id=:id');
        $stmt->execute(array(':id'=>$id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private static function existByName($name){
        $pdo=parent::connect();
        $stmt= $pdo->prepare('SELECT * FROM `subs` WHERE name=:name;');
        $stmt->execute(array(':name'=>$name));
        if(!empty($stmt->fetchAll(PDO::FETCH_ASSOC))) return true;
        return false;
    }
    private static function existById($id){
        $pdo=parent::connect();
        $stmt= $pdo->prepare('SELECT * FROM `subs` WHERE id=:id;');
        $stmt->execute(array(':id'=>$id));
        if(!empty($stmt->fetchAll(PDO::FETCH_ASSOC))) return true;
        return false;
    }
    static function update($id, $name,$cost,$publications){
        $pdo=parent::connect();
        if (self::existById($id)) {
            $stmt = $pdo->prepare('UPDATE `subs` SET `name` = :name, `cost` = :cost, `publications` = :publications WHERE `subs`.`id` = :id;');
            return $stmt->execute(array(':id'=>$id,':name' => $name, ':cost' => $cost, ':publications' => $publications));
        }
        return false;
    }
    static function delete($id){
        $pdo=parent::connect();
        $stmt = $pdo->prepare('UPDATE `subs` SET `active`=0 WHERE `subs`.`id` = :id;');
        return $stmt->execute(array(':id'=>$id));

    }
    static function restore($id){
        $pdo=parent::connect();
        $stmt = $pdo->prepare('UPDATE `subs` SET `active`=1 WHERE `subs`.`id` = :id;');
        return $stmt->execute(array(':id'=>$id));

    }
}