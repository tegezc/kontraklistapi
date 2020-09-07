<?php

namespace App\Action\Dokumen;

use App\Domain\Dokumen\Service\DokumenCreator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 */
final class DokumenCreateAction
{
    /**
     * @var DokumenCreator
     */
    private $dokumenCreator;

    /**
     * The constructor.
     *
     * @param DokumenCreator $dokumenCreator The user creator
     */
    public function __construct(DokumenCreator $dokumenCreator)
    {
        $this->dokumenCreator = $dokumenCreator;
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
        $dokumenId = $this->dokumenCreator->createDokumen($data);

        // Transform the result into the JSON representation
        $result = [
            'id' => $dokumenId
        ];

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($result));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}