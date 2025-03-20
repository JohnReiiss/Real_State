<?php

$host = 'localhost';  
$dbname = 'real_state'; 
$username = 'root';    
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conectado com sucesso ao banco de dados!";
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>