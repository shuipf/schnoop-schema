<?php

namespace MilesAsylum\SchnoopSchema\MySQL\Routine;

use MilesAsylum\SchnoopSchema\MySQL\Exception\FQNException;

class RoutineProcedure extends AbstractRoutine implements RoutineProcedureInterface
{
    /**
     * Routine parameters.
     * @var ProcedureParameterInterface[]
     */
    protected $parameters = [];

    /**
     * {@inheritdoc}
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function hasParameters()
    {
        return !empty($this->parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function addParameter(ProcedureParameterInterface $parameter)
    {
        $this->parameters[] = $parameter;
    }

    /**
     * {@inheritdoc}
     */
    public function getDDL()
    {
        $dropDDL = $setSqlMode = $createDDL = $revertSqlMode = '';

        $procedureName = $this->makeRoutineName();

        if ($this->dropPolicy) {
            switch ($this->dropPolicy) {
                case self::DDL_DROP_POLICY_DROP:
                    $dropDDL = <<<SQL
DROP PROCEDURE {$procedureName}{$this->delimiter}
SQL;
                    break;
                case self::DDL_DROP_POLICY_DROP_IF_EXISTS:
                    $dropDDL = <<<SQL
DROP PROCEDURE IF EXISTS {$procedureName}{$this->delimiter}
SQL;
                    break;
            }
        }

        if ($this->hasSqlMode()) {
            $prevDelimiter = $this->sqlMode->getDelimiter();
            $this->sqlMode->setDelimiter($this->delimiter);

            $setSqlMode = $this->sqlMode->getSetStatements();
            $revertSqlMode = $this->sqlMode->getRestoreStatements();

            $this->sqlMode->setDelimiter($prevDelimiter);
        }

        $procedureSignature = "PROCEDURE {$procedureName} ({$this->makeParametersDDL()})";

        $createDDL = 'CREATE '
            . implode(
                "\n",
                array_filter(
                    [
                        (!empty($this->definer)) ? 'DEFINER = ' . $this->definer : null,
                        $procedureSignature,
                        $this->makeCharacteristicsDDL(),
                        'BEGIN',
                        $this->body,
                        'END' . $this->delimiter
                    ]
                )
            );

        $createDDL = implode(
            "\n",
            array_filter(
                [
                    $setSqlMode,
                    $dropDDL,
                    $createDDL,
                    $revertSqlMode
                ]
            )
        );

        return $createDDL;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getDDL();
    }

    /**
     * {@inheritdoc}
     */
    protected function makeParametersDDL()
    {
        $params = [];

        foreach ($this->parameters as $parameter) {
            $params[] = $parameter->getDDL();
        }

        return implode(',', $params);
    }
}
