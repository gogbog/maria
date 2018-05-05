<?php
// Full HD 16:9 [width, height]
return [
	'backend' => '/backend/img',
	
	'frontend' => '/frontend/img',

	'upload_path' => '/frontend/uploads',

	'article_350' =>  '/frontend/uploads/blog/:pid/350x197',

	'article_740' =>  '/frontend/uploads/blog/:pid/740x500',

	'disk_image' =>  '/frontend/uploads/music_albums/:pid',

	'photo_album' =>  '/frontend/uploads/photo_albums/:pid/390x390',

	'photo_album_clean' =>  '/frontend/uploads/photo_albums/:pid',

	'photos' =>  '/frontend/uploads/photos',

	'thumb_admin_products' => '/images/upload/products/:pid/250x250',

	'thumb_admin_articles' => '/images/upload/articles/:aid/200x200',
	
	'sizes' => [
		'articles' => ['350x197', '740x500'],
		'photo_album' => ['390x390'],
	],

	'prefix' => [
		'articles' => 'blog',
		'photos' => 'photo',
		'album' => 'album',
	]
];