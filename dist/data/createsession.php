<?php
/**
 * Created by IntelliJ IDEA.
 * User: wenop
 * Date: 3/21/2019
 * Time: 11:43 AM
 */

$db_config = include('private/database.php');
$key = include('private/key.php');

// Create connection
$conn = new mysqli($db_config['host'], $db_config['username'], $db_config['password'], $db_config['db_name']);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM ecosystem WHERE (id = ? AND ( session_id IS NULL OR session_id = ''))");
$stmt->bind_param('s', $_GET['id']);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows == 0) {
    $ret = array('succ' => false);
} else {
    $hash = md5($_GET['id'] . $key['session_id']);

    $stmt = $conn->prepare('UPDATE ecosystem SET session_id = ? WHERE (id = ?)');
    $stmt->bind_param('ss',$hash, $_GET['id']);
    $stmt->execute();

    $ret['succ'] = true;
    $ret['hash'] = $hash;
}
echo json_encode($ret);

$conn->close();