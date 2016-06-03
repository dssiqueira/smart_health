<?php
$smartCanvas = array();
$smartCanvas["title"] = "Post Runners";
$smartCanvas["cover"] = "http://lorempixel.com/320/240/city";
//$smartCanvas["shareWith"] = ["organization", "5712425286369280"];
$smartCanvas["content"] = "test app";
//$smartCanvas["boards"] = [];
//$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.runkeeper.com/fitnessActivities?pageSize=1",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "accept: application/vnd.com.runkeeper.FitnessActivityFeed+json",
    "authorization: Bearer 4efd210f1dfb43ba97b877ca52ffaa4b",
    "cache-control: no-cache",
    "postman-token: 922e76fe-08f6-65cb-729a-d7b332ad3d7c"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $result = json_decode($response);

  $type = $result->items[0]->type;
  $distance = number_format(($result->items[0]->total_distance) / 1000, 3);
  $calories = $result->items[0]->total_calories;
}
?>