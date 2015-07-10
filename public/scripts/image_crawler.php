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

//kokofeeds
const USER_NAME = "kokofeed_kf";
const PASSWORD = "Omobas1";
const DSN = "mysql:host=localhost;dbname=kokofeed_db";

//stargist
//const USER_NAME = "stargist_odt";
//const PASSWORD = "Omobas1";
//const DSN = "mysql:host=;dbname=stargist_numberone";

//nigerianmonitors
//const USER_NAME = "nigerian_monitor";
//const PASSWORD = "nigerianmonitor";
//const DSN = "mysql:host=localhost;dbname=nigerian_monitor";



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
$xml_doc = new DOMDocument();
$xml_doc->formatOutput = true;

$url_arrays = $xml_doc->createElement("add");
$xml_doc->appendChild($url_arrays);
foreach($image_urls as $content){
    echo $content;
    die();
    $url = $xml_doc->createElement("url");

    $path = $xml_doc->createElement("path");
    $image_match = preg_match('/(<img[^>]+>)/i', $content, $matches);
    $path->appendChild($xml_doc->createTextNode($matches[0]));

    $url->appendChild($path);
}

$xml_doc->saveXML();
$xml_doc->save("crawl_data.xml");

echo 'file done';