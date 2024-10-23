<?php
define('CONTR',__DIR__.'/src/controllers/');
define('VIEWS',__DIR__.'/src/views/');

require 'src/lib.php';
require 'src/env.php';

// loadEnv('.env');
try{
    $pdo=new PDO('sqlite:'.__DIR__.'/src/db/auth.sqlite');
}catch(PDOException $e){
    die($e->getMessage());
}
$controller=router($routes,'login');
require CONTR.'/'.$controller.'.php';
// autenticació local | password_hash | password_verify

// array associatiu | fitxer de dades
// Proveidor de dades: persistència de dades
// SGBD --> Sistema de Gestor de Base de Dades