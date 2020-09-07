<?php

namespace App\Domain\Kontrak\Service;

use App\Domain\Kontrak\Repository\KontrakCreatorRepository;

/**
 * Service.
 */
final class KontrakCreator
{
    /**
     * @var kontrakCreatorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param KontrakCreatorRepository $repository The repository
     */
    public function __construct(KontrakCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new Kontrak.
     *
     * @param array $data The form data
     *
     * @return int The new kontrak ID
     */
    public function createKontrak(array $data): int
    {
        // Insert kontrak
        $kontrakId = $this->repository->insertKontrak($data);

        return $kontrakId;
    }

     /**
     * Update a new Kontrak.
     *
     * @param array $data The form data
     *
     * @return int The new kontrak ID
     */
    public function updateKontrak(array $data): int
    {
        // Insert kontrak
        $kontrakId = $this->repository->updateKontrak($data);

        return $kontrakId;
    }

     /**
     * delete a Kontrak.
     *
     * @param int $kontrakid The form data
     *
     * @return int The deleted kontrak ID
     */
    public function deleteKontrak(int $kontrakid): int
    {
        // Insert kontrak
        $kontrakId = $this->repository->deleteKontrak($kontrakid);

        return $kontrakId;
    }
}