<?php

declare(strict_types=1);

return [
    '/' => [
        'get' => [
            'controller' => 'HomeController',
            'action' => 'index',
        ],
        'post' => [
            'controller' => 'CalculateController',
            'action' => 'calculate',
        ],
    ],
];