<?php
$configs = include('config.php');

$dsn = 'mysql:host=' . $configs['db_host'] . ';dbname=' . $configs['db_name'];

try
{  
   $pdo = new PDO($dsn, $configs['db_user'],  $configs['db_password']);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
   echo "<script>console.log('".'Database connection failed.\n'."');</script>";
   die();
}

echo "<script>console.log('"."Connected successfully"."');</script>";
