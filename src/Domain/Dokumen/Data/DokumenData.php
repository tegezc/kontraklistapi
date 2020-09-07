<?php
namespace App\Domain\Dokumen\Data;
  final class DokumenData {
    /**
     * @var int
     */
     public $id;

    public $realId;
    public $realIdKontrak;
    public $namaReviewer;
    public $keterangan;
    public $tanggal;
    public $versi;
    public $jenisDoc;
    public $linkPdf;
    public $linkDoc;
  
  }
  // |Column|Type|Null|Default
  // |------
  // |//**id**//|int(11)|No|
  // |**realid**|bigint(20)|No|
  // |keterangan|text|Yes|NULL
  // |nama_reviewer|varchar(100)|No|
  // |tanggal|datetime|No|
  // |versi|smallint(6)|No|
  // |jenis_dok|varchar(100)|No|
  // |realid_kontrak|bigint(11)|No|
  // |link_pdf|varchar(1000)|No|
  // |link_doc|varchar(1000)|Yes|NULL