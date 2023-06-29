<?php
require_once '../db/Subs.php';
header('Content-Type: application/json; charset=utf-8');


if(!empty($_POST['jwt'])){
    $sub = Subs::getCurrent($_POST['jwt']);
    echo json_encode($sub);
}
else{
    echo json_encode(array('error'=>'Error'));
}