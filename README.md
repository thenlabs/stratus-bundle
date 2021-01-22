
# ThenLabsStratusBundle

Extends Symfony to the full stack development with integration of [StratusPHP][stratus-php-repo].

**Notice: Like [StratusPHP][stratus-php-repo], this project is also in development and should not be used in a real project yet.**

## Installation.

Install StratusPHP specifying the development version.

    $ composer require thenlabs/stratus-php 1.0.x-dev

Install the maker bundle in case it isn't.

    $ composer require symfony/maker-bundle --dev

Install this bundle:

    $ composer require thenlabs/stratus-bundle dev-master

## Usage.

### Creating reactive pages.

Once the installation has finished we can create the application pages that will bring the integration with StratusPHP.

In order to create a new page run the next command:

    $ php bin/console make:stratus-page main

In this case, "main" refers to the page name.

![](1.png)

As you can see, they was created three files, a template, a controller, and a class. You can review these files and edit it according to the project needs.

In the controller class you can fix the page route. By default will be like the page name, `/main` in this case.

The template file is empty by default but you should edit it with the page view.

In this example we will develop the [Example 2](https://thenlabs.org/en/doc/stratus-php/master/examples/2/example.html) of the StratusPHP docs.

```twig
{# templates/main-stratus-page.html.twig #}

{% extends 'base.html.twig' %}

{% block body %}
    <input s-element="myInput" type="text">
    <label s-element="myLabel"></label>
    <button s-element="myButton" s-element-event-click="clickOnTheButton">Greet</button>
{% endblock %}
```

>It’s very important highligh the `s-element` attribute and his value on key elements of the page view.

```php
<?php
// src/StratusPage/MainStratusPage.php

namespace App\StratusPage;

use ThenLabs\Bundle\StratusBundle\Annotation\StratusPage;
use ThenLabs\Bundle\StratusBundle\AbstractPage;

/**
 * @StratusPage(template="main-stratus-page.html.twig")
 */
class MainStratusPage extends AbstractPage
{
    public function clickOnTheButton(): void
    {
        $this->myLabel->textContent = 'Hello ' . $this->myInput->value;
    }
}
```

#### Testing results.

    $ symfony server:start

Now, if we access to the `http://localhost:8000/main/` we will obtains the next results.

![](2.gif)

[stratus-php-repo]: https://github.com/thenlabs/stratus-php
