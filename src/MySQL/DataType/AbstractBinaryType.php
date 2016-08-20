<?php
/**
 * Created by PhpStorm.
 * User: courtney
 * Date: 26/06/16
 * Time: 5:05 PM
 */

namespace MilesAsylum\SchnoopSchema\MySQL\DataType;

use MilesAsylum\SchnoopSchema\MySQL\DataType\Option\QuoteTrait;

abstract class AbstractBinaryType implements BinaryTypeInterface
{
    use QuoteTrait;

    /**
     * @var int
     */
    private $length;

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    public function hasLength()
    {
        return !empty($this->length);
    }

    /**
     * @param int $length
     */
    public function setLength($length)
    {
        $this->length = (int)$length;
    }

    public function doesAllowDefault()
    {
        return true;
    }

    public function cast($value)
    {
        return (string)$value;
    }

    public function __toString()
    {
        return strtoupper($this->getType())
        . ($this->length > 0 ? '(' . $this->length . ')' : null);
    }
}
