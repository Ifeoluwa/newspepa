<?php
/**
 * Created by PhpStorm.
 * User: iconwaymedia
 * Date: 7/28/2015
 * Time: 12:12 PM
 */

const USER_NAME = "root";
const PASSWORD = "HisGRACE01";
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

function string_compare($str_a, $str_b)
{
    $length = strlen($str_a);
    $length_b = strlen($str_b);

    $i = 0;
    $segmentcount = 0;
    $segmentsinfo = array();
    $segment = '';
    while ($i < $length)
    {
        $char = substr($str_a, $i, 1);
        if (strpos($str_b, $char) !== FALSE)
        {
            $segment = $segment.$char;
            if (strpos($str_b, $segment) !== FALSE)
            {
                $segmentpos_a = $i - strlen($segment) + 1;
                $segmentpos_b = strpos($str_b, $segment);
                $positiondiff = abs($segmentpos_a - $segmentpos_b);
                $posfactor = ($length - $positiondiff) / $length_b; // <-- ?
                $lengthfactor = strlen($segment)/$length;
                $segmentsinfo[$segmentcount] = array( 'segment' => $segment, 'score' => ($posfactor * $lengthfactor));
            }
            else
            {
                $segment = '';
                $i--;
                $segmentcount++;
            }
        }
        else
        {
            $segment = '';
            $segmentcount++;
        }
        $i++;
    }

    // PHP 5.3 lambda in array_map
    $totalscore = array_sum(array_map(function($v) { return $v['score'];  }, $segmentsinfo));
    return $totalscore;
}

function addCluster($clusters){
    $params = array(
        'cluster_pivot' => $clusters['cluster_pivot'],
        'cluster_match' => $clusters['cluster_match']
    );
    return executeQuery("INSERT INTO clusters(cluster_pivot, cluster_match, status_id, created_date, modified_date) VALUE (:cluster_pivot, :cluster_match, 1, now(), now())", $params);
}

$params = array(
    'status_id' => 1
);

$all_stories = executeQuery("SELECT id, title, description FROM timeline_stories WHERE status_id = :status_id AND created_date BETWEEN date_sub(now(), INTERVAL 3 DAY) AND now()", $params);


for($i = 0; $i < count($all_stories); ++$i){
    $pivot = $all_stories[$i];
    foreach($all_stories as $key => $value){
        if (string_compare($value['title'], $pivot['title']) > 0.8 && string_compare($value['description'], $pivot['description']) > 0.8){
            $cluster_params = array(
                'cluster_pivot' => $pivot['id'],
                'cluster_match' => $value['id']
            );
            addCluster($cluster_params);
            unset($all_stories[$key]);
            $all_stories = array_values($all_stories);
        }
    }
}

echo 'file done';