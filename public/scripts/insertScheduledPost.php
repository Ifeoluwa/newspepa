<?php
/**
 * Created by PhpStorm.
 * User: iconwaymedia
 * Date: 7/30/2015
 * Time: 1:53 PM
 */
date_default_timezone_set('Africa/Lagos');
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
    'status_id' => 4
);
$scheduled_story = executeQuery("SELECT * FROM stories WHERE status_id = :status_id AND pub_date BETWEEN DATE_SUB(now(), INTERVAL 15 MINUTE) AND now()", $params);

foreach($scheduled_story as $story){
    $details = array(
        'story_id' => $story['story_id'],
        'title' => $story['title'],
        'image_url' => $story['image_url'],
        'video_url' => $story['video_url'],
        'description' => $story['description'],
        'content' => $story['content'],
        'url' => $story['url'],
        'story_url' => $story['story_url'],
        'pub_id' => $story['pub_id'],
        'feed_id' => $story['feed_id'],
        'category_id' => $story['category_id'],
        'pub_date' => $story['pub_date'],
        'has_cluster' => 1,
        'is_pivot' => 1,
    );

    $id = executeNonQuery("INSERT INTO timeline_stories (story_id, title, image_url, video_url, description, content, url, story_url, pub_id, feed_id, category_id, pub_date, has_cluster, is_pivot, created_date, modified_date) VALUE (:story_id, :title, :image_url, :video_url, :description, :content, :url, :story_url, :pub_id, :feed_id, :category_id, :pub_date, :has_cluster, :is_pivot, now(), now())", $details);
    if ($id !== false){
        $story['id'] = $id['id'];
        solrInsert($story);
        $param = array(
            'status_id' => 1,
            'id' => $id['id']
        );
        executeNonQuery("UPDATE stories SET status_id = :status_id WHERE id = :id", $param);
    }
}

function solrInsert($data){
    $date =  date("YmdHis");

    $config = array(
        "endpoint" => array("localhost" => array("host"=>"192.190.86.123",
            "port"=>"8080", "path"=>"/solr", "core"=>"collection1",)
        ) );
    $client = new Solarium\Client($config);
    $updateQuery = $client->createUpdate();

    $story1 = $updateQuery->createDocument();
    $story1->id = $data['id']; //return the id of the insert from PDO query and attach it here
    $story1->title_en = $data['title'];
    $story1->description_en = $data['description'];
    if(isset($data['image_url'])){
        $story1->image_url_t = $data['image_url'];
    }else{
        $story1->image_url_t = '';
    }
    $story1->video_url_t = $data['video_url'];
    $story1->url = $data['url'];
    $story1->pub_id_i = $data['pub_id'];
    $story1->has_cluster_i = 1;
    $story1->links = strtotime($date);

    $updateQuery->addDocument($story1);
}