<?php

/*
This is the file called by the submit form
*/

include "config.php";


// get inputs from the form
	$username = $_GET["username"];
	$fullname=$_GET["fullname"];
	$passwordOri=$_GET["password"];
	
// encrypt password
	switch($encryptionType)
	{
	  case "standard DES":
	 $password=crypt($passwordOri,'rl'); 
	 break;
	 case "extended DES":
	 $password=crypt($passwordOri,'_J9..rasm');
	  break;
	 case "MD5":
	 $password=crypt($passwordOri,'$1$rasmusle$');
	  break;
	 case "blowfish":
	 $password=crypt($passwordOri,'$2a$07$usesomesillystringforsalt$');
	  break;
	 default:
	 $password=crypt($passwordOri,'rl');
	
	}
	
	
// call the server file pdo.php
	
try
{
$client = new soapClient(null, array('location' => "http://localhost:8080/final/pdo.php", 'uri' => "http://localhost:8080/Class5-WS/Services"));

$client->Test();
$result = $client->Upsert($username, $fullname, $password );





if ($result)
{
	echo $result;
}
else
{
	echo "<font color='red'>nothing returned or error</font>";	
}


}catch (SoapFault $ex){
	echo "<font color='red'>An error occured".$ex->getMessage()."</font>";
}


?>
