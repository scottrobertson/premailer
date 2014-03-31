Premailer PHP Wrapper
====

![Build Status](https://www.codeship.io/projects/22f3a3a0-9b4c-0131-14bd-7a152f4f5052/status)

[![Latest Stable Version](https://poser.pugx.org/scottrobertson/premailer/v/stable.png)](https://packagist.org/packages/scottrobertson/premailer) [![Total Downloads](https://poser.pugx.org/scottrobertson/premailer/downloads.png)](https://packagist.org/packages/scottrobertson/premailer) [![Latest Unstable Version](https://poser.pugx.org/scottrobertson/premailer/v/unstable.png)](https://packagist.org/packages/scottrobertson/premailer) [![License](https://poser.pugx.org/scottrobertson/premailer/license.png)](https://packagist.org/packages/scottrobertson/premailer)


Pre-flight for HTML email - PHP Wrapper.

http://premailer.dialect.ca


# Example
```php
<?php

require __DIR__ . '/vendor/autoload.php';

$premailer = new ScottRobertson\Premailer\Request();

// Convert our HTML email using Premailer
$response = $premailer->convert('<h1>Hi</h1>');

// Download the generated HTML file from Premailer
echo $response->downloadHtml();
```

# Todo
 - Documentation

