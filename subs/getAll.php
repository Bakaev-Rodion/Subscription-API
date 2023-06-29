<?php
require_once '../db/Subs.php';
header('Content-Type: application/json; charset=utf-8');

    $allSubs = Subs::getAll($_GET['available']==1 ? true : null);
    if($allSubs){
        echo json_encode($allSubs);
    }
    else{
        echo json_encode(array('error'=>'Error'));
    }
