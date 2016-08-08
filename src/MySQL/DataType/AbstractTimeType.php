<?php

namespace MilesAsylum\SchnoopSchema\MySQL\DataType;

use MilesAsylum\SchnoopSchema\MySQL\DataType\Option\QuoteStringTrait;

abstract class AbstractTimeType implements TimeTypeInterface
{
    use QuoteStringTrait;

    protected $precision;

    public function __construct($precision = 0)
    {
        $this->precision = $precision;
    }

    public function getPrecision()
    {
        return $this->precision;
    }

    /**
     * @return bool
     */
    public function doesAllowDefault()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function cast($value)
    {
        return $value;
    }

    public function __toString()
    {
        return strtoupper($this->getType())
            . ($this->getPrecision() > 0 ? '(' . $this->getPrecision() . ')' : null);
    }
}