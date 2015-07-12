<?php
/**
 * Created by PhpStorm.
 * User: iconwaymedia
 * Date: 7/7/2015
 * Time: 10:36 AM
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


$params = array(
    'status_id' => 3
);
$all_stories = executeQuery("SELECT id, title, description, image_url, video_url, url, pub_id, created_date, has_cluster FROM timeline_stories WHERE status_id = :status_id", $params);

//instantiate the xml document
$xml_doc = new DOMDocument();
$xml_doc->formatOutput = true;
//$xml_doc->encoding = 'UTF-8';

$add = $xml_doc->createElement("add");
$xml_doc->appendChild($add);


foreach($all_stories as $product){
    $title = mb_convert_encoding($product['title'], "UTF-8", "Windows-1252");
    $title1 = html_entity_decode($title, ENT_QUOTES, "UTF-8");
    // create an xml file and parse them in
    //field id
    $doc = $xml_doc->createElement("doc");

    $product_id = $xml_doc->createElement("field");
    $product_id_att = $xml_doc->createAttribute("name");
    $product_id_att->value = 'id';
    $product_id->appendChild($product_id_att);
    $product_id->appendChild($xml_doc->createTextNode($product['id']));

    $doc->appendChild($product_id);

    //field story title
    $product_name = $xml_doc->createElement("field");
    $product_name_att = $xml_doc->createAttribute("name");
    $product_name_att->value = 'title_en';
    $product_name->appendChild($product_name_att);
    $product_name->appendChild($xml_doc->createTextNode($title1));

    $doc->appendChild($product_name);

    $desc = mb_convert_encoding($product['description'], "UTF-8", "Windows-1252");
    $desc1 = html_entity_decode($desc, ENT_QUOTES, "UTF-8");
    //field story description
    $product_brand = $xml_doc->createElement("field");
    $product_brand_att = $xml_doc->createAttribute("name");
    $product_brand_att->value = 'description_en';
    $product_brand->appendChild($product_brand_att);
    $product_brand->appendChild($xml_doc->createTextNode($desc1));

    $doc->appendChild($product_brand);

    //field image
    $product_image = $xml_doc->createElement("field");
    $product_image_att = $xml_doc->createAttribute("name");
    $product_image_att->value = 'image_url_t';
    $product_image->appendChild($product_image_att);
    $product_image->appendChild($xml_doc->createTextNode($product['image_url']));

    $doc->appendChild($product_image);

    //field video
    $product_video = $xml_doc->createElement("field");
    $product_video_att = $xml_doc->createAttribute("name");
    $product_video_att->value = 'video_url_t';
    $product_video->appendChild($product_video_att);
    $product_video->appendChild($xml_doc->createTextNode($product['video_url']));

    $doc->appendChild($product_video);

    //field url
    $url = mb_convert_encoding($product['url'], "UTF-8", "Windows-1252");
    $url1 = html_entity_decode($url, ENT_QUOTES, "UTF-8");
    $product_url = $xml_doc->createElement("field");
    $product_url_att = $xml_doc->createAttribute("name");
    $product_url_att->value = 'url';
    $product_url->appendChild($product_url_att);
    $product_url->appendChild($xml_doc->createTextNode($url1));

    $doc->appendChild($product_url);

    //field pub_id
    $product_pub_id = $xml_doc->createElement("field");
    $product_pub_id_att = $xml_doc->createAttribute("name");
    $product_pub_id_att->value = 'pub_id_i';
    $product_pub_id->appendChild($product_pub_id_att);
    $product_pub_id->appendChild($xml_doc->createTextNode($product['pub_id']));

    $doc->appendChild($product_pub_id);

    //field has cluster
    $product_cluster = $xml_doc->createElement("field");
    $product_cluster_att = $xml_doc->createAttribute("name");
    $product_cluster_att->value = 'has_cluster_i';
    $product_cluster->appendChild($product_cluster_att);
    $product_cluster->appendChild($xml_doc->createTextNode($product['has_cluster']));

    $doc->appendChild($product_cluster);

    $add->appendChild($doc);
}

$xml_doc->saveXML();
$xml_doc->save("/home/solr-4.3.1/example/exampledocs/solr_data.xml");

//$execute = exec("java -Durl=http://localhost:8080/solr/update  -jar /var/www/pricepadi.com/Crons/post.jar /var/www/pricepadi.com/Crons/xml/solr_data.xml 2>&1",$output, $return);

echo "file done";