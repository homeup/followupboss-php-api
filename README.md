# Follow Up Boss PHP API
PHP Interface for working with the Follow Up Boss API

How To Use
--------

First, add a couple files to your .env file.  If you don't have one, create and gitignore it
FUB_KEY=MY_FUB_KEY
HOMEUP_BASE_URL=BASE_URL_OF_YOUR_WEBSITE

Now, you should be able to initiate your class

```php
$fub = new HomeUp\FollowUpBoss\FUB();
```

Then you can simply use any of the following commands to send data to FollowUp Boss.

To send in lead data:

```php
$fub->saveLead(['firstName', 'John',  'lastName' => 'Smith',  'emails' => [['value' => 'johnsmith@example.com']], 'phones' => [['value' => '555-555-5555']],'tags' => ['Free Market Report']]);
```
