<?php
/*

 This is a server file, called by client.php to interact with the database
*/



/**
  Upsert method that update or insert a record, and return a message
*/


function Upsert($username, $fullname, $password )	
{	
   include "config.php";
   $msg="";

	
try{
	

	
	$db = new PDO("mysql:host=$dbhost;dbname=cewp559exam", $dbuser, $dbpass);
	//$db = new PDO('mysql:host=localhost:3406;dbname=cewp559exam', $dbuser, $dbpass);
	//$db = new PDO('mysql:host=localhost:3406;dbname=cewp559exam', 'root', 'mysql');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	

	$stmt0 = $db->prepare('SELECT * FROM passwords WHERE username = :username');
	$stmt0->bindParam(':username', $username, PDO::PARAM_STR, 45);
	$stmt0->execute();


			

	if($stmt0->rowCount()>0)
	{
		$params = array( ':fullname' => $fullname, ':password' =>$password, ':username' => $username );
		$stmt = $db->prepare('UPDATE passwords SET fullname=:fullname, password=:password WHERE username=:username');
		$stmt->execute($params);

		$msg="record updated";
	
	}else
	{
		$params = array(':username' => $username, ':fullname' => $fullname, ':password' =>$password );
		$stmt = $db->prepare('INSERT INTO passwords (username, fullname, password) VALUES (:username, :fullname, :password)');
		$stmt->execute($params);

		$msg="record inserted";
	}

	         
	
	
} catch (PDOException $ex)
{

	$msg="<font color='red'>An error occured".$ex->getMessage()."</font>";
	
}
	
	
	
 return $msg;
}
	
	
	
	
	
// connect with the client.php	
	
$server = new SoapServer(null, array('uri' => "http://localhost:8080/Class5-WS/Services"));

$server->addFunction("Upsert");


$server->handle();
	
?>