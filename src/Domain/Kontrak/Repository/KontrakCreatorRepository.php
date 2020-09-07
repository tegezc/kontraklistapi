<?php

namespace App\Domain\Kontrak\Repository;

use PDO;

/**
 * Repository.
 */
class KontrakCreatorRepository
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
     * Insert kontrak row.
     *
     * @param array $kontrak The kontrak
     *
     * @return int The new ID
     */
    public function insertKontrak(array $kontrak): int
    {
        $date = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
        $date = $date->format('d-m-Y H:i:s a');
        $stamp = strtotime($date); // get unix timestamp
        $time_in_ms = $stamp * 1000;
        $row = [
            'realid' => $time_in_ms,
            'nokontrak' => $kontrak['nokontrak'],
            'nama' => $kontrak['nama'],
            'namaunit' => $kontrak['namaunit'],
            'anakperusahaan' => $kontrak['anakperusahaan'],
            'region' => $kontrak['region'],
            'stream' => $kontrak['stream'],
            'durasi' => $kontrak['durasi'],
            'nilai' => $kontrak['nilai'],
            'tanggal_mulai' => $kontrak['tanggal_mulai'],
            'tanggal_berakhir' => $kontrak['tanggal_berakhir'],
            'nm_pic_kontrak' => $kontrak['nm_pic_kontrak'],
            'hp_pic_kontrak' => $kontrak['hp_pic_kontrak'],
            'email_pic_kontrak' => $kontrak['email_pic_kontrak'],
            'vendor_pemenanga' => $kontrak['vendor_pemenanga'],
            'nm_pic_vendor' => $kontrak['nm_pic_vendor'],
            'no_pic_vendor' => $kontrak['no_pic_vendor'],
            'email_pic_vendor' => $kontrak['email_pic_vendor'],
            'direksi' => $kontrak['direksi'],
            'penandatangan' => $kontrak['penandatangan'],
            'kontrak_awal' => $kontrak['kontrak_awal'],
        ];

        $sql = "INSERT INTO kontrak SET
            realid  = :realid,
            nokontrak  = :nokontrak ,
            nama  = :nama,
             namaunit  =:namaunit,
             anakperusahaan  =:anakperusahaan,
             region  =:region,
             stream  =:stream,
             durasi  =:durasi,
             nilai  =:nilai,
             tanggal_mulai  =:tanggal_mulai,
             tanggal_berakhir  =:tanggal_berakhir,
             nm_pic_kontrak  =:nm_pic_kontrak,
             hp_pic_kontrak  =:hp_pic_kontrak,
             email_pic_kontrak  =:email_pic_kontrak,
             vendor_pemenanga  =:vendor_pemenanga,
             nm_pic_vendor  =:nm_pic_vendor,
             no_pic_vendor  =:no_pic_vendor,
             email_pic_vendor  =:email_pic_vendor,
             direksi  =:direksi,
             penandatangan  =:penandatangan,
             kontrak_awal  =:kontrak_awal;";

        $this->connection->prepare($sql)->execute($row);

        return (int) $this->connection->lastInsertId();
    }

    /**
     * update kontrak row.
     *
     * @param array $kontrak The kontrak
     *
     * @return int The new ID
     */
    public function updateKontrak(array $kontrak)
    {
        $row = [
            'id' => $kontrak['id'],
            'nokontrak' => $kontrak['nokontrak'],
            'nama' => $kontrak['nama'],
            'namaunit' => $kontrak['namaunit'],
            'anakperusahaan' => $kontrak['anakperusahaan'],
            'region' => $kontrak['region'],
            'stream' => $kontrak['stream'],
            'durasi' => $kontrak['durasi'],
            'nilai' => $kontrak['nilai'],
            'tanggal_mulai' => $kontrak['tanggal_mulai'],
            'tanggal_berakhir' => $kontrak['tanggal_berakhir'],
            'nm_pic_kontrak' => $kontrak['nm_pic_kontrak'],
            'hp_pic_kontrak' => $kontrak['hp_pic_kontrak'],
            'email_pic_kontrak' => $kontrak['email_pic_kontrak'],
            'vendor_pemenanga' => $kontrak['vendor_pemenanga'],
            'nm_pic_vendor' => $kontrak['nm_pic_vendor'],
            'no_pic_vendor' => $kontrak['no_pic_vendor'],
            'email_pic_vendor' => $kontrak['email_pic_vendor'],
            'direksi' => $kontrak['direksi'],
            'penandatangan' => $kontrak['penandatangan'],
            'kontrak_awal' => $kontrak['kontrak_awal'],
        ];

        $sql = "UPDATE kontrak SET
            nokontrak  = :nokontrak ,
            nama  = :nama,
             namaunit  =:namaunit,
             anakperusahaan  =:anakperusahaan,
             region  =:region,
             stream  =:stream,
             durasi  =:durasi,
             nilai  =:nilai,
             tanggal_mulai  =:tanggal_mulai,
             tanggal_berakhir  =:tanggal_berakhir,
             nm_pic_kontrak  =:nm_pic_kontrak,
             hp_pic_kontrak  =:hp_pic_kontrak,
             email_pic_kontrak  =:email_pic_kontrak,
             vendor_pemenanga  =:vendor_pemenanga,
             nm_pic_vendor  =:nm_pic_vendor,
             no_pic_vendor  =:no_pic_vendor,
             email_pic_vendor  =:email_pic_vendor,
             direksi  =:direksi,
             penandatangan  =:penandatangan,
             kontrak_awal  =:kontrak_awal WHERE id= :id;";

        $result = $this->connection->prepare($sql)->execute($row);

        return $result;
    }

      /**
     * delete Kontrak row.
     *
     * @param $kontrakid The kontrak
     *
     * @return int The deleted ID
     */
    public function deleteKontrak(int $kontrakid): int
    {
        $sql = "DELETE FROM kontrak WHERE id= :kontrakid;";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['kontrakid'=>$kontrakid]);

        return (int)$stmt->rowCount();
    }
}
