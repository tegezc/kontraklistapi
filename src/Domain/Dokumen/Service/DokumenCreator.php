<?php

namespace App\Domain\Dokumen\Service;

use App\Domain\Dokumen\Repository\DokumenCreatorRepository;

/**
 * Service.
 */
final class DokumenCreator
{
    /**
     * @var UserCreatorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param DokumenCreatorRepository $repository The repository
     */
    public function __construct(DokumenCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new Dokumen.
     *
     * @param array $data The form data
     *
     * @return int The new Dokumen ID
     */
    public function createDokumen(array $data): int
    {
        // Insert user
        $dokumenId = $this->repository->insertDokumen($data);

        return $dokumenId;
    }

     /**
     * delete a Dokumen.
     *
     * @param int $dokumenid The form data
     *
     * @return int The deleted Dokumen ID
     */
    public function deleteDokumen(int $dokumenid): int
    {
        // delete dokumen
        $rowDeleted = $this->repository->deleteDokumen($dokumenid);

        return $rowDeleted;// rowCount deleted 
    }

    public function updateDokumen(array $data):int
    {
        // Insert user
        $dokumenId = $this->repository->updateDokumen($data);

        return $dokumenId;
    }
}