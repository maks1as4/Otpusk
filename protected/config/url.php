<?php

return array(
	// site
	'index'=>array('site/index'),
	'contact'=>array('site/contact'),
	// site/page
	'about'=>array('site/page','defaultParams'=>array('view'=>'about')),
	'vacancy'=>array('site/page','defaultParams'=>array('view'=>'vacancy')),
	'topic/<id:\d+>'=>array('site/topic'),
	'static/<view:[a-z0-9-]+>'=>array('site/page'),
	// pages/list
	'news'=>array('pages/list','defaultParams'=>array('type'=>'news')),
	'tourism'=>array('pages/list','defaultParams'=>array('type'=>'tourism')),
	'journals/archive'=>array('pages/list','defaultParams'=>array('type'=>'journal')),
	'panoramas'=>array('pages/list','defaultParams'=>array('type'=>'panoramas')),
	'countries'=>array('pages/list','defaultParams'=>array('type'=>'countries')),
	'part/<type:[a-z0-9-]+>'=>array('pages/list'),
	// pages/view
	'news/<url:[a-z0-9-]+>-<id:\d+>'=>array('pages/view','defaultParams'=>array('type'=>'news'),'urlSuffix'=>'.html'),
	'tourism/<url:[a-z0-9-]+>-<id:\d+>'=>array('pages/view','defaultParams'=>array('type'=>'tourism'),'urlSuffix'=>'.html'),
	'journals/<id:\d+>/<url:[a-z0-9-]+>'=>array('pages/view','defaultParams'=>array('type'=>'journal'),'urlSuffix'=>'.html'),
	'panoramas/<url:[a-z0-9-]+>-<id:\d+>'=>array('pages/view','defaultParams'=>array('type'=>'panoramas'),'urlSuffix'=>'.html'),
	'countries/<url:[a-z0-9-]+>-<id:\d+>'=>array('pages/view','defaultParams'=>array('type'=>'countries'),'urlSuffix'=>'.html'),
	'part/<type:[a-z0-9-]+>/page/<url:[a-z0-9-]+>-<id:\d+>'=>array('pages/view','urlSuffix'=>'.html'),
	// user
	'registration'=>array('users/registration'),
	'user/edit'=>array('users/edit'),
	'user/profile/<username>'=>array('users/view'),
	'user/delete-avatar'=>array('users/deleteAvatar'),
	'authorization'=>array('users/login'),
	'exit'=>array('users/logout'),
	// download
	'downloader/<type:[a-z0-9-]+>/<file:[a-zA-Z0-9-_]+>'=>array('downloader/index'),
	// admin
	'admin'=>array('admin/main/index'),
	// default
	'<controller:\w+>/<id:\d+>'=>'<controller>/view',
	'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
	'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
);