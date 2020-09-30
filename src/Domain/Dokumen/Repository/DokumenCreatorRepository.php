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
        $milliseconds = round(microtime(true) * 1000);
        $row = [
            'realid' => $milliseconds,
            'keterangan' => $dokumen['keterangan'],
            'nama_reviewer' => $dokumen['nama_reviewer'],
            'tanggal' => $dokumen['tanggal'],
            'versi' => $dokumen['versi'],
            'jenis_dok' => $dokumen['jenis_dok'],
            'realid_kontrak' => $dokumen['realid_kontrak'],
            'doc' => $dokumen['doc'],
        ];

        $sql = "INSERT INTO logdokumen SET 
                realid=:realid, 
                keterangan=:keterangan, 
                nama_reviewer=:nama_reviewer, 
                tanggal=:tanggal, 
                versi=:versi, 
                jenis_dok=:jenis_dok, 
                realid_kontrak=:realid_kontrak,
                doc=:doc;";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }

     /**
     * update Dokumen row.
     *
     * @param $dokumen The dokumen
     *
     * @return int The update ID
     */
    public function updateDokumen(array $dokumen):int
    {
      
        $row = [
            'keterangan' => $dokumen['keterangan'],
            'nama_reviewer' => $dokumen['nama_reviewer'],
            'realid' => $dokumen['realid']
        ];
       
        $sql = "UPDATE logdokumen SET 
                keterangan=:keterangan, 
                nama_reviewer=:nama_reviewer WHERE realid=:realid";

        $result = $this->connection->prepare($sql)->execute($row);

        return $result;
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
        $sql = "DELETE FROM logdokumen WHERE realid= :dokumenid;";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['dokumenid'=>$dokumenid]);

        return (int)$stmt->rowCount();
    }
}
