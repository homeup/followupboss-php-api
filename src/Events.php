<?php namespace HomeUp\FollowUpBoss;

class Events extends FUB
{
    /**
     * @param $lead
     * @return mixed
     */
    public function saveLead($lead)
    {
        $data = ["source" => $this->source, "type" => "Registration"];

        $data['person'] = $lead;

        $url = $this->api_url . "/events";
        $response = Request::send($url, $data);

        return $response;
    }

    /**
     * @param $lead
     * @param $message
     * @param string $type
     * @param null $property
     * @param null $propertySearch
     * @param null $campaign
     * @return mixed
     */
    public function inquiry($lead, $message, $type = "Registration", $property = null, $propertySearch = null, $campaign = null)
    {
        $data = ["source" => $this->source, "type" => $type];

        $data['person'] = $lead;
        $data['message'] = $message;
        $data['property'] = $property;
        $data['propertySearch'] = $propertySearch;
        $data['campaign'] = $campaign;

        $url = $this->api_url . "/events";
        $response = Request::send($url, $data);

        return $response;
    }

    /**
     * @param $lead
     * @param $listing
     * @return mixed
     */
    public function listingView($lead, $listing)
    {
        $data = ["source" => $this->source, "type" => "Viewed Property"];

        $data['person'] = $lead;

        $data['property'] = $listing;

        $url = $this->api_url . "/events";
        $response = Request::send($url, $data);

        return $response;
    }

    /**
     * @param $lead
     * @param $page_title
     * @param $url
     * @param null $duration
     * @return mixed
     */
    public function pageView($lead, $page_title, $url, $duration = null)
    {
        $data = ["source" => $this->source, "type" => "Viewed Page"];

        $data['person'] = $lead;

        $data['pageTitle'] = $page_title;
        $data['pageUrl'] = $url;
        if(!empty($duration))
            $data['pageDuration'] = $duration;

        $url = $this->api_url . "/events";
        $response = Request::send($url, $data);

        return $response;
    }
}