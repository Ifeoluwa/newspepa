<?php
/**
 * Created by PhpStorm.
 * User: iconwaymedia
 * Date: 7/25/2015
 * Time: 9:24 PM
 */

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
// determine script invocation (CLI or Web Server)
if(php_sapi_name() == 'cli') {
    $line_break = PHP_EOL;
} else {
    $line_break = '<br>';
}

// require Facebook PHP SDK
require_once("../libraries/facebook-php-sdk/src/facebook.php"); // configure /path/to/... appropriately

// initialize Facebook class using your own Facebook App credentials
$config = array();
$config['appId'] = '210106065810484';  // configure appropriately
$config['secret'] = 'b01de447df2c087a198718d237807391'; // configure appropriately
$config['fileUpload'] = false; // optional


$fb = new Facebook($config);

// get current time - configure appropriately, depending to how you store dates in your database
$now =  date("YmdHis");

// connect to database
$conn = new mysqli("localhost", "newspep_news", "news1234", "newspep_newspepadb"); // configure appropriately

// check connection
if ($conn->connect_error) {
    trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}

// create array with topics to be posted on Facebook
$sql = 'SELECT story_id as topic_id, title, story_url, description as facebook_post, image_url as facebook_image, facebook_pubstatus FROM timeline_stories ' .
    'WHERE created_date IS NOT NULL AND created_date <= ' . "'" . $now . "' " .
    'AND created_date BETWEEN DATE_SUB('. $now .', INTERVAL 3 HOUR) AND '. $now.
    ' ORDER BY no_of_views DESC LIMIT 1';

$rs = $conn->query($sql);
if($rs === false) {
    $user_error = 'Wrong SQL: ' . $sql . '<br>' . 'Error: ' . $conn->errno . ' ' . $conn->error;
    trigger_error($user_error, E_USER_ERROR);
}
$rs->data_seek(0);
$share_topics = array();
while($res = $rs->fetch_assoc()) {
    if (strpos($res['facebook_image'], 'http://') == false){
        $res['facebook_image'] = "newspepa.com/".$res['facebook_image'];
    }
    $fb_post = mb_convert_encoding($res["facebook_post"], "UTF-8", "Windows-1252");
    $fb_post = html_entity_decode($fb_post, ENT_QUOTES, "UTF-8");

    $fb_title = mb_convert_encoding($res["title"], "UTF-8", "Windows-1252");
    $fb_title = html_entity_decode($fb_title, ENT_QUOTES, "UTF-8");
    $a_topic = array(
        "topic_id" => $res["topic_id"],
        "topic_title" => $fb_title,
        "topic_url" => "newspepa.com/".$res["story_url"],
        "topic_description" => $fb_post,
        "facebook_post" => $fb_post,
        "facebook_image" => $res["facebook_image"],
        "facebook_pubstatus" => $res["facebook_pubstatus"]
    );

    array_push($share_topics, $a_topic);
}


$rs->free();

// AUTOMATIC POST EACH TOPIC TO FACEBOOK
foreach($share_topics as $share_topic) {

    if($share_topic['facebook_pubstatus'] != 2) {

        // define POST parameters
        $params = array(
            "access_token" => "CAACZCFyFq9DQBACAHySIfORZAMPbQuxD3mcdK5ZBvfQ2lqrCsk0GSWjyaavIFpUVSPACFYy1D96PomiJTKgCJhkzJoZAymKzrSehKtZBqXX0DDd9fcEnU2yNcJMkR5TrZCcWEq1SsnFiJMmgGe7UrXmWslJPlZA2GnUbulrScdJZAg4WL9TcOnKeAabMXNQkmqUI5Yqm1WZB1p6egyEFglzPg", // configure appropriately
            "message" => $share_topic['facebook_post'],
            "link" => $share_topic['topic_url'],
            "name" => $share_topic['topic_title'],
            "caption" => "newspepa.com", // configure appropriately
            "description" => $share_topic['topic_description']
        );

        if(trim($share_topic['facebook_image']) != '') {
            $params["picture"] = $share_topic['facebook_image'];
        }

        $result = '';
        // check if topic successfully posted to Facebook
        try {
            $ret = $fb->api('/275403655916050/feed', 'POST', $params); // configure appropriately

            // mark topic as posted (ensure that it will be posted only once)
//            $sql = 'UPDATE timeline_stories SET facebook_pubstatus = 1 WHERE story_id = ' . $share_topic['topic_id'];
            if($conn->query($sql) === false) {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
            }
            $result .= $share_topic['topic_id'] . ' ' . $share_topic['facebook_post'] . ' successfully posted to Facebook!' . $line_break;

        } catch(Exception $e) {
            $result .= $share_topic['topic_id'] . ' ' . $share_topic['facebook_post'] . ' FAILED... (' . $e->getMessage() . ')' . $line_break;
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