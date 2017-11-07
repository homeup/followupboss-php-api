<?php namespace HomeUp\FollowUpBoss;

class People extends FUB
{
    /**
     * @param $email
     * @return mixed
     */
    public function find($email)
    {
        $url = $this->api_url . "/people?email=$email";

        $response = Request::send($url, null,"GET");

        return $response->people[0];
    }
}