<?php 

$host="sql6.freesqldatabase.com";
$username="sql6505472";
$password="8fiTzhNmb2";
$db="sql6505472";
$dsn="mysql:host=$host;dbname=$db;charset=utf8";

try{
    $pdo = new PDO($dsn,$username,$password);
}catch(PDOException $e){
    echo $e->getMessage();
}
require_once "db/controller.php";
require_once "db/user.php";
$controller = new Controller($pdo);
$user = new User($pdo);

$user->insertUser('admin','12345');

?>