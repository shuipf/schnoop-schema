<?php

namespace MilesAsylum\SchnoopSchema\PHPUnit\Framework;

use MilesAsylum\SchnoopSchema\MySQL\DataType\DataTypeInterface;
use MilesAsylum\SchnoopSchema\MySQL\Routine\RoutineParameterInterface;
use PHPUnit\Framework\TestCase;

abstract class RoutineParameterTestCase extends TestCase
{
    /**
     * @return RoutineParameterInterface
     */
    abstract protected function getRoutineParameter();

    abstract protected function getExpectedParameterName();

    /**
     * @return DataTypeInterface
     */
    abstract protected function getExpectedParameterDataType();

    public function testInitialProperties()
    {
        $this->assertSame($this->getExpectedParameterName(), $this->getRoutineParameter()->getName());
        $this->assertSame($this->getExpectedParameterDataType(), $this->getRoutineParameter()->getDataType());
    }

    public function testSetName()
    {
        $newName = 'neo_name';
        $this->getRoutineParameter()->setName($newName);

        $this->assertSame($newName, $this->getRoutineParameter()->getName());
    }

    public function testSetDataType()
    {
        $newMockDataType = $this->createMock(DataTypeInterface::class);
        $this->getRoutineParameter()->setDataType($newMockDataType);

        $this->assertSame($newMockDataType, $this->getRoutineParameter()->getDataType());
    }
}
