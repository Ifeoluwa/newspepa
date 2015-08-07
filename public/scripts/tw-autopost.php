<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
// determine script invocation (CLI or Web Server)
if(php_sapi_name() == 'cli') {
    $line_break = PHP_EOL;
} else {
    $line_break = '<br>';
}

date_default_timezone_set('Africa/Lagos');
// require codebird
require_once('../libraries/codebird-php-develop/src/codebird.php'); // configure /path/to/... appropriately

// get current time - configure appropriately, depending to how you store dates in your database

$now =  date("YmdHis");

// initialize
$share_topics = array();

// connect to database
$conn = new mysqli("localhost", "newspep_news", "news1234", "newspep_newspepadb"); // configure appropriately

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}



// create array with topics to be posted on Twitter
$sql = 'SELECT story_id as topic_id, title, story_url, image_url as twitter_image, twitter_pubstatus FROM timeline_stories ' .
    'WHERE created_date IS NOT NULL AND created_date  <= ' . "'" . $now . "' " .
    'AND created_date BETWEEN DATE_SUB('. $now .', INTERVAL 1 HOUR) AND '. $now.
    ' AND twitter_pubstatus = 0 ' .
    'ORDER BY no_of_views DESC LIMIT 1';

$rs = $conn->query($sql);
if($rs === false) {
    $user_error = 'Wrong SQL: ' . $sql . '<br>' . 'Error: ' . $conn->errno . ' ' . $conn->error;
    trigger_error($user_error, E_USER_ERROR);
}
$rs->data_seek(0);

$share_topics = array();
while($res = $rs->fetch_assoc()) {
    if (strpos($res['twitter_image'], 'http://') == false){
        $res['twitter_image'] = "newspepa.com/".$res['twitter_image'];
    }
    $twitter_post = mb_convert_encoding($res["title"], "UTF-8", "Windows-1252");
    $twitter_post = html_entity_decode($twitter_post, ENT_QUOTES, "UTF-8");
    $a_topic = array(
        "topic_id" => $res["topic_id"],
        "twitter_post" => $twitter_post.' '.'newspepa.com/'.$res["story_url"],
        "twitter_image" => $res["twitter_image"],
        "twitter_pubstatus" => $res["twitter_pubstatus"]
    );
    array_push($share_topics, $a_topic);
}
$rs->free();

// initialize Codebird (using your access tokens) - establish connection with Twitter
\Codebird\Codebird::setConsumerKey("fetGVwJSPEry774Fj2oxYhHBS", "yJUdUDctH5p3X6fmsaALvq9h6UiewW9svkNCwnGUxqkBr1jWzz");
$cb = \Codebird\Codebird::getInstance();
$cb->setToken("3351680980-r4HNuDkcxhqlgLCOVFmrpKUz7dxhOJuGgT3aLj4", "nftbubzt36Rd1PF0xjkAAsRgwFGbWB13Iw2G1uePCcPiy");

// AUTOMATIC TWEET EACH TOPIC
foreach($share_topics as $share_topic) {

    if($share_topic['twitter_pubstatus'] == 0) {


        // if($share_topic['twitter_image']) {
        // $params = array(
        //  'status' => $share_topic['twitter_post'],
        //'media[]' => $share_topic['twitter_image']
        //);
        $params = array(
            'status' => $share_topic['twitter_post']
        );

        $reply = $cb->statuses_updateWithMedia($params);
        //} else {

        $reply = $cb->statuses_update($params);
        // }

        // check if tweet successfully posted

        $status = $reply->httpstatus;
        $result = '';
        if($status == 200) {

            // mark topic as tweeted (ensure that it will be tweeted only once)
            $sql = 'UPDATE timeline_stories SET twitter_pubstatus = 1 WHERE story_id = ' . $share_topic['topic_id'];
            if($conn->query($sql) === false) {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
            }
            $result .= $share_topic['topic_id'] . ' ' . $share_topic['twitter_post'] . ' success (' . $status . ')' . $line_break;

        } else {
            $result .= $share_topic['topic_id'] . ' ' . $share_topic['twitter_post'] . ' FAILED... (' . $status . ')' . $line_break;
        }

        sleep(3);
    }

}

if(php_sapi_name() == 'cli') {
    // keep log
    file_put_contents('auto_share.log', $result . str_repeat('=', 80) . PHP_EOL, FILE_APPEND);

    echo $result;

} else {
    $html = '<html><head>';
    $html .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
    $html .= '</head>';
    $html .= '<body>';
    $html .= $result;
    $html .= '</body>';
    $html .= '</html>';
    echo $html;
}

?>