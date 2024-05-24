<?php

namespace App\Services;

require_once(__DIR__ . '/../../vendor/autoload.php');

use Illuminate\Support\Facades\Cache;

class VideoAPIService
{
    // -----------------------------------------------------------------------------------------
    // This method get videos data from the API Youtube Data API and return it on a array $video
    // -----------------------------------------------------------------------------------------
    public function getDataFromAPI()
    {
<<<<<<< HEAD
            // Appel API
            $apiKey = 'AIzaSyAR6DEibOoxaZpRwzkypwtt9ZtbFmSOwVE';
            $channelID = 'UCvSfxFYLFImHcmi9BQMwKQw';
=======
        $apiKey = 'AIzaSyAR6DEibOoxaZpRwzkypwtt9ZtbFmSOwVE';
        $channelID = 'UCvSfxFYLFImHcmi9BQMwKQw';

        $channelUrl = "https://www.googleapis.com/youtube/v3/search?key=$apiKey&channelId=$channelID&part=snippet,id&order=date&maxResults=50";
        $response = file_get_contents($channelUrl);
        $data = json_decode($response);
>>>>>>> 88cfd73d217a0f5b06ce05a991b9dbd452c3dde8

        $videos = [];

<<<<<<< HEAD
            $videos = [];
            // Boucle sur la réponse pour refaire une appel API sur les vidéos cete fois-ci pour récupérer
            // des informations supplémentaires, comme une description compléte.
            foreach ($data->items as $item) {
                if ($item->id->kind === "youtube#video") {
                    $videoID = $item->id->videoId;
                    $videoUrl = "https://www.googleapis.com/youtube/v3/videos?id=$videoID&key=$apiKey&part=snippet";
                    $videoResponse = file_get_contents($videoUrl);
                    $videoData = json_decode($videoResponse);
                    $videos[] = $videoData;
                }
            }
=======
        foreach ($data->items as $item) {
            if ($item->id->kind === "youtube#video") {
                $videoID = $item->id->videoId;
                $videoUrl = "https://www.googleapis.com/youtube/v3/videos?id=$videoID&key=$apiKey&part=snippet";

                $videoResponse = file_get_contents($videoUrl);
                $videoData = json_decode($videoResponse);

                $videos[] = $videoData;

            }
        }

>>>>>>> 88cfd73d217a0f5b06ce05a991b9dbd452c3dde8
        return $videos;
    }
}
