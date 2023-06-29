<?php
require '../db/Publication.php';
header('Content-Type: application/json; charset=utf-8');

$allPublications = Publication::getAll(!empty($_GET['active']));
if ($allPublications) {
    echo json_encode($allPublications);
} else {
    echo json_encode(array('error' => 'Error'));
}
