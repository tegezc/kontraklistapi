<?php
namespace App\Domain\Dokumen\Data;
class TypeDokumenData{
    public $code;
    public $nama;

    public function __construct($code, $nama)
    {
      $this->code = $code;
      $this->nama = $nama;  
    }

    public static function paketEnginering(){
      return new self(self::PE_CODE,self::PE_TEXT);
    }
    public static function tor(){
      return new self(self::TOR_CODE,self::TOR_TEXT);
    }
    public static function specTeknis(){
      return new self(self::ST_CODE,self::ST_TEXT);
    }
    public static function hps(){
      return new self(self::HPS_CODE,self::HPS_TEXT);
    }
    public static function sp(){
      return new self(self::SP_CODE,self::SP_TEXT);
    }

    const PE_CODE = "PE";
    const PE_TEXT = "PE - Paket Enginering";
    const TOR_CODE = "TOR";
    const TOR_TEXT = "TOR - Term Of Reference";
    const ST_CODE = "ST";
    const ST_TEXT = "Spec Teknis";
    const HPS_CODE = "HPS";
    const HPS_TEXT = "OE / HPS";
    const SP_CODE = "SP";
    const SP_TEXT = "SP - Surat Perjanjian";
    
  }