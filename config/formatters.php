<?php

return [

    /*
    | Here you can set all formatters that the Laravel service provider will load,
    | automatically but only when the service is called (deferred service provider).
    */
    'formatters' => [
        JeroenG\TextConveyor\Formatters\CommonMark::class,
    ],

];
