<?php
class smartCanvasAPI {
    public $api_key     = 'xxxxxxxxxxxxxx';
    public $url_POST    = 'xxxxxxxxxxxxxx';
    public $url_GET     = 'xxxxxxxxxxxxxx';
    public $url_DELETE  = 'xxxxxxxxxxxxxx';
    public $url_PUT     = 'xxxxxxxxxxxxxx';
    
    public function postCard($title, $content, $shareWith, $cover, $boards = '[]', $tags = '[]') {
        $curl = curl_init();
        
        $smartCanvas = new smartCanvasAPI();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $smartCanvas->url_POST,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\r\n    \"title\": \"$title\",
                                \r\n    \"content\": \"$content\",
                                \r\n    \"shareWith\": $shareWith,
                                \r\n    \"cover\": \"$cover\",
                                \r\n    \"boards\": $boards,
                                \r\n    \"tags\": $tags\r\n}",
        CURLOPT_HTTPHEADER => array(
            "api-key: $smartCanvas->api_key",
            "cache-control: no-cache",
            "content-type: application/json"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        echo $response;
        }
    }   
}
?>