<?php

namespace App\Action\Kontrak;

use App\Domain\Kontrak\Service\KontrakCreator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 */
final class DeleteKontrakAction
{
    /**
     * @var KontrakCreator
     */
    private $kontrakCreator;

    /**
     * The constructor.
     *
     * @param KontrakCreator $kontrakCreator The user creator
     */
    public function __construct(KontrakCreator $kontrakCreator)
    {
        $this->kontrakCreator = $kontrakCreator;
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
        $id = $data['id'];
        // Invoke the Domain with inputs and retain the result
        $rowCount = $this->kontrakCreator->deleteKontrak($id);

        // Transform the result into the JSON representation
        $result = [
            'rowcount' => $rowCount
        ];

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($result));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}