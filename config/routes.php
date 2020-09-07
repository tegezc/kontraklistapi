<?php

use Slim\App;

return function (App $app) {
   // action user
   
    $app->get('/users/{id}', \App\Action\User\UserReadAction::class)->setName('users-get');
    $app->get('/users', \App\Action\User\UserReadAllAction::class)->setName('users-get');
    $app->post('/users', \App\Action\User\UserCreateAction::class)->setName('users-post');

    //action kontrak
    $app->get('/', \App\Action\Kontrak\DashboardKontrakAction::class)->setName('dashboard');
    $app->post('/kontraks', \App\Action\Kontrak\KontrakCreateAction::class)->setName('kontrak-post');
    $app->get('/kontraks/{id}', \App\Action\Kontrak\DetailKontrakAction::class)->setName('kontrak-get');
    $app->put('/kontraks', \App\Action\Kontrak\UpdateKontrakAction::class)->setName('kontrak-put');
    $app->delete('/kontraks/{id}',\App\Action\Kontrak\DeleteKontrakAction::class)->setName('kontrak-delete');

    // action dokumen
    $app->post('/dokumen', \App\Action\Dokumen\DokumenCreateAction::class)->setName('dokumen-post');
    $app->delete('/dokumen/{id}',\App\Action\Dokumen\DokumenDeleteAction::class)->setName('dokumen-delete');

    // upload file
    $app->post('/upload', \App\Action\UploadFileAction::class)->setName('home-post');
    
};
