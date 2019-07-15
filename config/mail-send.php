<?php

return [
	// Путь по которому расположена админка
	'admin-route'   => 'admin',

	// Используемый шаблон
	'admin-layout'  => 'admin.layout.admin-layout',

	// Секция в которой размещается контент страницы
	'admin-section' => 'content',

	// Добавление почтовых ящиков для отправки
	'mailer' => [
		'yandex' => [
			'host'          => 'a.uiux.ru',
			'port'          => 25,
			'encryption'    => null,
			'username'      => 'no-reply@lifestyle.expert',
			'password'      => 'u57O8j9d',
			'from'          => [
				'address' => 'no-reply@lifestyle.expert',
				'name'    => 'Oriflame'
			],
		]
		//...
	]
];