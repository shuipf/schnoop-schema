<?php

namespace MilesAsylum\SchnoopSchema\MySQL\Constraint;

class SpatialIndex extends AbstractIndex
{
    public function __construct($name)
    {
        parent::__construct($name, self::CONSTRAINT_SPATIAL, self::INDEX_TYPE_RTREE);
    }

    public function getConstraintType()
    {
        return self::CONSTRAINT_SPATIAL;
    }

    public function __toString()
    {
        return $this->makeIndexDDL($this->getConstraintType() . ' INDEX', $this->getName());
    }
}
