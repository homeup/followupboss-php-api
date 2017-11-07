<?php namespace HomeUp\FollowUpBoss;

use GuzzleHttp\Client;

class Request
{

    /**
     * @param $url
     * @param $data
     * @return mixed
     */
    public static function send($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, getenv('FUB_KEY') . ':');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        if ($response === false) {
            exit('cURL error: ' . curl_error($ch) . "\n");
        }

        // check HTTP status code
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($code == 201) {
            return "New contact created.\n";
        } elseif ($code == 200) {
            return "Existing contact updated.\n";
        } else {
            return "Error, status code: {$code}\n";
        }
    }
}