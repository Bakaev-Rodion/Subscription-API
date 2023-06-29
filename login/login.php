<?php

require '../db/User.php';
header('Content-Type: application/json; charset=utf-8');

if($_POST['username']&&$_POST['password']){
    $userInfo = User::login($_POST['username'],$_POST['password']);
    if($userInfo){
        echo json_encode(array('message'=>'Success','jwt'=>$userInfo['jwt']));
    }
    else{
        echo json_encode(array('error'=>'Auth error'));
    }
}
else{
    echo json_encode(array('error'=>'Input data error'));
}
