<?php
/**
 * Created by PhpStorm.
 * User: iconwaymedia
 * Date: 7/23/2015
 * Time: 12:40 PM
 */
const ACTIVE = 1;


function executeQuery($statement, $params, $return_row = false){
    if($pdo = new PDO("mysql:host=localhost;dbname=newspep_newspepadb", "root", "")){
        $pds = $pdo->prepare($statement);
        $pds->execute($params);
        return ($return_row) ? fetchRow($pds) : fetchAll($pds);
    }
    return null;
}


function executeNonQuery($statement, $params){
    if($pdo = new PDO("mysql:host=localhost;dbname=newspep_newspepa", "root", "")){
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

foreach($stories as $story){
    $params = array(
        'title' => $story['title'],
        'image_url' => $story['image_url'],
        'video_url' => $story['video_url'],
        'description' => $story['description'],
        'content' => $story['content'],
        'url' => $story['url'],
        'pub_id' => $story['pub_id'],
        'feed_id' => $story['feed_id'],
        'category_id' => $story['category_id'],
        'status_id' => $story['status_id'],
        'pub_date' => $story['pub_date'],
        'has_cluster' => $story['has_cluster'],
        'created_date' => $story['created_date'],
        'modified_date' => $story['modified_date']
    );
    executeNonQuery("INSERT INTO stories(title, image_url, video_url, description, content, url, pub_id, feed_id, category_id, status_id, pub_date, has_cluster, created_date, modified_date) VALUE (:title, :image_url, :video_url, :description, :content, :url, :pub_id, :feed_id, :category_id, :status_id, :pub_date, :has_cluster, :created_date, :modified_date)", $params);
}


$params = array(
    'status_id' => 1
);

$stories = executeQuery("SELECT * FROM timeline_stories WHERE status_id = :status_id", $params);
$story_id = 0;
foreach($stories as $story){

    $story_id = $story_id + 1;
    $url_array = explode("-", $story['story_url']);
    array_pop($url_array);
    $story_url = (implode("-", $url_array)).'-'.($story_id);
    $params = array(
        'story_id' => $story_id,
        'title' => $story['title'],
        'image_url' => $story['image_url'],
        'video_url' => $story['video_url'],
        'description' => $story['description'],
        'content' => $story['content'],
        'url' => $story['url'],
        'story_url' => $story_url,
        'pub_id' => $story['pub_id'],
        'feed_id' => $story['feed_id'],
        'category_id' => $story['category_id'],
        'status_id' => $story['status_id'],
        'pub_date' => $story['pub_date'],
        'has_cluster' => $story['has_cluster'],
        'is_pivot' => $story['is_pivot'],
        'is_top' => $story['is_top'],
        'no_of_views' => $story['no_of_views'],
        'last_view_time' => $story['last_view_time'],
        'link_outs' => $story['link_outs'],
        'last_linkout_time' => $story['last_linkout_time'],
        'shares' => $story['shares'],
        'facebook_pubstatus' => $story['facebook_pubstatus'],
        'twitter_pubstatus' => $story['twitter_pubstatus'],
        'created_date' => $story['created_date'],
        'modified_date' => $story['modified_date']
    );
    executeNonQuery("INSERT INTO timeline_stories(story_id, title, image_url, video_url, description, content, url, story_url, pub_id, feed_id, category_id, status_id, pub_date, has_cluster, is_pivot, is_top, no_of_views, last_view_time, link_outs, last_linkout_time, shares, facebook_pubstatus, twitter_pubstatus, created_date, modified_date) VALUE (:story_id, :title, :image_url, :video_url, :description, :content, :url, :story_url, :pub_id, :feed_id, :category_id, :status_id, :pub_date, :has_cluster, :is_pivot, :is_top, :no_of_views, :last_view_time, :link_outs, :last_linkout_time, :shares, :facebook_pubstatus, :twitter_pubstatus, :created_date, :modified_date)", $params);
}

echo 'file done';