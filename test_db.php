<?php
require 'db_connect.php';
$res = $conn->query('SELECT 1');
echo $res ? 'connected' : 'failed';
?>