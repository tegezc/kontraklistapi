<?php

namespace App\Domain\Kontrak\Service;

use App\Domain\Kontrak\Data\KontrakData;
use App\Domain\Kontrak\Repository\KontrakReaderRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class KontrakReader
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
    public function __construct(KontrakReaderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a kontrak by the given kontrak id.
     *
     * @param int $userId The kontrak id
     *
     * @throws ValidationException
     *
     * @return KontrakData The kontrak data
     */
    public function getKontrakDetail(int $kontrakid): KontrakData
    {

        $kontrak = $this->repository->getKontrakById($kontrakid);

        return $kontrak;
    }


    /**
     *
     * @return array of object kontrak
     */
    public function getAllKontrak():array
    {
        $arrayuser = $this->repository->getAllKontrak();

        return $arrayuser;
    }

     /**
     *
     * @return array of object kontrak beetween datemulai dan dan selisih hari
     */
    public function getKontrakBetweenDate($dateawal,$dateakhir):array
    {
        $arrayuser = $this->repository->getKontrakBetweenDate($dateawal,$dateakhir);

        return $arrayuser;
    }

}