# php-SOAP


This is a signup application written in php. When the submit button is pressed, the code in client.php will encript the password, along with name and username, then send them to the server side script pdo.php via SOAP service.
In the pdo.php code, a MySQL database is connected to, and update or insert is performed with the data received from client.php.
Config.php saves the connection configuration and the encription type. 
