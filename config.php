<?php
return [
    'callback' => 'index.php',
    'providers' => [
        'Facebook' => [
            'enabled' => true,
            'keys' => ['id' => 'your-facebook-app-id', 'secret' => 'your-facebook-app-secret'],
            'scope' => 'email, public_profile',
        ],
        'Google' => [
            'enabled' => true,
            'keys' => ['id' => 'your-google-client-id', 'secret' => 'your-google-client-secret'],
            'scope' => 'email, profile',
        ],
    ],
    'debug_mode' => false,
    'debug_file' => '',
    
];

