<?php
require_once dirname(__FILE__).'/vendor/autoload.php';
$client = new MongoDB\Client();
var_dump($client);