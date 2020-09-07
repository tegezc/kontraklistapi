<?php

namespace App\Action\User;

use App\Domain\User\Service\UserReader;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 */
final class UserReadAllAction
{
    /**
     * @var userReader
     */
    private $userReader;

    /**
     * The constructor.
     *
     * @param UserReader $userReader The user reader
     */
    public function __construct(UserReader $userReader)
    {
        $this->userReader = $userReader;
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
        // Invoke the Domain with inputs and retain the result
        $arrayuserData = $this->userReader->getAllUsers();

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($arrayuserData));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}