<?php

namespace App\Domain\Dokumen\Repository;

use PDO;

/**
 * Repository.
 */
class DokumenCreatorRepository
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
     * Insert Dokumen row.
     *
     * @param array $dokumen The dokumen
     *
     * @return int The new ID
     */
    public function insertDokumen(array $dokumen): int
    {
        $date = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
        $date = $date->format('d-m-Y H:i:s a');
        $stamp = strtotime($date); // get unix timestamp
        $time_in_ms = $stamp * 1000;
        $row = [
            'realid' => $time_in_ms,
            'keterangan' => $dokumen['keterangan'],
            'nama_reviewer' => $dokumen['nama_reviewer'],
            'tanggal' => $dokumen['tanggal'],
            'versi' => $dokumen['versi'],
            'jenis_dok' => $dokumen['jenis_dok'],
            'realid_kontrak' => $dokumen['realid_kontrak'],
            'link_pdf' => $dokumen['link_pdf'],
            'link_doc' => $dokumen['link_doc'],
        ];

        $sql = "INSERT INTO logdokumen SET 
                realid=:realid, 
                keterangan=:keterangan, 
                nama_reviewer=:nama_reviewer, 
                tanggal=:tanggal, 
                versi=:versi, 
                jenis_dok=:jenis_dok, 
                realid_kontrak=:realid_kontrak, 
                link_pdf=:link_pdf, 
                link_doc=:link_doc;";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }

     /**
     * delete Dokumen row.
     *
     * @param $dokumenid $dokumen The dokumen
     *
     * @return int The deleted ID
     */
    public function deleteDokumen(int $dokumenid): int
    {
        $sql = "DELETE FROM logdokumen WHERE id= :dokumenid;";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['dokumenid'=>$dokumenid]);

        return (int)$stmt->rowCount();
    }
}
