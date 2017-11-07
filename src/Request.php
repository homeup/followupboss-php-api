<?php namespace HomeUp\FollowUpBoss;

use GuzzleHttp\Client;

class Request
{

    /**
     * @param $url
     * @param string $request_type
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public static function send($url, $data = null, $request_type = "POST")
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, getenv('FUB_KEY') . ':');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request_type);
        if(!empty($data))
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        if ($response === false) {
            exit('cURL error: ' . curl_error($ch) . "\n");
        }

        // check HTTP status code
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($code == 201) {
            error_log("New contact created.\n");
        } elseif ($code == 200) {
            error_log("Existing contact updated.\n");
        } else {
            var_dump($response);
            throw new \Exception("Error, status code: {$code}\n");
        }

        curl_close($ch);

        return json_decode($response);
    }
}