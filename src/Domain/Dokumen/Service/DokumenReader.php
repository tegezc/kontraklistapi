<?php

namespace App\Domain\Dokumen\Service;

use App\Domain\Dokumen\Data\DokumenData;
use App\Domain\Dokumen\Repository\DokumenReaderRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class DokumenReader
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
    public function __construct(DokumenReaderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a Dokumen by the given Dokumen id.
     *
     * @param int $userId The Dokumen id
     *
     * @throws ValidationException
     *
     * @return DokumenData The Dokumen data
     */
    public function getDokumenDetail(int $dokumenid): DokumenData
    {

        $dokumen = $this->repository->getDokumenById($dokumenid);

        return $dokumen;
    }


    /**
     *
     * @return array of object Dokumen
     */
    public function getDokumenByCode($idkontrak,$codedoc):array
    {
        $arrayuser = $this->repository->getDokumen($idkontrak,$codedoc);

        return $arrayuser;
    }

    /**
     * Get dokumen by the given kontrak real id.
     *
     * @param int $dokumenId The kontrak real id
     *
     * @throws DomainException
     *
     * @return int max versi
     */
    public function getMaxVersionByDok(int $idkontrak,String $jnsdok): int
    {
        return $this->repository->getMaxVersionByDok($idkontrak,$jnsdok);
       
    }


}