<?php

return [

    'select_fields' => [
        'id',
        'name',
        'description',
        'price',
        'number_vacancies'
    ],

    'key_base' => 'burh:plan:',

    'tll_redis' => 60,

    'key_redis_index' => 'burh:plan:index',

    'key_redis_show' => 'burh:plan:',

];