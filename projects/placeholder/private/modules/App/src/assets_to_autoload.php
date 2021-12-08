<?php

return [
    'header' => [
        'js' => [
            'jquery' => public_url('node_modules/jquery/dist/jquery.min.js', config()->get('dev.in_dev_mode')),
            'appjs' => public_url('module/app/web/js/app.js', config()->get('dev.in_dev_mode'))
        ],
        'css' => [],
        'js_content' => '',
        'css_content' => ''
    ],
    'footer' => [
        'js' => [],
        'js_content' => ''
    ]
];
