<?php namespace HomeUp\FollowUpBoss;

class Notes extends FUB
{

    /**
     * @param $person_id
     * @param $subject
     * @param $note
     * @return mixed
     */
    public function add($person_id, $subject, $note)
    {
        $url = $this->api_url . "/notes";

        $data = [
            'personId' => $person_id,
            'subject' => $subject,
            'body' => $note,
            'isHtml' => 0
        ];

        $response = Request::send($url, $data);

        return $response;
    }
}