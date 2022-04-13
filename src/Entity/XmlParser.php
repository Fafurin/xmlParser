<?php

namespace App\Entity;

class XmlParser
{
    private $xmlFilename;

    public function getXmlFilename(){
        return $this->xmlFilename;
    }

    public function setXmlFilename($xmlFilename){
        $this->xmlFilename = $xmlFilename;

        return $this;
    }
}
