<?php
/**
 * Created by PhpStorm.
 * User: courtney
 * Date: 23/06/16
 * Time: 7:33 AM
 */

namespace MilesAsylum\SchnoopSchema\MySQL\DataType;

class MediumBlobType extends AbstractBlobType
{
    const LENGTH = 16777215;

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return self::TYPE_MEDIUMBLOB;
    }
}
