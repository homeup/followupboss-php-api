<?php namespace HomeUp\FollowUpBoss;

class FUB
{
    private $source;
    private $key;

    /**
     * Request constructor.
     * @param $key
     * @throws \Exception
     */
    public function __construct($key = null)
    {
        if(empty($key) && empty(getenv('FUB_KEY')))
            throw new \Exception("Please add your Follow Up Boss API key to the .env file");

        if(empty(getenv('FUB_SOURCE')))
            throw new \Exception("Please add the source to the env file");

        $this->source = getenv('FUB_SOURCE');
        $this->key = !empty($key) ? $key : getenv('FUB_KEY');
    }

    /**
     * @param $lead
     * @return mixed
     */
    public function saveLead($lead)
    {
        $data = ["source" => $this->source, "type" => "Registration"];

        $data['person'] = $lead;

        $response = Request::send('https://api.followupboss.com/v1/events', $data);

        return $response;
    }
}