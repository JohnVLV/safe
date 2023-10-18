<?php
$hostName = "localhost";
$userName = "root";
$password = "";
$databaseName = "clinica";

 $conn = new mysqli($hostName, $userName, $password, $databaseName);
// checa a conexão
if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}

?>