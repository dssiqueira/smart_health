<?php
$smartCanvas["content"] = " <p>Type: $type</p>
                            <p>Distance: $distance KM</p>
                            <p>Calories: $calories</p>";
$post_smartCanvas = json_encode($smartCanvas);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api-dev.smartcanvas.com/v1/posts",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $post_smartCanvas,
  CURLOPT_HTTPHEADER => array(
    "api-key: hltklw9Tt3XP",
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: 4527f4e0-3028-be47-63fb-0e5f564f9131"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  print "\n\n\n Postado no Smart Canvas - ID: " . $response;
}
?>
