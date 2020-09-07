<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;

/**
 * Action
 */
final class UploadFileAction
{
    /**
     * The constructor.
     *
     * @param KontrakCreator $kontrakCreator The user creator
     */
    public function __construct()
    {}

    /**
     * Invoke.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     * @return ResponseInterface The response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        require __DIR__ . '/../../config/settings.php';
        $directory = $settings['upload_directory'];
        // $directory = $this->get('upload_directory');
        $uploadedFiles = $request->getUploadedFiles();
        $data = (array) $request->getParsedBody();
        $realid = $data['realid'];
        $type = $data['type'];
        $versi = $data['versi'];
        $extsi = $data['extensi'];

        $isSuccess = 0;
        $filename = "";
        $message = "success";
        //   //  handle single input with single file upload
        $uploadedFile = $uploadedFiles['coper'];
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            $directory = $directory . DIRECTORY_SEPARATOR . $realid . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR;

            if (!file_exists($directory)) {
                mkdir($directory, 0775, true);
            }
            $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
            $extension = strtolower($extension);
            if($extsi==$extension){
                $filename = $this->moveUploadedFile($directory, $uploadedFile, $type, $versi, $extension);
                $isSuccess = 1;
            }else{
                $isSuccess = 0;
                $message = "Extension not accepted";
            }
           
        } else {
            $isSuccess = 0;
            $message = "Failed upload file.";
        }

        // Transform the result into the JSON representation
        $result = [
            'status' => $isSuccess,
            'realid' => $realid,
            'type' => $type,
            'message'=>$message,
            'filename' => $filename,
        ];

        // Build the HTTP response
        $response->getBody()->write((string) json_encode($result));
        // $uploadedFile = $uploadedFiles['copet'];
        // if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
        //     $filename = $this->moveUploadedFile($directory, $uploadedFile);
        //     $response->getBody()->write('Uploaded: ' . $filename . '<br/>');
        // }

        //  handle multiple inputs with the same key
        // foreach ($uploadedFiles['coper'] as $uploadedFile) {
        //     if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
        //         $filename = $this->moveUploadedFile($directory, $uploadedFile);
        //         $response->getBody()->write('Uploaded: ' . $filename . '<br/>');
        //     }
        // }

        // // handle single input with multiple file uploads
        // foreach ($uploadedFiles['example3'] as $uploadedFile) {
        //     if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
        //         $filename = $this->moveUploadedFile($directory, $uploadedFile);
        //         $response->getBody()->write('Uploaded: ' . $filename . '<br/>');
        //     }
        // }

        return $response;

        // // Collect input from the HTTP request
        // $data = (array) $request->getParsedBody();

        // // Invoke the Domain with inputs and retain the result
        // $kontrakId = $this->kontrakCreator->createKontrak($data);

        // // Transform the result into the JSON representation
        // $result = [
        //     'id' => $kontrakId,
        // ];

        // // Build the HTTP response
        // $response->getBody()->write((string) json_encode($result));

        // return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

/**
 * Moves the uploaded file to the upload directory and assigns it a unique name
 * to avoid overwriting an existing uploaded file.
 *
 * @param string $directory The directory to which the file is moved
 * @param UploadedFileInterface $uploadedFile The file uploaded file to move
 *
 * @return string The filename of moved file
 */
    public function moveUploadedFile(string $directory, UploadedFileInterface $uploadedFile, string $type, string $versi, string $extension)
    {
        

        // see http://php.net/manual/en/function.random-bytes.php
        // $basename = bin2hex(random_bytes(8));
        // $filename = sprintf('%s.%0.8s', $basename, $extension);

        $filename = $type . '_' . 'v'.$versi . '.' . $extension;

        $uploadedFile->moveTo($directory . $filename);

        return $filename;

    }
}
