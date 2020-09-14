<?php

namespace App\Action\Kontrak;

use App\Domain\Kontrak\Service\KontrakReader;
use App\Domain\Stream\Service\StreamReader;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 */
final class AllKontrakAction
{
    /**
     * @var KontrakReader
     */
    private $kontrakReader;

    private $streamReader;

    /**
     * The constructor.
     *
     * @param KontrakReader $userReader The kontrak reader
     */
    public function __construct(KontrakReader $kontrakReader,StreamReader $streamReader)
    {
        $this->kontrakReader = $kontrakReader;
        $this->streamReader = $streamReader;
    }

    /**
     * Invoke.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     * @param array $args The route arguments
     *
     * @return ResponseInterface The response
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args = []
    ): ResponseInterface {
          // ==== proses kontrak 0 - 90 hari ===============
       

          // Invoke the Domain with inputs and retain the result
          $allkontrak = $this->kontrakReader->getAllKontrak();

          //get all stream
          $allstream = $this->streamReader->getAllStream();
     
         $dataresponse = array(
            "kontrak"    => $allkontrak,
            "stream"    => $allstream
        );

         // Build the HTTP response
         $response->getBody()->write((string)json_encode($dataresponse));
 
         return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}