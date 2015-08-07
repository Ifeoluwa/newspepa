<?php
/**
 * Created by PhpStorm.
 * User: iconwaymedia
 * Date: 7/23/2015
 * Time: 12:40 PM
 */
const ACTIVE = 1;


function executeQuery($statement, $params, $return_row = false){
    if($pdo = new PDO("mysql:host=localhost;dbname=newspep_newspepadb", "newspep_news", "news1234")){
        $pds = $pdo->prepare($statement);
        $pds->execute($params);
        return ($return_row) ? fetchRow($pds) : fetchAll($pds);
    }
    return null;
}


function executeNonQuery($statement, $params){
    if($pdo = new PDO("mysql:host=localhost;dbname=newspep_newspepa", "newspep_news", "news1234")){
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
    'status_id' => 1
);

$stories = executeQuery("SELECT * FROM timeline_stories WHERE status_id = :status_id", $params);
$config = array(
    "endpoint" => array("localhost" => array("host"=>"192.190.86.123",
        "port"=>"8080", "path"=>"/solr", "core"=>"collection1",)
    ) );
$client = new Solarium\Client($config);
$updateQuery = $client->createUpdate();
var_dump($client);
die();
foreach($stories as $story){
    $testdoc = $updateQuery->createDocument();
    $testdoc->id = $story['id'];
    $testdoc->title_en = $story['title'];
    $testdoc->description_en = $story['description'];
    $testdoc->image_url = $story['image_url'];
    $testdoc->video_url = $story['video_url'];
    $testdoc->url = $story['url'];
    $testdoc->pub_id_i = $story['pub_id_i'];
    $testdoc->has_cluster_i = $story['has_cluster_i'];
    $testdoc->links = strtotime($story['created_date']);
    $updateQuery->addDocument($testdoc, true);
    $updateQuery->addCommit();
    $client->update($updateQuery);
}
echo 'file done';