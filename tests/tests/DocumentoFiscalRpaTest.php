<?php

use MotorFiscal\Destinatario;
use MotorFiscal\DocumentoFiscal;
use MotorFiscal\Emitente;
use MotorFiscal\Operacao;
use MotorFiscal\Produto;
use PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-01-12 at 13:57:15.
 */
class DocumentoFiscalRpaTest extends TestCase
{
    /**
     * @var \MotorFiscal\DocumentoFiscal
     */
    protected $NF;

    /**
     * @var ICMS
     */
    protected $object;

    public function testCST00IPI_ICMSSTND()
    {
        $prod = new Produto();
        $prod->identificador = 1;
        $prod->TipoTributacaoIPI = 0;
        $prod->FormaAquisicao = 1; //Adquirida de Terceiros
        $prod->vProd = 100;
        $prod->vDesc = 10;
        $prod->vFrete = 10;
        $prod->vOutro = 10;
        $prod->vSeg = 10;
        $this->NF->itens = [];
        $item = &$this->NF->addItem($prod);
        $this->NF->totalizarDocumento();
        $this->assertEquals('00', $item->imposto->ICMS->CST, 'CST');
        $this->assertNull( $item->imposto->ICMS->CSOSN, 'CSOSN');
        $this->assertEquals(3, $item->imposto->ICMS->modBC, 'modBC');
        $this->assertNull( $item->imposto->ICMS->pRedBC, 'pRedBC');
        $this->assertEquals(120, $item->imposto->ICMS->vBC, 'vBC');
        $this->assertNull( $item->imposto->ICMS->vBC_Desonerado, 'vBC_Desonerado');
        $this->assertEquals(12, $item->imposto->ICMS->pICMS, 'pICMS');
        $this->assertNull( $item->imposto->ICMS->pICMS_Desonerado, 'pICMS_Desonerado');
        $this->assertNull( $item->imposto->ICMS->pDif, 'pDif');
        $this->assertNull( $item->imposto->ICMS->vICMSDif, 'vICMSDif');
        $this->assertEquals('14.40', $item->imposto->ICMS->vICMS, 'vICMS');
        $this->assertNull( $item->imposto->ICMS->vICMS_Desonerado, 'vICMS_Desonerado');
        $this->assertNull( $item->imposto->ICMS->modBCST, 'modBCST');
        $this->assertNull( $item->imposto->ICMS->pMVAST, 'pMVAST');
        $this->assertNull( $item->imposto->ICMS->pRedBCST, 'pRedBCST');
        $this->assertNull( $item->imposto->ICMS->vBCST, 'vBCST');
        $this->assertEquals(258, $item->imposto->ICMS->vBCST_NaoDestacado, 'vBCST_NaoDestacado');
        $this->assertNull( $item->imposto->ICMS->pICMSST, 'pICMSST');
        $this->assertNull( $item->imposto->ICMS->vICMSST, 'vICMSST');
        $this->assertEquals('29.46', $item->imposto->ICMS->vICMSST_NaoDestacado, 'vICMSST_NaoDestacado');
        $this->assertNull( $item->imposto->ICMS->UFST, 'UFST');
        $this->assertNull( $item->imposto->ICMS->pBCOp, 'pBCOp');
        $this->assertNull( $item->imposto->ICMS->vBCSTRet, 'vBCSTRet');
        $this->assertNull( $item->imposto->ICMS->vICMSSTRet, 'vICMSSTRet');
        $this->assertNull( $item->imposto->ICMS->UFST, 'UFST');
        $this->assertNull( $item->imposto->ICMS->vICMSDeson, 'vICMSDeson');
        $this->assertNull( $item->imposto->ICMS->motDesICMS, 'motDesICMS');
        $this->assertNull( $item->imposto->ICMS->pCredSN, 'pCredSN');
        $this->assertNull( $item->imposto->ICMS->vCredICMSSN, 'vCredICMSSN');
        $this->assertNull( $item->imposto->ICMS->vBCSTDest, 'vBCSTDest');
        $this->assertNull( $item->imposto->ICMS->vICMSSTDest, 'vICMSSTDest');
        $this->assertEquals('105.6', $item->imposto->PIS->vBC, 'PIS->vBC');
        $this->assertEquals('1.74', $item->imposto->PIS->vPIS, 'vPIS');
        $this->assertEquals('01', $item->imposto->PIS->CST, 'CST');
        $this->assertEquals('18.00', $item->imposto->vTotTrib, 'vTotTrib');
        $this->assertEquals('1.65', $item->imposto->PIS->pPIS, 'pPIS');
        $this->assertEquals(999, $item->imposto->IPI->clEnq, 'clEnq');
        $this->assertEquals(999, $item->imposto->IPI->CNPJProd, 'CNPJProd');
        $this->assertEquals(999, $item->imposto->IPI->cSelo, 'cSelo');
        $this->assertEquals(999, $item->imposto->IPI->qSelo, 'qSelo');
        $this->assertEquals(999, $item->imposto->IPI->cEnq, 'cEnq');
        $this->assertNull( $item->imposto->ISSQN, 'ISSQN Nulo');

        $this->assertEquals(1, $item->nItem, 'Número do Item');
    }

