<?php 

require '../db/DataBase.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

$input = $_POST;

echo addRegistro($input);

function addRegistro($input){
    $db = new DataBase();
    $response = (object)[];

    if(empty(trim($input["firstname"]))){
        $response =(object) [
            'success' => false,
            'error' => "El campo de nombre esta vacio"
        ];
        return json_encode($response);
    }
    
    try{

        $stmt = $db->prepare("INSERT INTO missions_event_registration 
        (`name`,`church`,`section`,`region`,`city`,`cellphone`,`email`) 
        VALUES (:firstname,:iglesia,:seccion,:region,:ciudad,:phone,:email)");
    
        $stmt->execute($input);

        if(!empty(trim($input["email"]))){
            sendEmail($input["email"], $db->lastInsertId());
        }
    
        $response = (object)[
            "success" => true,
            "folio" => $db->lastInsertId()
        ];

        return json_encode($response);
    }catch(Exception $e){
        $response =(object) [
            'success' => false,
            'error' => $e->getMessage()
        ];
    }
    
}

function validateInput($input){

}

function sendEmail($email,$folio){
    $asunto = "Información de Registro"; 
    $cuerpo = '
    <!DOCTYPE html>
    <html lang="es"> 
        <head> 
        <meta charset="UTF-8">
            <title>Registro</title> 
        </head> 
        <body> 
            <h1>Registro Exitoso</h1> 
            <p> 
                Tu folio es '.$folio.'. Sigue al pendiente de nuestras redes sociales
            <b>
            </p> 
        </body> 
    </html> 
    '; 

    //para el envío en formato HTML 
    $headers = "MIME-Version: 1.0\r\n"; 
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

    //dirección del remitente 
    $headers .= "From: Departamento de Misiones <contacto@misionescentralad.com>\r\n"; 

    //ruta del mensaje desde origen a destino 
    $headers .= "Return-path: contacto@misionescentralad.com\r\n"; 

    mail($email,$asunto,$cuerpo,$headers);

}

