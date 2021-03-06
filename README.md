# Follow Up Boss PHP API
PHP Interface for working with the Follow Up Boss API

How To Use
--------
First, download the package

`composer require homeup/followupboss-php-api`

Then, add a couple lines to your .env file.  If you don't have one, create and gitignore it

```
FUB_KEY=my_fub_key
FUB_SOURCE=website_url_or_name
```


Then you can simply use any of the following commands to send data to FollowUp Boss.

To get lead data from FUB:

```php
$people = new HomeUp\FollowUpBoss\People();
$person = $people->find("test@example.com");
```

To send in lead data:

```php
$events = new HomeUp\FollowUpBoss\Events();
$events->saveLead([
    'firstName', 'John',  
    'lastName' => 'Smith',  
    'emails' => [['value' => 'johnsmith@example.com']], 
    'phones' => [['value' => '555-555-5555']],
    'tags' => ['Free Market Report']
]);
```

You can also send in the inquiry event (example data: https://docs.followupboss.com/reference#events-post)
```php
$events->inquiry(
    ['emails' => [['value' => 'johnsmith@example.com']]], // Lead data
    "The main body of the inquiry goes here",  // Body of inquiry
    "Enter Type of Inquiry", // Example: "Property Inquiry" or "Registration"
    [optional_property_data], 
    [optional_property_search_data], 
    [optional_campaign_data]
]);
```

You can also send in page and listing views like so (example data: https://docs.followupboss.com/reference#events-post)
```php
$events->listingView(
    ['emails' => [['value' => 'johnsmith@example.com']]], // Lead data
    [property_data],
]);

$events->pageView(
    ['emails' => [['value' => 'johnsmith@example.com']]], // Lead data
    "Title of the Page",
    "http://example.com/about", // URL of the page
);
```

You can add notes to leads

```php
$notes = new HomeUp\FollowUpBoss\Notes();
$notes->add(id_of_person, "This is the subject of the note", "This is the body of the note");
```

You can assign an action plan to a lead and retrieve a list of all action plans

```php
$ap = new HomeUp\FollowUpBoss\ActionPlans();

$plans = $ap->get()->actionPlans;

$ap->assign(id_of_person, $plans[0]->id);
```