    public function testCST10IPIAliquotaZero_ICMSSTD()
    {
        $prod = new Produto();
        $prod->identificador = 2;
        $prod->TipoTributacaoIPI = 0;
        $prod->FormaAquisicao = 1; //Adiquirida de Terceiros
        $prod->vProd = 100;
        $prod->vDesc = 0;
        $prod->vFrete = 0;
        $prod->vOutro = 0;
        $prod->vSeg = 0;
        $this->NF->itens = [];
        $item = &$this->NF->addItem($prod);
        $this->NF->totalizarDocumento();
        $this->assertEquals('10', $item->imposto->ICMS->CST, 'CST');
        $this->assertNull( $item->imposto->ICMS->CSOSN, 'CSOSN');
        $this->assertEquals(3, $item->imposto->ICMS->modBC, 'modBC');
        $this->assertNull( $item->imposto->ICMS->pRedBC, 'pRedBC');
        $this->assertEquals(100, $item->imposto->ICMS->vBC, 'vBC');
        $this->assertNull( $item->imposto->ICMS->vBC_Desonerado, 'vBC_Desonerado');
        $this->assertEquals(12, $item->imposto->ICMS->pICMS, 'pICMS');
        $this->assertNull( $item->imposto->ICMS->pICMS_Desonerado, 'pICMS_Desonerado');
        $this->assertNull( $item->imposto->ICMS->pDif, 'pDif');
        $this->assertNull( $item->imposto->ICMS->vICMSDif, 'vICMSDif');
        $this->assertEquals('12.00', $item->imposto->ICMS->vICMS, 'vICMS');
        $this->assertNull( $item->imposto->ICMS->vICMS_Desonerado, 'vICMS_Desonerado');
        $this->assertEquals(4, $item->imposto->ICMS->modBCST, 'modBCST');
        $this->assertEquals(100, $item->imposto->ICMS->pMVAST, 'pMVAST');
        $this->assertEquals(0, $item->imposto->ICMS->pRedBCST, 'pRedBCST');
        $this->assertEquals(200, $item->imposto->ICMS->vBCST, 'vBCST');
        $this->assertNull( $item->imposto->ICMS->vBCST_NaoDestacado, 'vBCST_NaoDestacado');
        $this->assertEquals(17, $item->imposto->ICMS->pICMSST, 'pICMSST');
        $this->assertEquals(22, $item->imposto->ICMS->vICMSST, 'vICMSST');
        $this->assertNull( $item->imposto->ICMS->vICMSST_NaoDestacado, 'vICMSST_NaoDestacado');
        $this->assertNull( $item->imposto->ICMS->UFST, 'UFST');
        $this->assertNull( $item->imposto->ICMS->pBCOp, 'pBCOp');
        $this->assertNull( $item->imposto->ICMS->vBCSTRet, 'vBCSTRet');
        $this->assertNull( $item->imposto->ICMS->vICMSSTRet, 'vICMSSTRet');
        $this->assertNull( $item->imposto->ICMS->UFST, 'UFST');
        $this->assertNull( $item->imposto->ICMS->vICMSDeson, 'vICMSDeson');
        $this->assertNull( $item->imposto->ICMS->motDesICMS, 'motDesICMS');
        $this->assertNull( $item->imposto->ICMS->pCredSN, 'pCredSN');
        $this->assertNull( $item->imposto->ICMS->vCredICMSSN, 'vCredICMSSN');
        $this->assertNull( $item->imposto->ICMS->vBCSTDest, 'vBCSTDest');
        $this->assertNull( $item->imposto->ICMS->vICMSSTDest, 'vICMSSTDest');
        $this->assertEquals('88', $item->imposto->PIS->vBC, 'PIS->vBC');
        $this->assertEquals('1.45', $item->imposto->PIS->vPIS, 'vPIS');
        $this->assertEquals('01', $item->imposto->PIS->CST, 'CST');
        $this->assertEquals('20.00', $item->imposto->vTotTrib, 'vTotTrib');
        $this->assertEquals('1.65', $item->imposto->PIS->pPIS, 'pPIS');
        $this->assertEquals(999, $item->imposto->IPI->clEnq, 'clEnq');
        $this->assertEquals(999, $item->imposto->IPI->CNPJProd, 'CNPJProd');
        $this->assertEquals(999, $item->imposto->IPI->cSelo, 'cSelo');
        $this->assertEquals(999, $item->imposto->IPI->qSelo, 'qSelo');
        $this->assertEquals(999, $item->imposto->IPI->cEnq, 'cEnq');
        $this->assertNull( $item->imposto->ISSQN, 'ISSQN Nulo');

        $this->assertEquals(1, $item->nItem, 'Número do Item');
    }

