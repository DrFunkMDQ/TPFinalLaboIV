<?php

require_once '../vendor/Facebook/graph-sdk/src/facebook/autoload.php';

use Facebook\Facebook as Facebook;

session_start();


$fb = new Facebook([
  'app_id' => '727339321118271', // Replace {app-id} with your app id
  'app_secret' => 'ccdc26f718d11ca5254e77807a508285',
  'default_graph_version' => 'v3.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/TPFinalLaboIV/views/fbcallback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '" id = "link" >Log in with Facebook!</a>';
?>

