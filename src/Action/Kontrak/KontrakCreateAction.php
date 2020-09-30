<?php

namespace App\Action\Kontrak;

use App\Domain\Kontrak\Service\KontrakCreator;
use App\Domain\Kontrak\Service\KontrakReader;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 */
final class KontrakCreateAction
{
    /**
     * @var KontrakCreator
     */
    private $kontrakCreator;
    private $kontrakReader;

    /**
     * The constructor.
     *
     * @param KontrakCreator $kontrakCreator The user creator
     */
    public function __construct(KontrakCreator $kontrakCreator,KontrakReader $kontrakReader)
    {
        $this->kontrakCreator = $kontrakCreator;
        $this->kontrakReader = $kontrakReader;
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
        // Collect input from the HTTP request
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $kontrakId = $this->kontrakCreator->createKontrak($data);

      
        // get kontrak data
        $kontrakData = $this->kontrakReader->getKontrakById($kontrakId);
        
        // Build the HTTP response
        $response->getBody()->write((string)json_encode($kontrakData));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}