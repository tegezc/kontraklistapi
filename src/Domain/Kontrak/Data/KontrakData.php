<?php

namespace App\Domain\Kontrak\Data;

final class KontrakData {
     /**
     * @var int
     */
    public $id;

   /** @var int */
    public $realID;

     /** @var string */
    public $noKontrak;

     /** @var string */
    public $nama;

     /** @var string */
    public $namaUnit;

    /** @var string */
    public $anakPerusahaan;

     /** @var string */
    public $region;

     /** @var string */
    public $stream;

     /** @var int */
    public $durasi;

     /** @var int */
    public $nilai;

     /** @var DateTime */
    public $tglMulai;

     /** @var DateTime */
    public $tglBerakhir;

      /** @var string */
    public $nmPICKontrak;

      /** @var string */
    public $noHpPICKontrak;

      /** @var string */
    public $emailPICKontrak;

      /** @var string */
    public $nmVendor;

      /** @var string */
    public $nmPICVendor;

      /** @var string */
    public $noHpPICVendor;

      /** @var string */
    public $emailPICVendor;

      /** @var string */
    public $direksi;

      /** @var string */
    public $penandatangan;

      /** @var string */
    public $kontrakAwal;

    /** @var int */
    public $flagberakhir;
  

  }
  
  // `id` int(11) NOT NULL,
  // `realid` bigint(20) NOT NULL,
  // `nokontrak` varchar(50) DEFAULT NULL,
  // `nama` text NOT NULL,
  // `namaunit` varchar(100) NOT NULL,
  // `anakperusahaan` varchar(100) NOT NULL,
  // `region` varchar(100) NOT NULL,
  // `stream` varchar(100) NOT NULL,
  // `durasi` tinyint(4) DEFAULT NULL,
  // `nilai` bigint(20) DEFAULT NULL,
  // `tanggal_mulai` date DEFAULT NULL,
  // `tanggal_berakhir` date DEFAULT NULL,
  // `nm_pic_kontrak` varchar(100) DEFAULT NULL,
  // `hp_pic_kontrak` varchar(20) DEFAULT NULL,
  // `email_pic_kontrak` varchar(100) DEFAULT NULL,
  // `vendor_pemenanga` varchar(100) DEFAULT NULL,
  // `nm_pic_vendor` varchar(100) DEFAULT NULL,
  // `no_pic_vendor` varchar(20) DEFAULT NULL,
  // `email_pic_vendor` varchar(100) DEFAULT NULL,
  // `direksi` varchar(200) DEFAULT NULL,
  // `penandatangan` varchar(200) DEFAULT NULL,
  // `kontrak_awal` varchar(50) DEFAULT NULL