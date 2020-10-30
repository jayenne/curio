<?php

return [
    'app' => [
        'protocol' => 'https://',
        'url' => env('APP_URL_LIVE', env('APP_DOMAIN')),
        'name' => config('app.name'),
        'strapline' => ("Social Curation"),
    ],
    'database' => [
        'users' => [
            'account_types' => [
                'default' => 'basic',
                'options' => [
                    'basic' => 'Basic',
                    'varified' => 'varified',
                ],
            ]
        ],
        'boards' => [
           'posts_limit' => 6,
           'layouts' => [
                'default' => 'packery',
                'options' => [
                    'packery' => 'Columns',
                    'fitRows' => 'Grid',
                    'vertical' => 'Rows',
                ]
            ],
            'orderby' => [
                'default' => 'created_at',
                'options' => [
                    'created_at' => 'Date',
                    'post_order' => 'Placement',
                ]
            ],
            'columns' => [
                'default' => '3',
                'options' => [
                    '12' => 'Most',
                    '6' => 'More',
                    '4' => 'Default',
                    '3' => 'Fewer',
                    '2' => 'Fewest',
                ],
                'classes' => [
                    '12' => 'col-sm-12 col-md-1',
                    '6' => 'col-sm-12 col-md-2',
                    '4' => 'col-sm-12 col-md-3',
                    '3' => 'col-sm-12 col-md-4',
                    '2' => 'col-sm-12 col-md-6',//'col-sm-12 col-md-4 col-xl-3'
                ]
            ],
            'themes' => [
                'default' => 'default',
                'options' => [
                    'default',
                    'newspaper',
                    'stickies',
                    'chalkoard',
                    'whiteboard',
                ]
            ],
            'status' => [
                'default' => 'public',
                'options' => [
                    'private' => 'Private',
                    'subscriber' => 'Subscriber',
                    //'follower' => 'My followers',
                    //'following' => 'I`m following',
                    //'followback' => 'We follow eachother',
                    'public' => 'Public',
                ]
            ],
        ],
        'posts' => [
            'types' => [
                'default' => 'text',
                'options' => [
                    'text',
                    'photo',
                    'video',
                    'animated_gif',
                    'audio',
                ]
            ],
            'themes' => [
                'default' => 'card',
                'options' => [
                    'card',
                    'sticky',
                ]
            ],
            'status' => [
                'default' => 'public',
                'options' => [
                    'private',
                    'subscriber',
                    'follower',
                    'following',
                    'followback',
                    'public',
                ]
            ],
        ],
    ],
    'cache' => [
        'users' => [
            'online' => 5,//minutes
        ]
    ],
    'pagination' => [
        'default' => 15,
        'users' => 15,
        'boards' => 15,
        'posts' => 15,
    ],
    'twitter' => [
        'destroy' => false,
        'listener_id' => env('TWITTER_LISTENER_ID'),
        'listener_handle' => env('TWITTER_LISTENER_HANDLE'),
        'listener_screen_name' => env('TWITTER_LISTENER_SCREEN_NAME'),
        'listener_hashtags' => env('TWITTER_LISTENER_HASHTAGS'),
        'token' => env('TWITTER_ACCESS_TOKEN'),
        'secret' => env('TWITTER_ACCESS_TOKEN_SECRET'),
        'tag_pattern' => env('TWITTER_TAG_PATTERN', 'hash_colon_bang'),
        'test_account_id' => '3000477125',
    ],
    'scheduled_image_update' => [
        'current_filename' => 'current.jpg',
        'library_directory' => 'library/',
        'used_directory' => 'used/',
        'root_directory' => 'public/images/daily/',
    ],
    'path' => [
        'image' => [
            'post' => '/storage/media/images/',
            'avatar' => '/storage/images/avatar/',
        ],
        'video' => [
            'post' => '/storage/media/videos/'
        ],
        'view' => [
            'users' => 'models.users.',
            'boards' => 'models.posts.',
            'posts' => 'models.posts.',
        ],
    ],
    'profiles' => [
        'ages' => [
            'min' => 13,
            'max' => 80,
            'mean' => 50, // %
            'deviation' => 0.5, // Lowest deviation 0.0 - Highest deviation = 1.0
        ],
        'sex' => [
            'options' => [
                'male',
                'female',
            ],
            'mean' => 50, // %
            'deviation' => 0.5, // Lowest deviation 0.0 - Highest deviation = 1.0
        ],
        'gender' => [
            'options' => [
                'heterosexual',
                'transgender',
                'nonbinary',
            ],
            'mean' => 50, // %
            'deviation' => 0.5, // Lowest deviation 0.0 - Highest deviation = 1.0
        ],
    ],
    'presets' => [
        'post' => [
            'title_length' => 30,
            'text_length' => 250,
            'tag_pattern' => [
                'hash_colon_bang' => '/(?:(?:#)(?=(test)|([btlnc]+))(?:[a-zA-Z]*)(?::)(?:([^\s|^!][a-zA-Z0-9,-_."\'\s!]+)(?:!))(?=(?:!)*))|(?:#)(?:(test)(?:!))|(?:(?:#)([spaqf1])(?:rivate|vt|ubscriber|ub|lert|uiet|irst|st)*(?:!))/mi',
            ],
        ],
        'grid' => [
            'url_text_length' => 20,
        ],
        'detail' => [
            'url_text_length' => 20,
        ],
        'profile' => [
            'url_text_length' => 20,
        ]
    ],
    'media' => [
        'users' => [
            'x-small' =>[
                'width' => 100,
                'height' => 100,
                'cover' => '/storage/fallback/users/cover.jpg',
                'avatar' => '/storage/fallback/users/avatar.jpg',
            ],
            'small' =>[
                'width' => 320,
                'height' => 240,
                'cover' => '/storage/fallback/users/cover.jpg',
                'avatar' => '/storage/fallback/users/avatar.jpg',
            ],
            'medium' =>[
                'width' => 640,
                'height' => 480,
                'cover' => '/storage/fallback/users/cover.jpg',
                'avatar' => '/storage/fallback/users/avatar.jpg',
            ],
            'large' =>[
                'width' => 800,
                'height' => 600,
                'cover' => '/storage/fallback/users/cover.jpg',
                'avatar' => '/storage/fallback/users/avatar.jpg',
            ],
            'x-large' =>[
                'width' => 1200,
                'height' => 900,
                'cover' => '/storage/fallback/users/cover.jpg',
                'avatar' => '/storage/fallback/users/avatar.jpg',
            ]
        ],
        'boards' => [
            'x-small' =>[
                'width' => 240,
                'height' => 160,
                'cover' => '/storage/fallback/boards/cover.jpg',
                'missing' => [
                    'image' => '/storage/fallback/boards/missing.jpg',
                    'anim' => '/storage/fallback/boards/missing.gif',
                    'video' => '/storage/fallback/boards/missing.mp4',
                    'audio' => '/storage/fallback/boards/missing.mp3',
                ],
            ],
            'small' =>[
                'width' => 400,
                'height' => 300,
                'cover' => '/storage/fallback/boards/cover.jpg',
                'missing' => [
                    'image' => '/storage/fallback/boards/missing.jpg',
                    'anim' => '/storage/fallback/boards/missing.gif',
                    'video' => '/storage/fallback/boards/missing.mp4',
                    'audio' => '/storage/fallback/boards/missing.mp3',
                ],            ],
            'medium' =>[
                'width' => 800,
                'height' => 600,
                'cover' => '/storage/fallback/boards/cover.jpg',
                'missing' => [
                    'image' => '/storage/fallback/boards/missing.jpg',
                    'anim' => '/storage/fallback/boards/missing.gif',
                    'video' => '/storage/fallback/boards/missing.mp4',
                    'audio' => '/storage/fallback/boards/missing.mp3',
                ],
            ],
            'large' =>[
                'width' => 1200,
                'height' => 900,
                'cover' => '/storage/fallback/boards/cover.jpg',
                'missing' => [
                    'image' => '/storage/fallback/boards/missing.jpg',
                    'anim' => '/storage/fallback/boards/missing.gif',
                    'video' => '/storage/fallback/boards/missing.mp4',
                    'audio' => '/storage/fallback/boards/missing.mp3',
                ],
            ],
            'x-large' =>[
                'width' => 1900,
                'height' => 1200,
                'cover' => '/storage/fallback/boards/cover.jpg',
                'missing' => [
                    'image' => '/storage/fallback/boards/missing.jpg',
                    'anim' => '/storage/fallback/boards/missing.gif',
                    'video' => '/storage/fallback/boards/missing.mp4',
                    'audio' => '/storage/fallback/boards/missing.mp3',
                ],
            ],
        ],
        'posts' => [
            'x-small' =>[
                'width' => 100,
                'height' => 100,
                'cover' => '/storage/fallback/posts/cover.jpg',
                'missing' => [
                    'image' => '/storage/fallback/posts/missing.jpg',
                    'anim' => '/storage/fallback/posts/missing.gif',
                    'video' => '/storage/fallback/posts/missing.mp4',
                    'audio' => '/storage/fallback/posts/missing.mp3',
                ],
            ],
            'small' =>[
                'width' => 400,
                'height' => 300,
                'cover' => '/storage/fallback/posts/cover.jpg',
                'missing' => [
                    'image' => '/storage/fallback/posts/missing.jpg',
                    'anim' => '/storage/fallback/posts/missing.gif',
                    'video' => '/storage/fallback/posts/missing.mp4',
                    'audio' => '/storage/fallback/posts/missing.mp3',
                ],
            ],
            'medium' =>[
                'width' => 800,
                'height' => 600,
                'cover' => '/storage/fallback/posts/cover.jpg',
                'missing' => [
                    'image' => '/storage/fallback/posts/missing.jpg',
                    'anim' => '/storage/fallback/posts/missing.gif',
                    'video' => '/storage/fallback/posts/missing.mp4',
                    'audio' => '/storage/fallback/posts/missing.mp3',
                ],
            ],
            'large' =>[
                'width' => 1200,
                'height' => 900,
                'cover' => '/storage/fallback/posts/cover.jpg',
                'missing' => [
                    'image' => '/storage/fallback/posts/missing.jpg',
                    'anim' => '/storage/fallback/posts/missing.gif',
                    'video' => '/storage/fallback/posts/missing.mp4',
                    'audio' => '/storage/fallback/posts/missing.mp3',
                ],
            ],
            'x-large' =>[
                'width' => 1900,
                'height' => 1200,
                'cover' => '/storage/fallback/posts/cover.jpg',
                'missing' => [
                    'image' => '/storage/fallback/posts/missing.jpg',
                    'anim' => '/storage/fallback/posts/missing.gif',
                    'video' => '/storage/fallback/posts/missing.mp4',
                    'audio' => '/storage/fallback/posts/missing.mp3',
                ],
            ],
        ],
    ],
    'fallback' => [
        'presets' => [
            'fake_covers' => 1000,
            'fake_avatars' => 87,
        ],
        'grid' => [
            'path' => '/p',
        ],
        'user' => [
            'thumb' => [
                'size' => [
                    'width' => 150,
                    'height' => 150,
                ],
                'avatar' => '/storage/fallback/users/xs/avatar.jpg',
                'missing' => '/storage/fallback/boards/missing.jpg',
            ],
            'grid' => [
                'size' => [
                    'width' => 600,
                    'height' => 400,
                ],
                'avatar' => '/storage/fallback/users/sm/avatar.jpg',
                'cover' => '/storage/fallback/users/sm/fallback.jpg',
                'anim' => '/storage/fallback/users/sm/fallback.gif',
                'video' => '/storage/fallback/users/sm/fallback.mp4',
                'missing' => '/storage/fallback/users/sm/missing.jpg',
            ],
            'detail' => [
                'size' => [
                    'width' => 1200,
                    'height' => 900,
                ],
                'avatar' => '/storage/fallback/users/md/avatar.jpg',
                'cover' => '/storage/fallback/users/md/fallback.jpg',
                'anim' => '/storage/fallback/users/md/fallback.gif',
                'video' => '/storage/fallback/users/md/fallback.mp4',
                'missing' => '/storage/fallback/users/md/missing.jpg',
            ],
            'profile' => [
                'size' => [
                    'width' => 150,
                    'height' => 150,
                ],
                'avatar' => '/storage/fallback/users/sm/avatar.jpg',
                'cover' => '/storage/fallback/users/lg/fallback.jpg',
                'anim' => '/storage/fallback/users/svg/photo-video.svg',
                'video' => '/storage/fallback/users/svg/film.svg',
                'missing' => '/storage/fallback/users/svg/missing.jpg',
            ],
        ],
        'board' => [
            'thumb' => [
                'size' => [
                    'width' => 150,
                    'height' => 150,
                ],
                'cover' => '/storage/fallback/boards/xs/fallback.jpg',
                'missing' => '/storage/fallback/boards/xs/missing.jpg',
            ],
            'grid' => [
                'size' => [
                    'width' => 150,
                    'height' => 150,
                ],
                'cover' => '/storage/fallback/boards/cover.jpg',
                'missing' => '/storage/fallback/boards/sm/missing.jpg',
            ],
            'detail' => [
                'size' => [
                    'width' => 150,
                    'height' => 150,
                ],
                'cover' => '/storage/fallback/boards/md/fallback.jpg',
                'missing' => '/storage/fallback/boards/md/missing.jpg',
                'upload' => '/storage/fallback/boards/md/upload.jpg',
            ],
            'page' => [
                'size' => [
                    'width' => 150,
                    'height' => 150,
                ],
                'cover' => '/storage/fallback/boards/lg/fallback.jpg',
                'missing' => '/storage/fallback/boards/lg/missing.jpg',
            ],
        ],
        'post' => [
            'thumb' => [
                'size' => [
                    'width' => 150,
                    'height' => 150,
                ],
                'cover' => '/storage/fallback/posts/xs/fallback.jpg',
                'missing' => '/storage/fallback/posts/xs/missing.jpg',
            ],
            'grid' => [
                'size' => [
                    'width' => 150,
                    'height' => 150,
                ],
                'image' => '/storage/fallback/posts/sm/fallback.jpg',
                'anim' => '/storage/fallback/posts/sm/fallback.gif',
                'video' => '/storage/fallback/posts/sm/fallback.mp4',
                'missing' => '/storage/fallback/posts/sm/missing.jpg',
            ],
            'detail' => [
                'size' => [
                    'width' => 150,
                    'height' => 150,
                ],
                'image' => '/storage/fallback/posts/md/fallback.jpg',
                'anim' => '/storage/fallback/posts/md/fallback.gif',
                'video' => '/storage/fallback/posts/md/fallback.mp4',
                'missing' => '/storage/fallback/posts/md/missing.jpg',
            ],
            'page' => [
                'size' => [
                    'width' => 150,
                    'height' => 150,
                ],
                'image' => '/storage/fallback/posts/lg/fallback.jpg',
                'anim' => '/storage/fallback/posts/lg/fallback.gif',
                'video' => '/storage/fallback/posts/lg/fallback.mp4',
                'missing' => '/storage/fallback/posts/lg/missing.jpg',
            ],
        ],
    ],
];
