<?php

header('Content-Type: text/html; charset=utf-8');

session_start();

// charge l'autoload de composer
require "vendor/autoload.php";

// charge le contenu du .env dans $_ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$newTokenManger = new CSRFTokenManager();

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = $newTokenManger->generateCSRFToken();
}


$router = new Router();


$router->handleRequest($_GET);
