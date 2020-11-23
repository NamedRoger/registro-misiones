<?php

require '../db/DataBase.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

$db = new DataBase();


$stmt = $db->prepare("SELECT * FROM ad_region");
$stmt->execute();

/* Obtener todas las filas restantes del conjunto de resultados */
$regiones = $stmt->fetchAll();
echo json_encode($regiones);