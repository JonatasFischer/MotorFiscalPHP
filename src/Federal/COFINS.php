<?php
/**
 * Created by PhpStorm.
 * User: j.fischer
 * Date: 27.03.19
 * Time: 13:13.
 */

namespace MotorFiscal\Federal;

use MotorFiscal\Base;
use MotorFiscal\DocumentoFiscal;
use MotorFiscal\ItemFiscal;

class COFINS extends Base
{
    /**
     * NF-e/NFC-e :S06 - CST.
     */
    protected $CST;
    
    /**
     * NF-e/NFC-e :S07 - vBC.
     */
    protected $vBC;
    
    /**
     * NF-e/NFC-e :S08 - pCOFINS.
     */
    protected $pCOFINS;
    
    /**
     * NF-e/NFC-e :Q09 - qBCProd.
     */
    protected $qBCProd;
    
    /**
     * NF-e/NFC-e :S10 - vAliqProd.
     */
    protected $vAliqProd;
    
    /**
     * NF-e/NFC-e :S11 - vCOFINS.
     */
    protected $vCOFINS;
    
    
    /**
     * @return mixed
     */
    public function CST()
    {
        return $this->CST;
    }
    
    
    /**
     * @param mixed $CST
     *
     * @return COFINS
     */
    public function setCST($CST)
    {
        $this->CST = $CST;
        
        return $this;
    }
    
    
    /**
     * @return mixed
     */
    public function vBC()
    {
        return $this->vBC;
    }
    
    
    /**
     * @param mixed $vBC
     *
     * @return COFINS
     */
    public function setVBC($vBC)
    {
        $this->vBC = $vBC;
        
        return $this;
    }
    
    
    /**
     * @return mixed
     */
    public function pCOFINS()
    {
        return $this->pCOFINS;
    }
    
    
    /**
     * @param mixed $pCOFINS
     *
     * @return COFINS
     */
    public function setPCOFINS($pCOFINS)
    {
        $this->pCOFINS = $pCOFINS;
        
        return $this;
    }
    
    
    /**
     * @return mixed
     */
    public function qBCProd()
    {
        return $this->qBCProd;
    }
    
    
    /**
     * @param mixed $qBCProd
     *
     * @return COFINS
     */
    public function setQBCProd($qBCProd)
    {
        $this->qBCProd = $qBCProd;
        
        return $this;
    }
    
    
    /**
     * @return mixed
     */
    public function vAliqProd()
    {
        return $this->vAliqProd;
    }
    
    
    /**
     * @param mixed $vAliqProd
     *
     * @return COFINS
     */
    public function setVAliqProd($vAliqProd)
    {
        $this->vAliqProd = $vAliqProd;
        
        return $this;
    }
    
    
    /**
     * @return mixed
     */
    public function vCOFINS()
    {
        return $this->vCOFINS;
    }
    
    
    /**
     * @param mixed $vCOFINS
     *
     * @return COFINS
     */
    public function setVCOFINS($vCOFINS)
    {
        $this->vCOFINS = $vCOFINS;
        
        return $this;
    }
    
    
    /**
     * @param \MotorFiscal\DocumentoFiscal $documento
     * @param \MotorFiscal\ItemFiscal      $item
     *
     * @return \MotorFiscal\Federal\COFINS
     */
    public static function createFromItemAndDocumento(DocumentoFiscal $documento, ItemFiscal &$item)
    {
        
        $COFINS = new self();
        $COFINS->initialize($documento, $item);
        
        return $COFINS;
    }
    
    
    /**
     * @param \MotorFiscal\DocumentoFiscal $documento
     * @param \MotorFiscal\ItemFiscal      $item
     */
    protected function initialize(DocumentoFiscal $documento, ItemFiscal &$item)
    {
        
        $tributacaoCOFINS = $this->getTribCOFINS($documento, $item);
        
        $this->assign($tributacaoCOFINS);
        /* Calcula a Base do COFINS */
        switch ($tributacaoCOFINS->CST) {
            case '01':
            case '02':
                $this->setCST($tributacaoCOFINS->CST);
                $this->setPCOFINS($tributacaoCOFINS->AliquotaCofins);
                $this->setVBC($item->prod()->vProd() - $item->prod()->vDesc());
                $this->setvCOFINS(ceil($this->vBC() * $this->pCOFINS()) / 100);
                break;
            case '03':
                $this->setCST($tributacaoCOFINS->CST);
                $this->setQBCProd($item->prod()->qTrib());
                $this->setVAliqProd($tributacaoCOFINS->ValorCOFINS);
                $this->setVCOFINS($this->qBCProd() * $this->vAliqProd());
                break;
            case '04':
            case '05':
            case '06':
            case '07':
            case '08':
            case '09':
                $this->setCST($tributacaoCOFINS->CST);
                break;
            default:
                if ($tributacaoCOFINS->TipoTributacaoPISCOFINS == 0) {
                    $this->setCST($tributacaoCOFINS->CST);
                    $this->setPCOFINS($tributacaoCOFINS->AliquotaCofins);
                    $this->setVBC($item->prod()->vProd() - $item->prod()->vDesc());
                    $this->setVCOFINS(ceil($this->vBC() * $this->pCOFINS()) / 100);
                } else {
                    $this->setCST($tributacaoCOFINS->CST);
                    $this->setQBCProd($item->prod()->qTrib());
                    $this->setVAliqProd($tributacaoCOFINS->ValorCOFINS);
                    $this->setvCOFINS($this->qBCProd() * $this->vAliqProd());
                }
        }
    }
    
    
    /**
     * @param \MotorFiscal\DocumentoFiscal $documento
     * @param \MotorFiscal\ItemFiscal      $item
     *
     * @return mixed
     */
    private function getTribCOFINS(DocumentoFiscal $documento, ItemFiscal $item)
    {
        $callback = $documento->buscaTribFunctionCOFINS();
        if ($documento->tipoParametroPesquisa() !== DocumentoFiscal::IDENTIFICADOR) {
            $tributacaoCOFINS = $callback($item->prod()->identificador(), $item->Operacao()->identificador(),
                $documento->emit()->identificador(), $this->dest->identificador());
        } else {
            $tributacaoCOFINS = $callback($item->prod(), $item->Operacao(), $documento->emit(), $documento->dest());
        }
        
        return $tributacaoCOFINS;
    }
    
}