    public function testCST10IPINaoContribuinte_ICMSSTD()
    {
        $prod = new Produto();
        $prod->identificador = 2;
        $prod->TipoTributacaoIPI = 0;
        $prod->FormaAquisicao = 1; //Adiquirida de Terceiros
        $prod->vProd = 100;
        $prod->vDesc = 0;
        $prod->vFrete = 0;
        $prod->vOutro = 0;
        $prod->vSeg = 0;
        $this->NF->itens = [];
        $item = &$this->NF->addItem($prod);
        $this->NF->totalizarDocumento();
        $this->assertEquals('10', $item->imposto->ICMS->CST, 'CST');
        $this->assertNull( $item->imposto->ICMS->CSOSN, 'CSOSN');
        $this->assertEquals(3, $item->imposto->ICMS->modBC, 'modBC');
        $this->assertNull( $item->imposto->ICMS->pRedBC, 'pRedBC');
        $this->assertEquals(100, $item->imposto->ICMS->vBC, 'vBC');
        $this->assertNull( $item->imposto->ICMS->vBC_Desonerado, 'vBC_Desonerado');
        $this->assertEquals(12, $item->imposto->ICMS->pICMS, 'pICMS');
        $this->assertNull( $item->imposto->ICMS->pICMS_Desonerado, 'pICMS_Desonerado');
        $this->assertNull( $item->imposto->ICMS->pDif, 'pDif');
        $this->assertNull( $item->imposto->ICMS->vICMSDif, 'vICMSDif');
        $this->assertEquals('12.00', $item->imposto->ICMS->vICMS, 'vICMS');
        $this->assertNull( $item->imposto->ICMS->vICMS_Desonerado, 'vICMS_Desonerado');
        $this->assertEquals(4, $item->imposto->ICMS->modBCST, 'modBCST');
        $this->assertEquals(100, $item->imposto->ICMS->pMVAST, 'pMVAST');
        $this->assertEquals(0, $item->imposto->ICMS->pRedBCST, 'pRedBCST');
        $this->assertEquals(200, $item->imposto->ICMS->vBCST, 'vBCST');
        $this->assertNull( $item->imposto->ICMS->vBCST_NaoDestacado, 'vBCST_NaoDestacado');
        $this->assertEquals(17, $item->imposto->ICMS->pICMSST, 'pICMSST');
        $this->assertEquals(22, $item->imposto->ICMS->vICMSST, 'vICMSST');
        $this->assertNull( $item->imposto->ICMS->vICMSST_NaoDestacado, 'vICMSST_NaoDestacado');
        $this->assertNull( $item->imposto->ICMS->UFST, 'UFST');
        $this->assertNull( $item->imposto->ICMS->pBCOp, 'pBCOp');
        $this->assertNull( $item->imposto->ICMS->vBCSTRet, 'vBCSTRet');
        $this->assertNull( $item->imposto->ICMS->vICMSSTRet, 'vICMSSTRet');
        $this->assertNull( $item->imposto->ICMS->UFST, 'UFST');
        $this->assertNull( $item->imposto->ICMS->vICMSDeson, 'vICMSDeson');
        $this->assertNull( $item->imposto->ICMS->motDesICMS, 'motDesICMS');
        $this->assertNull( $item->imposto->ICMS->pCredSN, 'pCredSN');
        $this->assertNull( $item->imposto->ICMS->vCredICMSSN, 'vCredICMSSN');
        $this->assertNull( $item->imposto->ICMS->vBCSTDest, 'vBCSTDest');
        $this->assertNull( $item->imposto->ICMS->vICMSSTDest, 'vICMSSTDest');
        $this->assertEquals('88', $item->imposto->PIS->vBC, 'PIS->vBC');
        $this->assertEquals('1.45', $item->imposto->PIS->vPIS, 'vPIS');
        $this->assertEquals('01', $item->imposto->PIS->CST, 'CST');
        $this->assertEquals('20.00', $item->imposto->vTotTrib, 'vTotTrib');
        $this->assertEquals('1.65', $item->imposto->PIS->pPIS, 'pPIS');
        $this->assertEquals(999, $item->imposto->IPI->clEnq, 'clEnq');
        $this->assertEquals(999, $item->imposto->IPI->CNPJProd, 'CNPJProd');
        $this->assertEquals(999, $item->imposto->IPI->cSelo, 'cSelo');
        $this->assertEquals(999, $item->imposto->IPI->qSelo, 'qSelo');
        $this->assertEquals(999, $item->imposto->IPI->cEnq, 'cEnq');
        $this->assertNull( $item->imposto->ISSQN, 'ISSQN Nulo');

        $this->assertEquals(1, $item->nItem, 'Número do Item');
    }

