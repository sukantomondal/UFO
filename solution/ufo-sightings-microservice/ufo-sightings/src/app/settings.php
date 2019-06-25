<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

         // Database connection settings           
          "db" => [
            "host" => "localhost",
            "dbname" => "ufo_sightings",
            "user" => "devufo",
            "pass" => "devufo"
        ],
    ],
];
