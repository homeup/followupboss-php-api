# Follow Up Boss PHP API
PHP Interface for working with the Follow Up Boss API

How To Use
--------

First, add a couple lines to your .env file.  If you don't have one, create and gitignore it

FUB_KEY=my_fub_key

FUB_SOURCE=website_url_or_name

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
$events->inquiry([
    'firstName', 'John',  
    'lastName' => 'Smith',  
    'emails' => [['value' => 'johnsmith@example.com']], 
    'phones' => [['value' => '555-555-5555']],
    'tags' => ['Free Market Report']
], "The main body of the inquiry goes here", "Property Inquiry", [optional_property_data], [optional_property_search_data], [optional_campaign_data]);
```

You can add notes to leads

```php
$notes = new HomeUp\FollowUpBoss\Notes();
$notes->add(1234, "This is the subject of the note", "This is the body of the note");
```