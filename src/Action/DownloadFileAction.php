<?php

namespace App\Action;

use App\Domain\Dokumen\Service\DokumenReader;
use App\Util\UtilFile;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 */
final class DownloadFileAction
{
     /**
     * @var DokumenReader
     */
    private $dokumenReader;

     /**
     * @var UtilFile
     */
    private $utilFile;

    /**
     * The constructor.
     *
     */
    public function __construct(DokumenReader $dokumenReader,UtilFile $utilFile)
    {
        $this->dokumenReader = $dokumenReader;
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
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response ,array $args = []): ResponseInterface
    {
       
        $paramget = (String) $args['id'];
        $pieces = explode("+", $paramget);
        $iddokumen = $pieces[0];
        $type = $pieces[1];

        $dokumen = $this->dokumenReader->getDokumenDetail($iddokumen);
        $exstenstion = '';
        if($type == 'pdf'){
            $exstenstion = 'pdf';
        }else{
            // mybe doc or docx
            $exstenstion = $dokumen->doc;
        }
        $idkontrak = $dokumen->realIdKontrak;
        $versi = $dokumen->versi;
        $jnsDoc = $dokumen->jenisDoc;

       $directory = $this->utilFile->getPathUploadDirectory($idkontrak,$jnsDoc);
       $filename = $this->utilFile->getFileName($jnsDoc,$versi,$exstenstion);
       $csv_file = $directory.$filename;
       
        $response = $response
            ->withHeader('Content-Type', 'application/octet-stream')
            ->withHeader('Content-Disposition', 'attachment; filename='.$filename)
            ->withAddedHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->withHeader('Cache-Control', 'post-check=0, pre-check=0')
            ->withHeader('Pragma', 'no-cache')
            ->withBody((new \Slim\Psr7\Stream(fopen($csv_file, 'rb'))));

        return $response;
    }

}
