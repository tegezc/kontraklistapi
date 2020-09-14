<?php

namespace App\Domain\Stream\Service;

use App\Domain\Stream\Repository\StreamReaderRepository;

/**
 * Service.
 */
final class StreamReader
{
    /**
     * @var UserReaderRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UserReaderRepository $repository The repository
     */
    public function __construct(StreamReaderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     * @return array of object stream
     */
    public function getAllStream():array
    {
        $arrayStream = $this->repository->getAllStream();

        return $arrayStream;
    }

}