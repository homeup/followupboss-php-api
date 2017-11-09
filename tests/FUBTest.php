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
    public function testALeadCanBeRetrieved()
    {
        $people = new FollowUpBoss\People($this->key);

        $person = $people->find("john.smith@example.com");

        $this->assertEquals("John", $person->firstName);
        $this->assertEquals("Smith", $person->lastName);

        unset($fub);
    }

    /**
     * Test to make sure the class can be called
     */
    public function testALeadCanBeSavedToFub()
    {
        $fub = new FollowUpBoss\Events($this->key);

        $data = [
            "firstName" => "John",
            "lastName" => "Smith",
            "emails" => [["value" => "john.smith@example.com"]],
            "phones" => [["value" => "555-555-5555"]],
            "tags" => ["Free Market Report"],
            "customKidsNames" => "Sally & Joe"
        ];

        $response = $fub->saveLead($data);

        $this->assertEquals("John Smith", $response->name);

        unset($fub);
    }

    /**
     * Test to make sure the class can be called
     */
    public function testAnInquiryCanBeSavedToFub()
    {
        $fub = new FollowUpBoss\Events($this->key);

        $lead = [
            "emails" => [["value" => "john.smith@example.com"]]
        ];

        $response = $fub->inquiry($lead, "This is a sample message being sent from a form", "Property Inquiry", [
            "street" => "6825 Mulholland Dr",
            "city" => "Los Angeles",
            "state" => "CA",
            "code" => "90068",
            "mlsNumber" => "14729339",
            "price" => "310000",
            "forRent" => "0",
            "url" => "http://urbanupgrade.ca",
            "type" => "Residential"
        ]);

        $this->assertEquals("John Smith", $response->name);
        $this->assertEquals(2735, $response->id);

        unset($fub);
    }

    /**
     * Test to make sure the class can be called
     */
    public function testANoteCanBeSavedToALead()
    {
        $fub = new FollowUpBoss\Notes($this->key);

        $note = "Test body of the note";
        $response = $fub->add(2735, "Test Subject", $note);

        $this->assertEquals($note, $response->body);

        unset($fub);
    }

    /**
     * Test to make sure the class can be called
     */
    public function testEventsCanBeRetrieved()
    {
        $fub = new FollowUpBoss\Events($this->key);

        $response = $fub->get(2735, "Viewed Page");

        $this->assertEquals("Viewed Page", $response->events[0]->type);

        unset($fub);
    }

    /**
     *
     */
    public function testAPageViewCanBeSaved()
    {
        $fub = new FollowUpBoss\Events($this->key);

        $response = $fub->get(2735, "Viewed Page");

        $this->assertEquals("Viewed Page", $response->events[0]->type);

        $count = count($response->events);

        $fub->pageView(["emails" => [["value" => "john.smith@example.com"]]], "Test Page Title", "http://rertest.dev");

        $all_events = $fub->get(2735, "Viewed Page");
        $new_count = count($all_events->events);

        $this->assertTrue($count < $new_count);

        unset($fub);
    }

    /**
     *
     */
    public function testAListingViewCanBeSaved()
    {
        $fub = new FollowUpBoss\Events($this->key);

        $fub->listingView(["emails" => [["value" => "john.smith@example.com"]]], [
            "street" => "6825 Mulholland Dr",
            "city" => "Los Angeles",
            "state" => "CA",
            "code" => "90068",
            "mlsNumber" => "14729339",
            "price" => "310000",
            "forRent" => "0",
            "url" => "http://urbanupgrade.ca",
            "type" => "Residential"
        ]);

        $response = $fub->get(2735, "Viewed Property");

        $this->assertEquals("Viewed Property", $response->events[0]->type);

        $count = count($response->events);

        $fub->listingView(["emails" => [["value" => "john.smith@example.com"]]], [
            "street" => "6825 Mulholland Dr",
            "city" => "Los Angeles",
            "state" => "CA",
            "code" => "90068",
            "mlsNumber" => "14729339",
            "price" => "310000",
            "forRent" => "0",
            "url" => "http://urbanupgrade.ca",
            "type" => "Residential"
        ]);

        $all_events = $fub->get(2735, "Viewed Property");
        $new_count = count($all_events->events);

        $this->assertTrue($count < $new_count);

        unset($fub);
    }

    /**
     *
     */
    public function testAnActionPlanCanBeAssignedToAPerson()
    {
        // Try and assign Property Listing Process with ID 4
        $ap = new FollowUpBoss\ActionPlans($this->key);

        $response = $ap->assign(2735, 4);

        $this->assertEquals("Running", $response->status);
    }

    /**
     *
     */
    public function testActionPlansCanBeCalled()
    {
        $ap = new FollowUpBoss\ActionPlans($this->key);

        $plans = $ap->get()->actionPlans;

        $found = false;
        foreach($plans as $plan)
        {
            if($plan->name == "Annual Follow Up")
            {
                $found = true;
                break;
            }
        }

        $this->assertTrue($found);
    }

}