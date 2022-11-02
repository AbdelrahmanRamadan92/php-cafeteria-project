<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/DB.php';
$dotenv = Dotenv\Dotenv::createImmutable(realpath($_SERVER['DOCUMENT_ROOT']));
$env = $dotenv->load();
//var_dump($env);
DB::connect($env['DATABASE'], $env['DATABASE_HOST'], $env['DATABASE_NAME'], $env['DATABASE_USERNAME'], $env['DATABASE_PASSWORD']);
