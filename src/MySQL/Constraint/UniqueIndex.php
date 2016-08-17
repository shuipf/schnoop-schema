<?php

namespace MilesAsylum\SchnoopSchema\MySQL\Constraint;

class UniqueIndex extends AbstractIndex
{
    public function __construct($name)
    {
        parent::__construct($name, self::CONSTRAINT_UNIQUE, self::INDEX_TYPE_BTREE);
    }

    public function setIndexType($indexType)
    {
        parent::setIndexType($indexType);
    }

    public function __toString()
    {
        if (strcasecmp('primary', $this->getName()) == 0) {
            return $this->makeIndexDDL('PRIMARY KEY', null, $this->getIndexType());
        }

        return $this->makeIndexDDL($this->getConstraintType() . ' INDEX', $this->getName());
    }
}
