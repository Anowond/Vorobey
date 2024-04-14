<?php

namespace App\Services;

require_once(__DIR__ . '/../../vendor/autoload.php');

use Illuminate\Support\Facades\Cache;

class VideoAPIService
{
    public function getDataFromAPI()
    {

        // Si le cache est vide, alors on fait un appel API
        if (Cache::has('videos')) {

            return Cache::get('videos');

        } else {

            $apiKey = 'AIzaSyAR6DEibOoxaZpRwzkypwtt9ZtbFmSOwVE';
            $channelID = 'UCvSfxFYLFImHcmi9BQMwKQw';

            $channelUrl = "https://www.googleapis.com/youtube/v3/search?key=$apiKey&channelId=$channelID&part=snippet,id&order=date&maxResults=50";
            $response = file_get_contents($channelUrl);
            $data = json_decode($response);

            $videos = [];

            foreach ($data->items as $item) {
                if ($item->id->kind === "youtube#video") {
                    $videoID = $item->id->videoId;
                    $videoUrl = "https://www.googleapis.com/youtube/v3/videos?id=$videoID&key=$apiKey&part=snippet";

                    $videoResponse = file_get_contents($videoUrl);
                    $videoData = json_decode($videoResponse);

                    $videos[] = $videoData;

                }
            }

            // Mise en cache pour 24h
            Cache::put('videos', $videos, 86400);

            return Cache::get('videos');
        }
    }
}
