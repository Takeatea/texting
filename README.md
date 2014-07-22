# Take a tea Texting [![Build Status](https://travis-ci.org/Takeatea/texting.svg?branch=master)](https://travis-ci.org/Takeatea/texting) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/3de45443-71c0-49a3-8b99-83c8cc905fbf/mini.png)](https://insight.sensiolabs.com/projects/3de45443-71c0-49a3-8b99-83c8cc905fbf)
Take a tea Texting is a component to allow you to send SMS. It ships with couple of native providers :
- allmysms.com
- smsenvoi.com

It also have always passing/failing providers for development purpose.

## Installation
Add the component into your composer.json :

    "require": {
        ...
        "takeatea/texting": "dev-master"
    }

Then run a `composer update` to fetch the lib

## Usage
The workflow is pretty straight straightforward :
- instantiate the manager
- instantiate a provider
- register the provider to the manager
- send your sms

**Exemple using the "always passing" provider**

    <?php

    include __DIR__ . '/vendor/autoload.php';

    $provider = new Takeatea\Component\Texting\Provider\AlwaysOkProvider();
    $manager = new Takeatea\Component\Texting\Manager\TextingManager();
    $manager->registerProvider($provider);

    $manager->send('+33101010101', 'My test message');

Also, the component support multiple providers

**Exemple with allmysms.com provider and the "always passing" provider**

    <?php

    include __DIR__ . '/vendor/autoload.php';

    $guzzle = new GuzzleHttp\Client();
    $provider = new Takeatea\Component\Texting\Provider\AllMySmsProvider('username', 'password', $guzzle);
    $alwaysOkProvider = new Takeatea\Component\Texting\Provider\AlwaysOkProvider();

    $manager = new Takeatea\Component\Texting\Manager\TextingManager();
    $manager->registerProvider($alwaysOkProvider);
    $manager->registerProvider($provider);

    $manager->send('+33101010101', 'My test message', $provider->getName());

In this case, allmysms provider will be used. If no name is provided as third argument, the manager will pick the first registered provider; the "always passing" one.

## License
This library is released under the MIT license. See the attached file for more informations.

## Contribute
Feel free to contribute and bring new providers, we will be glad to integrate them. To do so, send us a pull-request on https://github.com/Takeatea/texting
