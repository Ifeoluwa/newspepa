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
//const USER_NAME = "kokofeed_kf";
//const PASSWORD = "Omobas1";
//const DSN = "mysql:host=localhost;dbname=kokofeed_db";

//stargist
//const USER_NAME = "stargist_odt";
//const PASSWORD = "Omobas1";
//const DSN = "mysql:host=;dbname=stargist_numberone";

//nigerianmonitors
//const USER_NAME = "nigerian_monitor";
//const PASSWORD = "nigerianmonitor";
//const DSN = "mysql:host=localhost;dbname=nigerian_monitor";



//function executeQuery($statement, $params, $return_row = false){
//    if($pdo = new PDO(DSN, USER_NAME, PASSWORD)){
//        $pds = $pdo->prepare($statement);
//        $pds->execute($params);
//        return ($return_row) ? fetchRow($pds) : fetchAll($pds);
//    }
//    return null;
//}
//
//
//function executeNonQuery($statement, $params){
//    if($pdo = new PDO(DSN, USER_NAME, PASSWORD)){
//        $pds = $pdo->prepare($statement);
//        $pds->execute($params);
//        return $pdo->lastInsertId();
//    }
//    return null;
//}
//
//function fetchRow ($pds){
//    return $pds->fetch(PDO::FETCH_ASSOC);
//}
//
//function fetchAll($pds){
//    return $pds->fetchAll(PDO::FETCH_ASSOC);
//}
//
//function fetchOneAll($pds){
//    return $pds->fetchAll(PDO::FETCH_COLUMN, 0);
//}

/*
 * select all the content from the database
 */
//$params = array(
//    'post_content' => NULL
//);
//$image_urls = executeQuery("SELECT post_content FROM wp_posts WHERE post_content != :post_content", $params);

/*
 * fetch out the the image tag for each content
 */
$xml_doc = new DOMDocument();
$xml_doc->formatOutput = true;

$url_arrays = $xml_doc->createElement("add");
$xml_doc->appendChild($url_arrays);

$id = 250445;
for($j = 12; $j <= 15; ++$j){
    for($i = 1; $i <= 12; ++$i){
        if($i < 10){
        $log_directory = '/home/kokofeed/public_html/wp-content/uploads/2015/0'.$i;
        $http = 'http://kokofeed.com/wp-content/uploads/20'.$j.'/0'.$i.'/';
        }
        else{
        $log_directory = '/home/kokofeed/public_html/wp-content/uploads/2015/'.$i;
            $http = 'http://kokofeed.com/wp-content/uploads/20'.$j.'/'.$i.'/';
        }

        foreach(glob($log_directory.'/*.*') as $content){

            $content = str_replace($log_directory.'/', '', $content);
            $url = $xml_doc->createElement("doc");

            $image_id = $xml_doc->createElement("field");
            $id_att = $xml_doc->createAttribute('name');
            $id_att->value = 'id';
            $image_id->appendChild($id_att);
            $image_id->appendChild($xml_doc->createTextNode($id));
            $url->appendChild($image_id);

            $path = $xml_doc->createElement("field");
            $path_att = $xml_doc->createAttribute('name');
            $path_att->value = 'url';
            $path->appendChild($path_att);
            $path->appendChild($xml_doc->createTextNode($http));
            $url->appendChild($path);

            $image_name = $xml_doc->createElement("field");
            $image_name_att = $xml_doc->createAttribute('name');
            $image_name_att->value = 'name';
            $image_name->appendChild($image_name_att);
            $image_name->appendChild($xml_doc->createTextNode($content));
            $url->appendChild($image_name);

            $url_arrays->appendChild($url);
            $id = $id + 1;
        }
    }
}


$xml_doc->saveXML();
$xml_doc->save("crawl_data.xml");

echo 'file done';