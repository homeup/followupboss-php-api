<?php namespace HomeUp\FollowUpBoss;

class ActionPlans extends FUB
{
    /**
     * @return mixed
     */
    public function get()
    {
        $url = $this->api_url . "/actionPlans";

        $response = Request::send($url, null, "GET");

        return $response;
    }
    /**
     * @param $person_id
     * @param $action_plan_id
     * @return mixed
     */
    public function assign($person_id, $action_plan_id)
    {
        $url = $this->api_url . "/actionPlansPeople";

        $data = [
            'personId' => $person_id,
            'actionPlanId' => $action_plan_id,
        ];

        $response = Request::send($url, $data);

        return $response;
    }
}