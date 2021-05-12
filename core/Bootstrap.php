<?php

session_start();

$config = require_once 'config.php';
require_once 'DatabaseConnection.php';
require_once 'helpers.php';
require_once 'src/Poll.php';

// Connect to the database and create a connection instance
DatabaseConnection::connect($config['database']);
$db = DatabaseConnection::getInstance();
$poll = new Poll($db->getConnection());
