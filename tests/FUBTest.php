<?php

use HomeUp\FollowUpBoss;
use HomeUp\FollowUpBoss\FUB;

/**
 *  Corresponding Class to test YourClass class
 *
 *  For each class in your library, there should be a corresponding Unit-Test for it
 *  Unit-Tests should be as much as possible independent from other test going on.
 *
 *  @author yourname
 */
class HomeUpTest extends PHPUnit_Framework_TestCase{

    protected $key;
    protected $secret;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $dotenv = new Dotenv\Dotenv(__DIR__ . "/..");
        $dotenv->load();

        $this->key = getenv('FUB_KEY');
    }

    /**
     * Test to make sure the class can be called
     */
    public function testALeadCanBeSavedToFub()
    {
        $fub = new FUB($this->key);

        $data = [
            "firstName" => "John",
            "lastName" => "Smith",
            "emails" => [["value" => "john.smith@example.com"]],
            "phones" => [["value" => "555-555-5555"]],
            "tags" => ["Free Market Report"]
        ];

        $fub->saveLead($data);

        unset($fub);
    }

}