<?php
// === USER ROUTES ===
$router->get('/',          'BerandaController@index');
$router->get('/galeri',    'GaleriController@index');
$router->get('/favorit',   'FavoritController@index');
$router->get('/komunitas', 'KomunitasController@index');
$router->get('/kontak',    'KontakController@index');
$router->post('/kontak',   'KontakController@kirim');
$router->get('/tentang',   'TentangController@index');

// === AUTH ROUTES ===
$router->get('/admin/login',        'AuthController@login');
$router->post('/admin/login/proses','AuthController@proses');
$router->post('/admin/logout',      'AuthController@logout');

// === ADMIN ROUTES ===
$router->get('/admin/dashboard', 'AdminController@dashboard');

// Beranda content management
$router->get('/admin/beranda',              'AdminBerandaController@index');
$router->post('/admin/beranda/hero/update', 'AdminBerandaController@updateHero');
$router->post('/admin/beranda/stats/update','AdminBerandaController@updateStats');
$router->post('/admin/beranda/artikel/store',  'AdminBerandaController@storeArtikel');
$router->post('/admin/beranda/artikel/update', 'AdminBerandaController@updateArtikel');
$router->post('/admin/beranda/artikel/delete', 'AdminBerandaController@deleteArtikel');
$router->post('/admin/beranda/tips/store',     'AdminBerandaController@storeTip');
$router->post('/admin/beranda/tips/update',    'AdminBerandaController@updateTip');
$router->post('/admin/beranda/tips/delete',    'AdminBerandaController@deleteTip');
$router->post('/admin/beranda/cta/update',     'AdminBerandaController@updateCta');

// Galeri (cat races)
$router->get('/admin/galeri',               'AdminGaleriController@index');
$router->get('/admin/galeri/create',        'AdminGaleriController@create');
$router->post('/admin/galeri/store',        'AdminGaleriController@store');
$router->get('/admin/galeri/edit',          'AdminGaleriController@edit');
$router->post('/admin/galeri/update',       'AdminGaleriController@update');
$router->post('/admin/galeri/delete',       'AdminGaleriController@delete');

// Komunitas
$router->get('/admin/komunitas',                     'AdminKomunitasController@index');
$router->get('/admin/komunitas/thread/create',       'AdminKomunitasController@threadCreate');
$router->post('/admin/komunitas/thread/store',       'AdminKomunitasController@threadStore');
$router->get('/admin/komunitas/thread/edit',         'AdminKomunitasController@threadEdit');
$router->post('/admin/komunitas/thread/update',      'AdminKomunitasController@threadUpdate');
$router->post('/admin/komunitas/thread/delete',      'AdminKomunitasController@threadDelete');
$router->get('/admin/komunitas/event/create',        'AdminKomunitasController@eventCreate');
$router->post('/admin/komunitas/event/store',        'AdminKomunitasController@eventStore');
$router->get('/admin/komunitas/event/edit',          'AdminKomunitasController@eventEdit');
$router->post('/admin/komunitas/event/update',       'AdminKomunitasController@eventUpdate');
$router->post('/admin/komunitas/event/delete',       'AdminKomunitasController@eventDelete');
$router->post('/admin/komunitas/member/store',       'AdminKomunitasController@memberStore');
$router->post('/admin/komunitas/member/delete',      'AdminKomunitasController@memberDelete');
$router->post('/admin/komunitas/tag/store',          'AdminKomunitasController@tagStore');
$router->post('/admin/komunitas/tag/delete',         'AdminKomunitasController@tagDelete');

// Kontak
$router->get('/admin/kontak',                  'AdminKontakController@index');
$router->get('/admin/kontak/settings',         'AdminKontakController@settings');
$router->post('/admin/kontak/info/update',     'AdminKontakController@updateInfo');
$router->post('/admin/kontak/faq/store',       'AdminKontakController@faqStore');
$router->post('/admin/kontak/faq/update',      'AdminKontakController@faqUpdate');
$router->post('/admin/kontak/faq/delete',      'AdminKontakController@faqDelete');
$router->post('/admin/kontak/pesan/delete',    'AdminKontakController@pesanDelete');

// Tentang
$router->get('/admin/tentang',                      'AdminTentangController@index');
$router->post('/admin/tentang/hero/update',         'AdminTentangController@updateHero');
$router->post('/admin/tentang/values/store',        'AdminTentangController@valueStore');
$router->post('/admin/tentang/values/update',       'AdminTentangController@valueUpdate');
$router->post('/admin/tentang/values/delete',       'AdminTentangController@valueDelete');
$router->post('/admin/tentang/team/store',          'AdminTentangController@teamStore');
$router->post('/admin/tentang/team/update',         'AdminTentangController@teamUpdate');
$router->post('/admin/tentang/team/delete',         'AdminTentangController@teamDelete');
$router->post('/admin/tentang/timeline/store',      'AdminTentangController@timelineStore');
$router->post('/admin/tentang/timeline/update',     'AdminTentangController@timelineUpdate');
$router->post('/admin/tentang/timeline/delete',     'AdminTentangController@timelineDelete');
