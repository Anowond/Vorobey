<?php

require_once(__DIR__ . '/vendor/autoload.php');

$apiKey = 'AIzaSyAR6DEibOoxaZpRwzkypwtt9ZtbFmSOwVE';
$channelID = 'UCvSfxFYLFImHcmi9BQMwKQw';
$channelUrl = "https://www.googleapis.com/youtube/v3/search?key=$apiKey&channelId=$channelID&part=snippet,id&order=date&maxResults=10";

$response = file_get_contents($channelUrl);
$data = json_decode($response);

foreach ($data->items as $item) {
    $videoID = $item->id->videoId;
    $videoUrl = "https://www.googleapis.com/youtube/v3/videos?id=$videoID&key=$apiKey&part=snippet";


    $response = file_get_contents($videoUrl);
    $data = json_decode($response);
    dump($data);

    $title = $item->snippet->title;
    $description = $data->items[0]->snippet->description;
    $thumbnail = $item->snippet->thumbnails->default->url;

    // echo "<h1>$title</h1>";
    // echo "<iframe width='800' height='600' src='https://www.youtube.com/embed/$videoID' allowfullscreen></iframe>";
    // echo "<p>$description</p>";
}
