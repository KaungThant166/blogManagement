<?php   
$host = 'localhost';
$dbname = "hornbill_blog";
$dbuser = 'root';
$pass = "";

$db = new PDO("mysql:host=$host;dbname=$dbname",$dbuser,$pass);

if(!$db){
    echo "database connected fail";
};