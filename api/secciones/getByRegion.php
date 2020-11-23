<?php

require '../db/DataBase.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

$regionId = $_GET['region_id'];

$db = new DataBase();


$stmt = $db->prepare("SELECT * FROM ad_section WHERE region_id = :region_id");
$stmt->bindParam(":region_id",$regionId);
$stmt->execute();

/* Obtener todas las filas restantes del conjunto de resultados */
$secciones = $stmt->fetchAll();
echo json_encode($secciones);