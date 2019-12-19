<?php
return [
    'view_admin' => [
        'type' => 2,
    ],
    'view_agent' => [
        'type' => 2,
    ],
    'view_partner_manager' => [
        'type' => 2,
    ],
    'guest' => [
        'type' => 1,
        'ruleName' => 'userGroup',
    ],
    'admin' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'view_admin',
        ],
    ],
    'agent' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'view_agent',
        ],
    ],
    'partner_manager' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'view_partner_manager',
        ],
    ],
];
