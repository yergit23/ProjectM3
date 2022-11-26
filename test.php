<?php
//require_once 'session.php';
//session_start();

//var_dump($_POST); exit;

//echo Session::flash('success');


$pdo = new PDO("mysql:host=localhost;dbname=project3","root","root");
$sql = "SELECT * FROM rgroups";
$statement = $pdo->prepare($sql);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);

var_dump($users); exit;

?>