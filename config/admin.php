<?php

return [
    /**
     * Admin sidebar configuration
     */
    'sidebar' => [
//        [
//            'title' => 'Панель управления',
//            'route' => 'admin_dashboard',
//            'icon' => 'fa fa-th-large',
//            'role' => ['admin', 'moderator'],
//        ],
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
            'title' => 'Пункты меню',
            'route' => 'admin_module_index',
            'route_attribute' => [
                'module' => 'menu_items'
            ],
            'icon' => 'fa fa-list-ol',
            'role' => ['admin'],
        ],
        /*[
            'title' => 'Сезонные активности',
            'icon' => 'fa fa-gem',
            'role' => [1, 2],
            'items' => [
                [
                    'title' => 'Весна 2019',
//                    'route' => 'get_events',
                    'items' => [
                        [
                            'title' => 'Локализация',
                            'items' => [
                                [
                                    'title' => 'Список локалей'
                                ],
                                [
                                    'title' => 'Переводы',
                                    'items' => [
                                        [
                                            'title' => 'Игра',
                                        ],
                                        [
                                            'title' => 'Пользователи',
                                        ],
                                        [
                                            'title' => 'Визажисты',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        ['title' => 'Подписчики'],
                        ['title' => 'Товары'],
                        [
                            'title' => 'Визажисты',
                            'route' => 'admin_module_index',
                            'route_attribute' => [
                                'module' => 'spring2019_visage'
                            ],
                        ],
                        ['title' => 'Отзывы'],
                    ],
                ],
            ]
        ],*/
        [
            'title' => 'Главная страница',
            'icon' => 'fa fa-home',
            'role' => ['admin', 'homepage_moderator'],
            'items' => [
                [
                    'title' => 'Книга красоты',
                    'route' => 'admin_module_index',
                    'route_attribute' => [
                        'module' => 'beauty_books'
                    ],
                ],
                [
                    'title' => 'Материалы',
                    'route' => 'admin_module_index',
                    'route_attribute' => [
                        'module' => 'materials'
                    ],
                ],
                [
                    'title' => 'Распределение блоков',
                    'route' => 'admin_positions',
                ],
                [
                    'title' => 'Настройки',
                    'route' => 'admin_settings',
                ],
            ],
        ],
        [
            'title' => 'Карта',
            'icon' => 'fa fa-map',
            'role' => ['admin', 'moderator', 'events_moderator'],
//            'badge' => [
//                'value' => 'adminBadgeEventsModeration',
//                'color' => 'warning',
//            ],
            'items' => [
                [
                    'title' => 'Мероприятия',
                    'route' => 'admin_module_index',
                    'route_attribute' => [
                        'module' => 'events'
                    ],
                ],
                [
                    'title' => 'Модерация',
                    'route' => 'admin_module_index',
                    'route_attribute' => [
                        'module' => 'events_moderation'
                    ],
//                    'badge' => [
//                        'value' => 'adminBadgeEventsModeration',
//                        'color' => 'warning',
//                    ]
                ],
                [
                    'title' => 'Населенные пункты',
                    'route' => 'admin_module_index',
                    'route_attribute' => [
                        'module' => 'cities'
                    ],
                ],
                [
                    'title' => 'Форматы мероприятий',
                    'route' => 'admin_module_index',
                    'route_attribute' => [
                        'module' => 'event_formats'
                    ],
                    'role' => ['admin'],
                ],
                [
                    'title' => 'Типы мероприятий',
                    'route' => 'admin_module_index',
                    'route_attribute' => [
                        'module' => 'event_types'
                    ],
                    'role' => ['admin'],
                ],
                [
                    'title' => 'Документы',
                    'route' => 'admin_module_index',
                    'route_attribute' => [
                        'module' => 'documents'
                    ],
                ],
                [
                    'title' => 'USP',
                    'route' => 'admin_module_index',
                    'route_attribute' => [
                        'module' => 'event_usps'
                    ],
                    'role' => ['admin'],
                ],
                [
                    'title' => 'СПО',
                    'route' => 'admin_module_index',
                    'route_attribute' => [
                        'module' => 'event_spos'
                    ],
                    'role' => ['admin'],
                ],
                /*[
                    'title' => 'Выгрузка',
//                    'route' => 'csv_form',
                    'role' => 1,
                ],*/
            ]
        ],
        [
            'title' => 'Тесты',
            'icon' => 'fa fa-list-alt',
            'role' => ['admin', 'moderator', 'test_moderator'],
            'items' => [
                [
                    'title' => 'Все тесты',
                    'route' => 'admin_module_index',
                    'route_attribute' => [
                        'module' => 'tests'
                    ],
                ],
                [
                    'title' => 'Категории',
                    'route' => 'admin_module_index',
                    'route_attribute' => [
                        'module' => 'test_categories'
                    ],
                ],
                [
                    'title' => 'Заглушки',
                    'route' => 'admin_module_index',
                    'route_attribute' => [
                        'module' => 'tests_dummies'
                    ],
                ],
                [
                    'title' => 'Распределение блоков',
                    'route' => 'admin_tests_pages',
                ],
            ]
        ],
        [
            'title' => 'Подписчики Mindbox',
            'icon' => 'fa fa-users',
            'route' => 'admin_module_index',
            'route_attribute' => [
                'module' => 'subscribers'
            ],
            'role' => ['admin'],
        ],
        [
            'title' => 'Локализация',
            'icon' => 'fa fa-language',
            'role' => ['admin', 'moderator'],
            'items' => [
                [
                    'title' => 'Список локалей',
                    'route' => 'admin_module_index',
                    'route_attribute' => [
                        'module' => 'locales'
                    ],
                    'role' => ['admin'],
                ],
                [
                    'title' => 'Переводы',
                    'route' => 'admin_translations_index',
                ],
                /*[
                    'title' => 'Настройки авторизации',
//                    'route' => '',
                    'role' => 1,
                ],*/
            ],
        ],
        /*[
            'title' => 'Настройки',
            'icon' => 'fa fa-cog',
            'role' => 1,
            'items' => [
                [
                    'title' => 'Общие настройки',
//                    'route' => 'get_events',
                ],
                [
                    'title' => 'Главная страница',
//                    'route' => 'get_events',
                ],
                [
                    'title' => 'Авторизация',
//                    'route' => 'get_events',
                ],
            ],
        ],*/

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