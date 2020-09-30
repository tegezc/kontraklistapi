<?php

namespace App\Action;

use App\Util\UtilFile;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;

/**
 * Action
 */
final class UploadFileAction
{

    private $utilFile;

    /**
     * The constructor.
     *
     * @param UtilFile
     */
    public function __construct(UtilFile $utilFile)
    {
        $this->utilFile = $utilFile;
    }

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
       
        $uploadedFiles = $request->getUploadedFiles();
        $data = (array) $request->getParsedBody();
        $realid = $data['idkontrak'];
        $type = $data['type'];
        $versi = $data['versi'];
        $extension = $data['ext'];
        
        $isSuccess = 0;
        $filename = "";
        $message = "success";
        //   //  handle single input with single file upload
        $uploadedFile = $uploadedFiles['file'];
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            $directory = $this->utilFile->getPathUploadDirectory($realid,$type);

            if (!file_exists($directory)) {
                mkdir($directory, 0775, true);
            }
          
            if("pdf"==$extension||"doc"==$extension||"docx"==$extension){
                $pathtofile = $directory.$this->utilFile->getFileName($type, $versi, $extension);
                $success = $this->moveUploadedFile($pathtofile, $uploadedFile);
                $isSuccess = $success?1:0;
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
            'ekstensi'=>$extension,
        ];

        // Build the HTTP response
        $response->getBody()->write((string) json_encode($result));
        
        return $response;
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
    public function moveUploadedFile(string $pathFile, UploadedFileInterface $uploadedFile):bool
    {
        
        
        // see http://php.net/manual/en/function.random-bytes.php
        // $basename = bin2hex(random_bytes(8));
        // $filename = sprintf('%s.%0.8s', $basename, $extension);
        try{
            $uploadedFile->moveTo($pathFile);

            return true;
        }catch(\Exception $e){
            return false;
        }
       

    }
}
