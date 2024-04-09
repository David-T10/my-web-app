<?php

namespace App\Services;

use GuzzleHttp\Client;

class TwitterService
{
    protected $client;
    protected $apiKey;
    protected $apiSecret;
    protected $accessToken;
    protected $accessTokenSecret;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->apiKey = env('TWITTER_API_KEY');
        $this->apiSecret = env('TWITTER_API_SECRET');
        $this->accessToken = env('TWITTER_ACCESS_TOKEN');
        $this->accessTokenSecret = env('TWITTER_ACCESS_TOKEN_SECRET');
    }

    public function postTweet($content, $picture, $tagNames)
    {
        $endpoint = 'https://api.twitter.com/2/tweets';
        $tweetText = $content . ' ' . implode(' ', $tagNames);
        $mediaData = $this->uploadMedia($picture);

        $response = $this->client->post($endpoint, [
            'auth' => [$this->apiKey, $this->apiSecret],
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getAccessToken(),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'text' => $tweetText,
                'media' => [
                    'media_ids' => [$mediaData['media_id_string']],
                ],
            ],
        ]);

        if ($response->getStatusCode() === 201) {
            return true;
        } else {
            return false;
        }
    }

    protected function uploadMedia($picture)
    {
        $endpoint = 'https://upload.twitter.com/1.1/media/upload.json';

        $response = $this->client->post($endpoint, [
            'auth' => [$this->apiKey, $this->apiSecret],
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getAccessToken(),
            ],
            'multipart' => [
                [
                    'name' => 'media',
                    'contents' => file_get_contents($picture),
                ],
            ],
        ]);

        return json_decode($response->getBody(), true);
    }


    protected function getAccessToken()
    {
        // Implement the logic to obtain an access token using the access token and access token secret
        // You can use a library like 'abraham/twitteroauth' to handle the OAuth authentication process
        // For simplicity, you can directly return the access token if you already have a valid one
        return $this->accessToken;
    }
}