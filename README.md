Premailer PHP Wrapper
====

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
 - Tests
 - Documentation