    public function testNFSe()
    {
        $prod = new Produto();
        $prod->identificador = 1;
        $prod->TipoTributacaoIPI = 0;
        $prod->vProd = 10000;
        $prod->tipoItem = 1; //item de servi�o
        $prod->cMunFG = '9999999'; //item de servi�o
        $prod->cMun = 111111; //item de servi�o
        $prod->cListServ = 1; //item de servi�o
        $prod->cServico = 1; //item de servi�o
        $prod->indISS = '2'; //item de servi�o
        $prod->nProcesso = 99999999; //item de servi�o
        $prod->cPais = 99999999; //item de servi�o
        $prod->indIncentivo = 1; //item de servi�o
        $this->NF->itens = [];
        $item = &$this->NF->addItem($prod);
        $this->NF->totalizarDocumento();
        $this->assertNull( $item->imposto->ICMS, 'ICMS Nulo');
        $this->assertNull( $item->imposto->IPI, 'IPI Nulo');
        $this->assertEquals(10000, $item->imposto->ISSQN->vBC, 'Base de Calculo');
        $this->assertEquals(15, $item->imposto->ISSQN->vAliq, 'Aliquota ISSQN');
        $this->assertEquals(1500, $item->imposto->ISSQN->vISSQN, 'Valor ISSQN');
        $this->assertEquals(1500, $item->imposto->ISSQN->vISSQN, 'Valor ISSQN');
        $this->assertNotEquals(null, $item->imposto->ISSQN, 'ISSQN Nulo');
        $this->assertEquals(65, $item->imposto->ISSQN->vRetPIS, 'Reten��o de PIS');
        $this->assertEquals(300, $item->imposto->ISSQN->vRetCOFINS, 'Reten��o de COFINS');
        $this->assertEquals(150, $item->imposto->ISSQN->vRetIR, 'Reten��o de IR');
        $this->assertEquals(100, $item->imposto->ISSQN->vRetCSLL, 'Reten��o de CSLL');
        $this->assertEquals(1100, $item->imposto->ISSQN->vRetINSS, 'Reten��o de INSS');
        $this->assertEquals(1715, $item->imposto->ISSQN->vOutro, 'Outras reten��es');
        $this->assertEquals(1500, $item->imposto->ISSQN->vISSRet, 'Reten��o de ISS');
        $this->assertEquals(10000, $this->NF->ISSQNtot->vServ, 'Total do vServ  do grupo ISSQNtot');
        $this->assertEquals(10000, $this->NF->ISSQNtot->vBC, 'Total do vBC  do grupo ISSQNtot');
        $this->assertEquals(1500, $this->NF->ISSQNtot->vISS, 'Total do vISS  do grupo ISSQNtot');
        $this->assertEquals(165, $this->NF->ISSQNtot->vPIS, 'Total do vPIS  do grupo ISSQNtot');
        $this->assertEquals(760, $this->NF->ISSQNtot->vCOFINS, 'Total do vCOFINS  do grupo ISSQNtot');
        $this->assertEquals(0, $this->NF->ISSQNtot->vDeducao, 'Total do vDeducao  do grupo ISSQNtot');
        $this->assertEquals(1715, $this->NF->ISSQNtot->vOutro, 'Total do vOutro  do grupo ISSQNtot');
        $this->assertEquals(0, $this->NF->ISSQNtot->vDescIncond, 'Total do vDescIncond  do grupo ISSQNtot');
        $this->assertEquals(0, $this->NF->ISSQNtot->vDescCond, 'Total do vDescCond  do grupo ISSQNtot');
        $this->assertEquals(65, $this->NF->retTrib->vRetPIS, 'Total do vRetPIS do grupo ISSQNtot');
        $this->assertEquals(300, $this->NF->retTrib->vRetCOFINS, 'Total do vRetCOFINS do grupo retTrib');
        $this->assertEquals(100, $this->NF->retTrib->vRetCSLL, 'Total do vRetCSLL do grupo retTrib');
        $this->assertEquals(10000, $this->NF->retTrib->vBCIRRF, 'Total do vBCIRRF do grupo retTrib');
        $this->assertEquals(150, $this->NF->retTrib->vIRRF, 'Total do vIRRF do grupo retTrib');
        $this->assertEquals(10000, $this->NF->retTrib->vBCRetPrev, 'Total do vBCRetPrev do grupo retTrib');
        $this->assertEquals(1100, $this->NF->retTrib->vRetPrev, 'Total do vRetPrev do grupo retTrib');
        $this->assertEquals(1, $item->nItem, 'Número do Item');
        //$this->assertEquals(1, $this->NF->,"Valor da NF");
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $emitente = new Emitente();
        $emitente->identificador = 1;
        $emitente->ContribuinteIPI = 1;
        $emitente->CRT = 3;
        $emitente->PercCreditoSimples = 0;
        $destinatario = new Destinatario();
        $destinatario->identificador = 1;
        $operacao = new Operacao();
        $operacao->identificador = 1;
        $operacao->CFOPMercadoria = 5102;
        $operacao->CFOPMercadoriaST = 5102;
        $operacao->CFOPMercadoriaSTSubstituido = 5102;
        $operacao->CFOPProduto = 5409;
        $operacao->CFOPProdutoST = 5409;
        $operacao->TipoOperacao = 0; //=Entrada;;
        $operacao->identificacao = 1; //=Opera��o interna;;
        $operacao->finalidade = 1;
        $operacao->indFinal = 0;
        $operacao->indPres = 0;
        $operacao->NaturezaOperacao = 'Venda a consumidor final';
        $this->NF = new DocumentoFiscal($emitente, $destinatario, $operacao);
        $this->NF->tipoParametroPesquisa = true;

        $this->NF->buscaTribFunctionICMS = function (Produto $produto,
                                                     Operacao $operacao,
                                                     Emitente $emitente,
                                                     Destinatario $destinatario) {
            return Trib::ICMS($produto->identificador, $operacao->identificador, $emitente->identificador,
                              $destinatario->identificador);
        };
        $this->NF->buscaTribFunctionIPI = function (Produto $produto,
                                                     Operacao $operacao,
                                                     Emitente $emitente,
                                                     Destinatario $destinatario) {
            return Trib::IPI($produto->identificador, $operacao->identificador, $emitente->identificador,
                             $destinatario->identificador);
        };

        $this->NF->buscaTribFunctionPIS = function (Produto $produto,
                                                    Operacao $operacao,
                                                    Emitente $emitente,
                                                    Destinatario $destinatario) {
            return Trib::PIS($produto->identificador, $operacao->identificador, $emitente->identificador,
                             $destinatario->identificador);
        };

        $this->NF->buscaTribFunctionCOFINS = function (Produto $produto,
                                                       Operacao $operacao,
                                                       Emitente $emitente,
                                                       Destinatario $destinatario) {
            return Trib::COFINS($produto->identificador, $operacao->identificador, $emitente->identificador,
                                $destinatario->identificador);
        };

        $this->NF->buscaTribFunctionIBPT = function (Produto $produto) {
            if ($produto->tipoItem == 0) {
                $ret = new \stdClass();
                $ret->PercTribFed = 10;
                $ret->PercTribEst = 10;
                $ret->PercTribMun = 0;
            } else {
                $ret = new \stdClass();
                $ret->PercTribFed = 10;
                $ret->PercTribEst = 0;
                $ret->PercTribMun = 15;

                return $ret;
            }

            return $ret;
        };

        $this->NF->buscaTribFunctionISSQN = function ($produto) {
            $ret = new \stdClass();
            $ret->Aliquota = 15;
            //Reten��o de ISS
            $ret->ISSRetemPF = true;
            $ret->ISSValorMinRetPF = 100;
            $ret->ISSRetemPJ = true;
            $ret->ISSValorMinRetPJ = 1000;
            //Reten��o de IR
            $ret->IRRetem = true;
            $ret->IRRetPerc = 1.5;
            //reten��o CSLL
            $ret->CSLLRetem = true;
            $ret->CSLLRetPerc = 1;
            //reten��o INSS
            $ret->INSSRetem = true;
            $ret->INSSRetPerc = 11;
            //reten��o COFINS/PIS
            $ret->PISCOFINSRetem = true;
            $ret->PISRetPerc = 0.65;
            $ret->COFINSRetPerc = 3;
            $ret->vMinRetImpFed = 10;

            return $ret;
        };
    }
}
