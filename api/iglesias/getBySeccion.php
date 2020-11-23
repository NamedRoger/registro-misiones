<?php

require '../db/DataBase.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

$seccionId = $_GET['seccion_id'];

$db = new DataBase();


$stmt = $db->prepare("SELECT * FROM ad_church WHERE section_id = :seccion_id");
$stmt->bindParam(":seccion_id",$seccionId);
$stmt->execute();

/* Obtener todas las filas restantes del conjunto de resultados */
$iglesias = $stmt->fetchAll();
echo json_encode($iglesias);