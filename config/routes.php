<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

return function (App $app) {
    // action user

    $app->get('/users/{id}', \App\Action\User\UserReadAction::class)->setName('users-get');
    $app->get('/users', \App\Action\User\UserReadAllAction::class)->setName('users-get');
    $app->post('/users', \App\Action\User\UserCreateAction::class)->setName('users-post');

    //action kontrak
    $app->get('/', \App\Action\Kontrak\DashboardKontrakAction::class)->setName('dashboard');
    $app->options('/', function (
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        return $response;
    });

    $app->get('/kontraks', \App\Action\Kontrak\AllKontrakAction::class)->setName('kontraks-get');
    $app->post('/kontraks', \App\Action\Kontrak\KontrakCreateAction::class)->setName('kontrak-post');
 
 //   $app->post('/csv', \App\Action\Kontrak\FilterKontrakAction::class)->setName('csv-post');
    $app->options('/kontraks', function (
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        return $response;
    });

    $app->get('/check/{id}', \App\Action\Kontrak\CheckSpExistsAction::class)->setName('check-get');
    $app->get('/kontraks/{id}', \App\Action\Kontrak\DetailKontrakAction::class)->setName('kontrak-get');
    $app->put('/kontraks/{id}', \App\Action\Kontrak\UpdateKontrakAction::class)->setName('kontrak-put');
    $app->delete('/kontraks/{id}', \App\Action\Kontrak\DeleteKontrakAction::class)->setName('kontrak-delete');
    $app->options('/kontraks/{id}', function (
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        return $response;
    });


    // action dokumen
    $app->post('/dokumen', \App\Action\Dokumen\DokumenCreateAction::class)->setName('dokumen-post');
    $app->options('/dokumen', function (
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        return $response;
    });

    $app->get('/dokumen/{idkontrak}/{jnsdok}', \App\Action\Dokumen\DokumenMaxVersiAction::class)->setName('dokumen-get');
    $app->delete('/dokumen/{id}', \App\Action\Dokumen\DokumenDeleteAction::class)->setName('dokumen-delete');
    $app->put('/dokumen/{id}', \App\Action\Dokumen\DokumenUpdateAction::class)->setName('dokumen-put');
    $app->options('/dokumen/{id}', function (
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        return $response;
    });


    // upload file
    $app->post('/upload', \App\Action\UploadFileAction::class)->setName('file-post');
    $app->options('/upload', function (
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        return $response;
    });

    // upload file
    $app->get('/download/{id}', \App\Action\DownloadFileAction::class)->setName('file-get');
    $app->options('/download/{id}', function (
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        return $response;
    });
};
