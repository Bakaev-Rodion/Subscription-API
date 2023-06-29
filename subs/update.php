<?php
require_once '../db/Subs.php';
require_once '../db/User.php';

header('Content-Type: application/json; charset=utf-8');

if(!empty($_POST['id'])&&!empty($_POST['name'])&&!empty($_POST['cost'])&&!empty($_POST['publications'])&&!empty($_POST['jwt'])){
    $user=User::check($_POST['jwt']);
    if(!empty($user)&&$user['admin']){
        if(Subs::update($_POST['id'],$_POST['name'],round($_POST['cost'],2),$_POST['publications'])) {
            echo json_encode(array('Success' => 'Success'));
        }
        else{
            echo json_encode(array('error'=>'Something went wrong :( Maybe you input something  wrong'));
        }
    }
    else{
        echo json_encode(array('error'=>'Access denied'));
    }
}
else{
    echo json_encode(array('error'=>'Some of your data are incorrect'));
}