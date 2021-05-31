<?php

header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

include('apiClass.php');


echo "me han solicitado ".$_SERVER['REQUEST_METHOD'];

if( isset($_GET["module"]) )
{
    $api_url = "";
    switch($_GET["module"])
    {
        case "saturngames-games":
            $api_url = "https://itp-hll-sd-01.azurewebsites.net/games.php";
            break;
        case "saturngames-users":
            $api_url = "https://itp-hll-sd-01.azurewebsites.net/users.php";
            break;
        case "kourindou-products":
            $api_url = "https://itp-kab-sd-01.azurewebsites.net/products.php";
            break;
        case "kourindou-shoppingcart":
            $api_url = "https://itp-kab-sd-01.azurewebsites.net/shoppingcart.php";
            break;
        case "library":
            $api_url = "https://itp-marm-api-libros.azurewebsites.net/API.php";
            break;
        default:
            $result = array();
            $result["success"] = false;
            $result["error"] = "Parámetro module incorrecto";

            echo json_encode($result);
            break;
    }

    $api = new SDAPI($api_url);

    

    switch($_SERVER['REQUEST_METHOD'])
    {
        case "GET":

            echo $api->callAPI("GET", $_GET);
            break;
        case "POST":

            echo $api->callAPI("POST", $_GET, file_get_contents('php://input'));
            break;
        case "PUT":

            echo $api->callAPI("PUT", $_GET, file_get_contents('php://input'));
            break;
        case "DELETE":

            echo $api->callAPI("DELETE", $_GET);
            break;
        default:
        
            header("HTTP/1.1 400 Bad request");
            break;
    }

}
else
{
    $result = array();
    $result["success"] = false;
    $result["error"] = "Parámetro module incorrecto";

    echo json_encode($result);
}


?>