<?php
/**
 * Created by PhpStorm.
 * User: perfection
 * Date: 7/23/15
 * Time: 12:18 AM
 */
const USER_NAME = "root";
const PASSWORD = "HisGRACE01";
const DSN = "mysql:host=localhost;dbname=newspep_newspepadb";
const ACTIVE = 1;


function executeQuery($statement, $params, $return_row = false){
    if($pdo = new PDO(DSN, USER_NAME, PASSWORD)){
        $pds = $pdo->prepare($statement);
        $pds->execute($params);
        return ($return_row) ? fetchRow($pds) : fetchAll($pds);
    }
    return null;
}


function executeNonQuery($statement, $params){
    if($pdo = new PDO(DSN, USER_NAME, PASSWORD)){
        $pds = $pdo->prepare($statement);
        $pds->execute($params);
        return $pdo->lastInsertId();
    }
    return null;
}

function fetchRow ($pds){
    return $pds->fetch(PDO::FETCH_ASSOC);
}

function fetchAll($pds){
    return $pds->fetchAll(PDO::FETCH_ASSOC);
}

function fetchOneAll($pds){
    return $pds->fetchAll(PDO::FETCH_COLUMN, 0);
}



$params = array(
    'status_id' => 3
);
$data_old = executeQuery("SELECT id, category_id, title FROM stories WHERE status_id = :status_id", $params);
$old_data = array();
foreach($data_old as $data){
    $title = mb_convert_encoding($data['title'], "UTF-8", "Windows-1252");
    $data['title'] = html_entity_decode($title, ENT_QUOTES, "UTF-8");

    $data['title'] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $data['title']);

    //$desc = mb_convert_encoding($data['description'], "UTF-8", "Windows-1252");
    //$data['description'] = html_entity_decode($desc, ENT_QUOTES, "UTF-8");

    //$data['description'] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $data['description']);

    array_push($old_data, $data);
}

$data_new = executeQuery("SELECT id, category_id, title FROM stories WHERE status_id = :status_id AND id BETWEEN 1 AND 3", $params);
$new_data = array();
foreach($data_new as $data){
    $title = mb_convert_encoding($data['title'], "UTF-8", "Windows-1252");
    $data['title'] = html_entity_decode($title, ENT_QUOTES, "UTF-8");

    $data['title'] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $data['title']);

    //$desc = mb_convert_encoding($data['description'], "UTF-8", "Windows-1252");
    //$data['description'] = html_entity_decode($desc, ENT_QUOTES, "UTF-8");

    //$data['description'] = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $data['description']);

    array_push($new_data, $data);
}

$data = array($old_data, $new_data);

// Execute the python script with the JSON data
$result = shell_exec('python /var/www/first_py/test.py ' . escapeshellarg(json_encode($data)));
var_dump($result);
die();
// Decode the result
$resultData = json_decode($result, true);
var_dump($resultData);

// This will contain: array('status' => 'Yes!')
foreach($resultData as $key => $value){
    var_dump($value);
}