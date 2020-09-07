<?php

namespace App\Domain\Dokumen\Repository;

use App\Domain\Dokumen\Data\DokumenData;
use DomainException;
use PDO;

/**
 * Repository.
 */
class DokumenReaderRepository
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
     * Get dokumen by the given dokumen id.
     *
     * @param int $dokumenId The dokumen id
     *
     * @throws DomainException
     *
     * @return DokumenData The Dokumen data
     */
    public function getDokumenById(int $dokumenId): DokumenData
    {
        $sql = "SELECT * FROM logdokumen WHERE id = :id;";
        $statement = $this->connection->prepare($sql);
        $statement->execute(['id' => $dokumenId]);

        $row = $statement->fetch();

        if (!$row) {
            throw new DomainException(sprintf('Dokumen not found: %s', $dokumenId));
        }

        // Map array to data object
        $dokumen = new DokumenData();
        $dokumen->id = (int) $row['id'];
        $dokumen->realId = (int) $row['realid'];
        $dokumen->keterangan = $row['keterangan'];
        $dokumen->namaReviewer = $row['nama_reviewer'];
        $dokumen->tanggal = $row['tanggal'];
        $dokumen->versi = $row['versi'];
        $dokumen->jenisDoc = $row['jenis_dok'];
        $dokumen->realIdKontrak = $row['realid_kontrak'];
        $dokumen->linkPdf = $row['link_pdf'];
        $dokumen->linkDoc = $row['link_doc'];

        return $dokumen;
    }

    /**
     * @param int $kontrakrealid The kontrak real id
     * @param String $codedoc The code dokumen
     *
     * @throws DomainException
     *
     * @return DokumenData[] List of Dokumen data
     */
    public function getDokumen($idkontrak,$codedoc): array
    {
        $sql = "SELECT * FROM logdokumen WHERE realid_kontrak= :realidkontrak AND jenis_dok= :jenisDoc ORDER BY versi DESC;";
        $statement = $this->connection->prepare($sql);
        $statement->execute(['realidkontrak' => $idkontrak,'jenisDoc' => $codedoc]);

        $rows = $statement->fetchAll();
        if (!$rows) {
            throw new DomainException(sprintf('Error getAllDokumen'));
        }
        return $rows;
    }

}
// Core Infra STOCI
// End User Support STEUS
// Network&Telephony STONT
// Cyber Security STOCS
