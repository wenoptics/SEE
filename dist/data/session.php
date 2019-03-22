<?php
/**
 * Created by IntelliJ IDEA.
 * User: wenop
 * Date: 3/21/2019
 * Time: 11:43 AM
 */

$db_config = include('private/database.php');

// Create connection
$conn = new mysqli($db_config['host'], $db_config['username'], $db_config['password'], $db_config['db_name']);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare('SELECT * FROM ecosystem WHERE session_id = ?');
$stmt->bind_param('s', $_GET['id']);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows == 0) {
    $ret = array('succ' => false);
} else {
    $ret = $result->fetch_assoc();
    $ret['succ'] = true;
}
echo json_encode($ret);

$conn->close();