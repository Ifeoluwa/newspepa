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
 
// require Facebook PHP SDK
require_once("../libraries/facebook-php-sdk/src/facebook.php"); // configure /path/to/... appropriately
 
// initialize Facebook class using your own Facebook App credentials
$config = array();
$config['appId'] = '1681272065426030';  // configure appropriately
$config['secret'] = '00c6474709d6f72b87424206907a8ac0'; // configure appropriately
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
$sql = 'SELECT story_id as topic_id, title,story_url, description as facebook_post,image_url as facebook_image, facebook_pubstatus FROM timeline_stories ' .
  'WHERE created_date IS NOT NULL AND created_date <= ' . "'" . $now . "' " .
  'AND facebook_pubstatus = 0 ' .
  'ORDER BY created_date ASC, no_of_views DESC LIMIT 5';
 
$rs = $conn->query($sql);
if($rs === false) {
  $user_error = 'Wrong SQL: ' . $sql . '<br>' . 'Error: ' . $conn->errno . ' ' . $conn->error;
  trigger_error($user_error, E_USER_ERROR);
}
$rs->data_seek(0);
$share_topics = array();
while($res = $rs->fetch_assoc()) {
  $a_topic = array(
    "topic_id" => $res["topic_id"],
    "topic_title" => $res["title"],
    "topic_url" => $res["url"],
    "topic_description" => $res["facebook_post"],
    "facebook_post" => $res["facebook_post"],
    "facebook_image" => $res["facebook_image"],
    "facebook_pubstatus" => $res["facebook_pubstatus"]
  );
 
  array_push($share_topics, $a_topic);
}


$rs->free();
 
// AUTOMATIC POST EACH TOPIC TO FACEBOOK
foreach($share_topics as $share_topic) {
 
  if($share_topic['facebook_pubstatus'] == 0) {
 
    // define POST parameters
    $params = array(
      "access_token" => "CAAX5G6g7Am4BAK9iDB0FEosQdWhLJOxyjJnEVXwRTBI4yal7GERWTbNWexh1VAG1vx8kvoiSyRZAtuAz2rsSqxbyVWfd9lPb0ApieZCJZCgl86xzDk999vht0QdGw0QjtvYUi92OsZAIHY2SQlgqWZBhBe8ThoRgfe52X0W3ZBmmeJyhFzN9GhvIqNZC8uL1OwINCZAuxN7wg6Ia7tCxDE20", // configure appropriately
      "message" => $share_topic['facebook_post'],
      "link" => $share_topic['topic_url'],
      "name" => $share_topic['topic_title'],
      "caption" => "newspepa.com", // configure appropriately
      "description" => $share_topic['topic_description']
    );

    if($share_topic['facebook_image']) {
      //$params["picture"] = $share_topic['facebook_image'];
    }
 
    // check if topic successfully posted to Facebook
    try {
      $ret = $fb->api('/1165261366833416/feed', 'POST', $params); // configure appropriately

      // mark topic as posted (ensure that it will be posted only once)
      $sql = 'UPDATE timeline_stories SET facebook_pubstatus = 1 WHERE story_id = ' . $share_topic['topic_id'];
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