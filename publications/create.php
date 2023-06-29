<?php
require_once '../db/Publication.php';
require_once '../db/User.php';
header('Content-Type: application/json; charset=utf-8');

if(!empty($_POST['title'])&&!empty($_POST['text'])&&!empty($_POST['jwt'])){
    $user=User::check($_POST['jwt']);
    if(!empty($user)){
        if(User::hasPermission($user)){
            if(Publication::create($_POST['title'],$_POST['text'],$_POST['jwt'],$user['id'])) {
                echo json_encode(array('Success' => 'Success'));
            }
            else {
                echo json_encode(array('error' => 'Something went wrong :( Maybe you input something  wrong or publication already exist'));
            }
        }
        else{
            echo json_encode(array('error' => 'Permission to publish denied, check current sub'));
        }
    }
    else{
        echo json_encode(array('error'=>'Access denied'));
    }
}
else{
    echo json_encode(array('error'=>'Some of your data are incorrect'));
}