<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        // Renderer settings
        'renderer' => [
            'template_path' => '../templates/',
        ],
        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => '../logs/app.log' ,
            'level' => \Monolog\Logger::DEBUG,
        ],
        'db' => [
            'host' => 'localhost',
            'user' => 'root',
            'pass' => '',
            'dbname' => 'guj',
        ],
    ],
];