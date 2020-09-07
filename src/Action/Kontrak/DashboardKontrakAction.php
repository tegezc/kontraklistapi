<?php

namespace App\Action\Kontrak;

use App\Domain\Kontrak\Service\KontrakReader;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 */
final class DashboardKontrakAction
{
    /**
     * @var KontrakReader
     */
    private $kontrakReader;

    /**
     * The constructor.
     *
     * @param KontrakReader $userReader The kontrak reader
     */
    public function __construct(KontrakReader $kontrakReader)
    {
        $this->kontrakReader = $kontrakReader;
    }

    /**
     * Invoke.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     * @param array $args The route arguments
     *
     * @return ResponseInterface The response
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args = []
    ): ResponseInterface {
          // ==== proses kontrak 0 - 90 hari ===============
        $a90dayslater = date_create('2020-09-01');
        date_add($a90dayslater, date_interval_create_from_date_string('90 days'));

        $dateMulai = date_create('2020-09-01');
       
        $mulai = date_format($dateMulai, 'Y-m-d');
        $akhir = date_format($a90dayslater,'Y-m-d');
    
         // Invoke the Domain with inputs and retain the result
         $data1to90 = $this->kontrakReader->getKontrakBetweenDate($mulai,$akhir);

           // ==== proses kontrak 91 - 180 hari ===============
         $a180dayslater = date_create('2020-09-01');
         date_add($a180dayslater, date_interval_create_from_date_string('180 days'));
       
         $dateMulai = date_create('2020-09-01');
         date_add($dateMulai, date_interval_create_from_date_string('91 days'));
        
         $mulai = date_format($dateMulai, 'Y-m-d');
         $akhir = date_format($a180dayslater,'Y-m-d');

          // Invoke the Domain with inputs and retain the result
          $data91to180 = $this->kontrakReader->getKontrakBetweenDate($mulai,$akhir);

           // ==== proses kontrak 181 - 360 hari ===============
         $a360dayslater = date_create('2020-09-01');
         date_add($a360dayslater, date_interval_create_from_date_string('360 days'));
       
         $dateMulai = date_create('2020-09-01');
         date_add($dateMulai, date_interval_create_from_date_string('181 days'));
        
         $mulai = date_format($dateMulai, 'Y-m-d');
         $akhir = date_format($a360dayslater,'Y-m-d');

          // Invoke the Domain with inputs and retain the result
          $data181to360 = $this->kontrakReader->getKontrakBetweenDate($mulai,$akhir);
     
         $dataresponse = array(
            "1"    => $data1to90,
            "2"  => $data91to180,
            "3"  => $data181to360,
        );

         // Build the HTTP response
         $response->getBody()->write((string)json_encode($dataresponse));
 
         return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}