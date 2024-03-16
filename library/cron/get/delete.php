<?php
require '../../../connect.php';

$call->query("TRUNCATE TABLE category");
$call->query("TRUNCATE TABLE srv_socmed");
$call->query("TRUNCATE TABLE srv_ppob");
$call->query("TRUNCATE TABLE srv_game");
