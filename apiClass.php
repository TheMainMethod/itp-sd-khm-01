<?php

class SDAPI
{
    private $curl;
    private $url;

    function __construct($api_url)
    {
        $this->url = $api_url;
        $this->curl = curl_init();
    }


    function __destruct()
    {
        curl_close($this->curl);
    }

    function callAPI($method, $get, $body = array())
    {

        curl_setopt($this->curl, CURLOPT_URL, $this->url."?".http_build_query($get));
        /* switch($method)
        {
            case "POST":
                curl_setopt($this->curl, CURLOPT_POST, true);
                break;
            case "PUT":
                curl_setopt($this->curl, CURLOPT_PUT, true);
                break;
            case "DELETE":
                break;
            default:
                break;

        } */
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt(
            $this->curl,
            CURLOPT_HTTPHEADER,
            array(
                'Accept: application/json',
                'Content-Type: application/json',
            )
        );

        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $body);

        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($this->curl);

        return $result;
    }

}

?>