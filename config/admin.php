<?php

return [
    /**
     * Admin sidebar configuration
     */
    'sidebar' => [
        [
            'title' => 'Пользователи',
            'route' => 'admin_module_index',
            'route_attribute' => [
                'module' => 'users'
            ],
            'icon' => 'fa fa-users',
            'role' => ['admin'],
        ],
        [
            'title' => 'Усадьбы',
            'route' => 'admin_module_index',
            'route_attribute' => [
                'module' => 'manors'
            ],
            'icon' => 'fa fa-home',
            'role' => ['admin'],
        ],
        [
            'title' => 'Настройки карты',
            'icon' => 'fa fa-map',
            'role' => ['admin'],
            'items' => [
                [
                    'title' => 'Области',
                    'route' => 'admin_module_index',
                    'route_attribute' => [
                        'module' => 'regions'
                    ],
                ],
                [
                    'title' => 'Районы',
                    'route' => 'admin_module_index',
                    'route_attribute' => [
                        'module' => 'areas'
                    ],
                ],
            ]
        ],
        [
            'title' => 'Виды собственности',
            'route' => 'admin_module_index',
            'route_attribute' => [
                'module' => 'privacy_types'
            ],
            'icon' => 'fa fa-briefcase',
            'role' => ['admin'],
        ],
        [
            'title' => 'Владельцы',
            'route' => 'admin_module_index',
            'route_attribute' => [
                'module' => 'owners'
            ],
            'icon' => 'fa fa-users',
            'role' => ['admin'],
        ],

    ],

    /**
     * Admin Default Pagination
     */
    'module_pagination' => 50,

    /**
     * Default DateTime Formats
     */
    'default_datetime_format' => 'Y-m-d H:i:s',
    'default_datetime_format_js' => 'YYYY-MM-DD HH:mm:SS',
    'default_date_format' => 'Y-m-d',
    'default_date_format_js' => 'yyyy-mm-dd',
];