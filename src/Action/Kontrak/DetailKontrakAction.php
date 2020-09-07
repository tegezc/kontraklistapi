<?php

namespace App\Action\Kontrak;

use App\Domain\Dokumen\Service\DokumenReader;
use App\Domain\Kontrak\Service\KontrakReader;
use App\Domain\Dokumen\Data\TypeDokumenData;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 */
final class DetailKontrakAction
{
    /**
     * @var KontrakReader
     */
    private $kontrakReader;
    private $dokumenReader;

    /**
     * The constructor.
     *
     * @param KontrakReader $userReader The kontrak reader
     */
    public function __construct(KontrakReader $kontrakReader, DokumenReader $dokumenReader)
    {
        $this->kontrakReader = $kontrakReader;
        $this->dokumenReader = $dokumenReader;
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
        $kontrakId = (int) $args['id'];

        // get kontrak data
        $kontrakData = $this->kontrakReader->getKontrakDetail($kontrakId);

        //get dokumen PE
        $dokumenTypePE = TypeDokumenData::paketEnginering();
        $dokumenPE = $this->dokumenReader->getDokumenByCode($kontrakData->realID, $dokumenTypePE->code);

        //get dokumen TOR
        $dokumenTypeTOR = TypeDokumenData::tor();
        $dokumenTOR = $this->dokumenReader->getDokumenByCode($kontrakData->realID, $dokumenTypeTOR->code);

        //get dokumen ST
        $dokumenTypeST = TypeDokumenData::specTeknis();
        $dokumenST = $this->dokumenReader->getDokumenByCode($kontrakData->realID, $dokumenTypeST->code);

        //get dokumen HPS
        $dokumenTypeHPS = TypeDokumenData::hps();
        $dokumenHPS = $this->dokumenReader->getDokumenByCode($kontrakData->realID, $dokumenTypeHPS->code);

        //get dokumen SP
        $dokumenTypeSP = TypeDokumenData::sp();
        $dokumenSP = $this->dokumenReader->getDokumenByCode($kontrakData->realID, $dokumenTypeSP->code);

        $dataresponse = array(
            "detail" => $kontrakData,
            "pe" => $dokumenPE,
            "tor" => $dokumenTOR,
            "st" => $dokumenST,
            "hps" => $dokumenHPS,
            "sp" => $dokumenSP,
        );

        // Build the HTTP response
        $response->getBody()->write((string) json_encode($dataresponse));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
