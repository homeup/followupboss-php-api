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
}