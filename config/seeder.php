<?php

return [
    'users' => [
        'count' => 10, // seed a fixed number of users
        'roles' => [
            'developer'=>['all','developer'],
            'admin'=>['all'],
            'owner'=>['crud_owner'],
            'member'=>['crud_own'],
            'guest'=>['read'],
        ],
        // FOLLOWING OTHER USERS
        'following' => [
            'min' => 0,
            'max' => 10,
            'mean' => 50, // %
            'deviation' => 0.5, // Lowest deviation 0.0 - Highest deviation = 1.0
        ],
        'reciprocated' => [
            'min' => 0,
            'max' => 10,
            'mean' => 50, // %
            'deviation' => 0.5, // Lowest deviation 0.0 - Highest deviation = 1.0
        ],
        // SUBSCRIBE TO BOARDS
        'subscribe' => [
            'boards' => [
                'min' => 0,
                'max' => 10,
                'mean' => 50, // %
                'deviation' => 0.5, // Lowest deviation 0.0 - Highest deviation = 1.0
            ],
            'posts' => [
                'min' => 0,
                'max' => 10,
                'mean' => 50, // %
                'deviation' => 0.5, // Lowest deviation 0.0 - Highest deviation = 1.0
            ],
        ],
        'reactions' => [
            'users' => [
                'min' => 0,
                'max' => 50,
                'mean' => 50, // %
                'deviation' => 0.5, // Lowest deviation 0.0 - Highest deviation = 1.0
                'reactions' => ['love'], // array of options to be randomly selected
            ],
            'boards' => [
                'min' => 1,
                'max' => 50,
                'mean' => 50, // %
                'deviation' => 0.5, // Lowest deviation 0.0 - Highest deviation = 1.0
                'reactions' => ['love'], // array of options to be randomly selected
            ],
            'posts' => [
                'min' => 1,
                'max' => 5,
                'mean' => 50, // %
                'deviation' => 0.5, // Lowest deviation 0.0 - Highest deviation = 1.0
                'reactions' => ['love'], // array of options to be randomly selected
            ],
        ],
        'sex' => [
            'male' => '50',
            'female' => '50'
        ],
        'gender' => [
            'heterosexual' => '94.4', // % probability
            'nonbinary' => '5.0', // % probability
            'trangender' => '0.6', // % probability
        ],
    ],

    'boards' => [ // boards per user
        'count' => [
            'min' => 1, // int
            'max' => 5, // int
            'mean' => 50, // %
            'deviation' => 0.5, // Lowest deviation 0.0 - Highest deviation = 1.0
        ],
        'status' => [
            'mean' => 50, // %
            'deviation' => 0.1, // Lowest deviation 0.0 - Highest deviation = 1.0
        ],
        'hashtags' => [
            'min' => 0,
            'max' => 4,
            'mean' => 50, // %
            'deviation' => 0.5, // Lowest deviation 0.0 - Highest deviation = 1.0
        ],
        'categories' => [
            'min' => 0,
            'max' => 3,
            'mean' => 50, // %
            'deviation' => 0.5, // Lowest deviation 0.0 - Highest deviation = 1.0
        ],
    ],

    'posts' => [ // postds per user board
        'count' => [
            'min' => 1,
            'max' => 15,
            'mean' => 30, // %
            'deviation' => 0.5, // Lowest deviation 0.0 - Highest deviation = 1.0
        ],
        'status' => 80, // % chance
        'sensitive' => 20, // % chance
        'mentions' => [
            'min' => 0,
            'max' => 3,
            'mean' => 50, // %
            'deviation' => 0.5, // Lowest deviation 0.0 - Highest deviation = 1.0
        ],
        'hashtags' => [
            'min' => 0,
            'max' => 3,
            'mean' => 50, // %
            'deviation' => 0.5, // Lowest deviation 0.0 - Highest deviation = 1.0
        ],
        'media' => [
            'min' => 0,
            'max' => 4,
            'mean' => 50, // %
            'deviation' => 0.5, // Lowest deviation 0.0 - Highest deviation = 1.0
        ],
        'urls' => [
            'min' => 0,
            'max' => 3,
            'mean' => 50, // %
            'deviation' => 0.5, // Lowest deviation 0.0 - Highest deviation = 1.0
        ],
        'tags' => [
            'min' => 0,
            'max' => 4,
            'mean' => 50, // %
            'deviation' => 0.5, // Lowest deviation 0.0 - Highest deviation = 1.0
        ],
        'categories' => [
            'min' => 0,
            'max' => 3,
            'mean' => 50, // %
            'deviation' => 0.5, // Lowest deviation 0.0 - Highest deviation = 1.0
        ],
        'sources' => [
            'default' => 'web',
            'options' => [
                'web',
                'twitter',
                'youtube',
                'facebook',
                'instagram',
                'linkedin',
                'tumbler',
                'pinterest',
                'redit',
                'quizlets',
                'bbc',
                'cnn',
                'nsm',
                'usatoday',
                'urbandictionary',
                'forbes',
                'cnet',
                'aol',
                'huffpost',
                'thegaurdian',
            ],
        ],
    ],

    'laravel-love' => [
        'options' => [
            'love'=>'5',
            'laugh'=>'4',
            'glow'=>'3',
            'smile'=>'2',
            'like'=>'1',
            'meh'=>'0',
            'dislike'=>'-1',
            'sad'=>'-2',
            'angry'=>'-3',
            'cry'=>'-4',
            'hate'=>'-5',
        ],
    ],

    'laravel-react' => [
        'mass' => 50,
    ],
];
