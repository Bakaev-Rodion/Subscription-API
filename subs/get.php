<?php
require_once '../db/Subs.php';
header('Content-Type: application/json; charset=utf-8');

if(!empty($_GET['id'])){
    $sub = Subs::getById($_GET['id']);
    echo json_encode($sub);
}
else{
    echo json_encode(array('error'=>'Error'));
}
