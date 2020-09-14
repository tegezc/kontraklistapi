<?php

namespace App\Domain\Stream\Repository;

use App\Domain\Stream\Data\StreamData;
use DomainException;
use PDO;

/**
 * Repository.
 */
class StreamReaderRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     *
     * @throws DomainException
     *
     * @return StreamData[] List of stream data
     */
    public function getAllStream(): array
    {
        $sql = "SELECT * FROM stream;";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $rows = $statement->fetchAll();
        if (!$rows) {
            throw new DomainException(sprintf('Error get all stream'));
        }
        return $rows;
    }

}
