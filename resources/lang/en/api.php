<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Api Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during api for various
    | messages that we need to display to the user.
    |
    */

    'auth' => [
        'failed' => [
            "login" => ["message"=>'These credentials do not match our records.']
        ],
        'success' => [
            "logout" => ["message" => 'You have been logged out successfully'],
        ],
    ],

    'resource' => [
        'notfound' => "The selected :resource with id=:id not found",
    ]

];
