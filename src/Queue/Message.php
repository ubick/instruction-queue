<?php

/*
 * (c) Liviu Panainte <liviu.panainte@gmail.com>
 */

namespace Queue;

class Message {

    private $instructionType;
    private $productCode;
    private $quantity;
    private $uom;
    private $timeStamp;

    public function __construct($it, $pc, $q, $uom, $ts) {
        $this->instructionType = $it;
        $this->productCode = $pc;
        $this->quantity = $q;
        $this->uom = $uom;
        $this->timeStamp = $ts;
    }
    
    public function __toString() {
        $str = "\n\n========================\n";
        $str .= "instructionType: " . $this->instructionType . " \n";
        $str .= "productCode: " . $this->productCode . " \n";
        $str .= "quantity: " . $this->quantity . " \n";
        $str .= "UOM: " . $this->uom . " \n";
        $str .= "TimeStamp: " . $this->timeStamp . " \n";
        $str .= "========================\n\n";
        
        return $str;
    }
    
    public function getInstructionType() {
        return $this->instructionType;
    }

    public function getProductCode() {
        return $this->productCode;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getUOM() {
        return $this->uom;
    }

    public function getTimeStamp() {
        return $this->timeStamp;
    }


}
