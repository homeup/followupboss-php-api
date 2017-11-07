<?php namespace HomeUp\FollowUpBoss;

class FUB
{
    private $api_base_url = "https://api.followupboss.com";
    private $api_version = "v1";
    protected $api_url;
    protected $source;
    protected $key;

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
        $this->api_url = $this->api_base_url . "/" . $this->api_version;
    }
}