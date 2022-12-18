<?php

return [

    'types' => [
        'clt',
        'pj',
        'estagio',
    ],

    'wage' => [
        'min_clt' => 1212,
    ],

    'workload' => [
        'estagio' => [
            'max_hour' => 6,
        ],
    ],

    'select_fields' => [
        'id',
        'title',
        'description',
        'type',
        'wage',
        'hours',
        'id_company'
    ],

];