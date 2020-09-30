<?php

namespace App\Domain\Kontrak\Repository;

use App\Domain\Kontrak\Data\KontrakData;
use DomainException;
use PDO;

/**
 * Repository.
 */
class KontrakReaderRepository
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
     * Get kontrak by the given kontrak id.
     *
     * @param int $kontrakId The kontrak id
     *
     * @throws DomainException
     *
     * @return KontrakData The Kontrak data
     */
    public function getKontrakByRealId(int $kontrakId): KontrakData
    {
        $sql = "SELECT * FROM kontrak WHERE realid = :id;";
        $statement = $this->connection->prepare($sql);
        $statement->execute(['id' => $kontrakId]);

        $row = $statement->fetch();

        if (!$row) {
            throw new DomainException(sprintf('kontrak not found: %s', $kontrakId));
        }

        // Map array to data object
        $kontrak = new KontrakData();
        $kontrak->id = (int) $row['id'];
        $kontrak->realID = (int) $row['realid'];

        $kontrak->noKontrak = $row['nokontrak'];
        $kontrak->nama = $row['nama'];
        $kontrak->namaUnit = $row['namaunit'];
        $kontrak->anakPerusahaan = $row['anakperusahaan'];
        $kontrak->region = $row['region'];
        $kontrak->stream = $row['stream'];
        $kontrak->durasi = $row['durasi'];
        $kontrak->nilai = $row['nilai'];
        $kontrak->tglMulai = $row['tanggal_mulai'];
        $kontrak->tglBerakhir = $row['tanggal_berakhir'];
        $kontrak->noHpPICKontrak = $row['nm_pic_kontrak'];
        $kontrak->noHpPICKontrak = $row['hp_pic_kontrak'];
        $kontrak->emailPICKontrak = $row['email_pic_kontrak'];
        $kontrak->nmVendor = $row['vendor_pemenanga'];
        $kontrak->nmPICVendor = $row['nm_pic_vendor'];
        $kontrak->noHpPICVendor = $row['no_pic_vendor'];
        $kontrak->emailPICVendor = $row['email_pic_vendor'];
        $kontrak->direksi = $row['direksi'];
        $kontrak->penandatangan = $row['penandatangan'];
        $kontrak->kontrakAwal = $row['kontrak_awal'];
        return $kontrak;
    }


    /**
     * Get kontrak by the given kontrak id.
     *
     * @param int $kontrakId The kontrak id
     *
     * @throws DomainException
     *
     * @return KontrakData The Kontrak data
     */
    public function getKontrakById(int $kontrakId): array
    {
        $sql = "SELECT * FROM kontrak WHERE id = :id;";
        $statement = $this->connection->prepare($sql);
        $statement->execute(['id' => $kontrakId]);

        $row = $statement->fetch();

        if (!$row) {
            throw new DomainException(sprintf('kontrak not found: %s', $kontrakId));
        }

        // Map array to data object
        // $kontrak = new KontrakData();
        // $kontrak->id = (int) $row['id'];
        // $kontrak->realID = (int) $row['realid'];

        // $kontrak->noKontrak = $row['nokontrak'];
        // $kontrak->nama = $row['nama'];
        // $kontrak->namaUnit = $row['namaunit'];
        // $kontrak->anakPerusahaan = $row['anakperusahaan'];
        // $kontrak->region = $row['region'];
        // $kontrak->stream = $row['stream'];
        // $kontrak->durasi = $row['durasi'];
        // $kontrak->nilai = $row['nilai'];
        // $kontrak->tglMulai = $row['tanggal_mulai'];
        // $kontrak->tglBerakhir = $row['tanggal_berakhir'];
        // $kontrak->noHpPICKontrak = $row['nm_pic_kontrak'];
        // $kontrak->noHpPICKontrak = $row['hp_pic_kontrak'];
        // $kontrak->emailPICKontrak = $row['email_pic_kontrak'];
        // $kontrak->nmVendor = $row['vendor_pemenanga'];
        // $kontrak->nmPICVendor = $row['nm_pic_vendor'];
        // $kontrak->noHpPICVendor = $row['no_pic_vendor'];
        // $kontrak->emailPICVendor = $row['email_pic_vendor'];
        // $kontrak->direksi = $row['direksi'];
        // $kontrak->penandatangan = $row['penandatangan'];
        // $kontrak->kontrakAwal = $row['kontrak_awal'];
        return $row;
    }

    /**
     *
     * @throws DomainException
     *
     * @return KontrakData[] List of kontrak data
     */
    public function getAllKontrak(): array
    {
        $sql = "SELECT * FROM kontrak;";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $rows = $statement->fetchAll();
        // if (!$rows) {
        //     throw new DomainException(sprintf('Error getAllKontrak'));
        // }
        return $rows;
    }

    /**
     *
     * @throws DomainException
     *
     * @return KontrakData[] List of kontrak data
     */
    public function getKontrakBetweenDate($dateawal, $dateakhir): array
    {

        $sql = "SELECT * FROM kontrak WHERE tanggal_berakhir BETWEEN ? AND ?;";
        $statement = $this->connection->prepare($sql);
        $statement->execute(array($dateawal, $dateakhir));

        $rows = $statement->fetchAll();
       // if (!$rows) {
           // throw new DomainException(sprintf('Error getKontrakBetweenDate'));
       // }
        return $rows;
    }

    /**
     * @param stream: String realid stream  jika null: all
     * @param typekontrak: 1:draft, 2:existing, 3:amandemen, jika 0 : all, not allow NULL value
     *
     * @throws DomainException
     *
     * @return KontrakData[] List of kontrak data
     */
    public function getKontrakFilter($stream, $typekontrak): array
    {
        $sql="";
        if($stream==null){
            $sql = "SELECT * FROM kontrak";
            if($typekontrak != 0){
                $sql = $sql." WHERE ";
            }
            
        }else if ($stream != null ){
            $sql = "SELECT * FROM kontrak WHERE stream=".$stream;
            if($typekontrak != 0){
                $sql = $sql." AND ";
            }
        }
        if($typekontrak==1){
            $sql = $sql."nokontrak IS NULL;";
        }else if ($typekontrak == 2){
            $sql = $sql."nokontrak IS NOT NULL;";
        }else if ($typekontrak == 3){
            $sql = $sql."kontrak_awal IS NULL;";
        }else if ($typekontrak == 0){
            $sql = $sql.";";
        }

       
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $rows = $statement->fetchAll();
        if (!$rows) {
            throw new DomainException(sprintf('Error getKontrakFilter'));
        }
        return $rows;
    }
}
// Core Infra STOCI
// End User Support STEUS
// Network&Telephony STONT
// Cyber Security STOCS
