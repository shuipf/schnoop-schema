<?php

namespace MilesAsylum\SchnoopSchema\MySQL\SetVar;

use MilesAsylum\SchnoopSchema\MySQL\MySQLInterface;

class SqlMode implements MySQLInterface
{
    protected $mode;

    /**
     * SqlMode constructor.
     * @param string $mode SQL Mode
     */
    public function __construct($mode)
    {
        $this->mode = $mode;
    }

    /**
     * Get the SQL mode.
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Set the SQL mode.
     * @param mixed $mode
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    /**
     * Get the DDL statements for setting the SQL mode whilst preserving the original SQL mode.
     * @param string $delimiter The delimiter to use between statements.
     * @return string
     */
    public function getAssignStmt($delimiter = self::DEFAULT_DELIMITER)
    {
        return <<<SQL
SET @_schnoop_sql_mode = @@session.sql_mode{$delimiter}
SET @@session.sql_mode = '{$this->mode}'{$delimiter}
SQL;
    }

    /**
     * Get the DDL statements for restoring the previously changed SQL mode.
     * @param string $delimiter The delimiter to use between statements.
     * @return string
     */
    public function getRestoreStmt($delimiter = self::DEFAULT_DELIMITER)
    {
        return <<<SQL
SET @@session.sql_mode = @_schnoop_sql_mode{$delimiter}
SET @_schnoop_sql_mode = NULL{$delimiter}
SQL;
    }
}
