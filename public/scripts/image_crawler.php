<?php
/**
 * Created by PhpStorm.
 * User: iconwaymedia
 * Date: 7/9/2015
 * Time: 1:21 PM
 */
/*
 * this connection params will change for the various databases
 */
const USER_NAME = "newspep_news";
const PASSWORD = "news1234";
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

/*
 * select all the content from the database
 */
$params = array(
    'post_content' => NULL
);
$image_urls = executeQuery("SELECT post_content FROM wp_posts WHERE post_content != :post_content", $params);

/*
 * fetch out the the image tag for each content
 */
foreach($image_urls as $content){
    $image_match = preg_match('/(<img[^>]+>)/i', $content, $matches);
    $image_url = $matches[0];
}