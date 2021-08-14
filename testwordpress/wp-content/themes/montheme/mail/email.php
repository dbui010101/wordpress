<?php
/*
Plugin Name: Email
Plugin URI: http://google.com
Description: Email
Version: 1.0
Author: Tim
Author URI: http://www.wpexplorer.com/create-widget-plugin-wordpress/
*/

// require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
require("sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$email = new \SendGrid\Mail\Mail();
// to: 'pythoncraft2@gmail.com', // Change to your recipient
// from: 'timothee.hennequin@epitech.eu', // Change to your verified sender
// subject: subject+" | "+email,
// text: message,
// html: "<strong>"+message+"</strong>",
$email->setFrom("timothee.hennequin@epitech.eu", "Tim");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("pythoncraft2@gmail.com", "Pi");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid('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');
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
    echo "hello<br>";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
