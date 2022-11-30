<?php

namespace App\Converter;

use FetchLeo\LaravelXml\Contracts\Converter;
use SimpleXMLElement;
use FetchLeo\LaravelXml\Exceptions\CantConvertValueException;

class XmlConverter  implements Converter
{
    public function convert($value, SimpleXMLElement $element) : SimpleXMLElement;

    public function canConvert($value, $type) : bool;
}
