<?php
require 'vendor/autoload.php';

$config = require 'config.php';
$hybridauth = new Hybridauth\Hybridauth($config);

$adapter = $hybridauth->authenticate('Google');
$userProfile = $adapter->getUserProfile();

session_start();
$_SESSION['user_id'] = $userProfile->identifier;
$_SESSION['email'] = $userProfile->email;

header('Location: index.php');
exit();
