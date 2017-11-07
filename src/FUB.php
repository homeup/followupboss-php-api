<?php namespace HomeUp\FollowUpBoss;

class FUB
{
    private $base_url;
    private $key;

    /**
     * Request constructor.
     * @param $key
     */
    public function __construct($key = null)
    {
        if(empty($key) && empty(getenv('FUB_KEY')))
            throw new \Exception("Please add your Follow Up Boss API key to the .env file");

        if(empty(getenv('HOMEUP_BASE_URL')))
            throw new \Exception("Base URL required in .env file");

        $this->key = !empty($key) ? $key : getenv('FUB_KEY');
    }

    /**
     * @param $lead
     * @return mixed
     */
    public function saveLead($lead)
    {
        $data = ["source" => $this->base_url, "type" => "Registration"];

        $data['person'] = $lead;

        $response = Request::send('https://api.followupboss.com/v1/events', $data);

        return $response;
    }
}