<?php

namespace MilesAsylum\SchnoopSchema\MySQL\Constraint;

interface ForeignKeyInterface extends ConstraintInterface
{
    const REFERENCE_ACTION_RESTRICT = 'RESTRICT';
    const REFERENCE_ACTION_CASCADE = 'CASCADE';
    const REFERENCE_ACTION_SET_NULL = 'SET NULL';
    const REFERENCE_ACTION_NO_ACTION = 'NO ACTION';

    /**
     * Get the reference table for the foreign key.
     * @return string Reference table name.
     */
    public function getReferenceTableName();

    /**
     * Identify if the name of the reference table has been set for the foreign key.
     * @return bool
     */
    public function hasReferenceTableName();

    /**
     * Set the name of the reference table for the foreign key.
     * @param string $tableName Reference table name.
     */
    public function setReferenceTableName($tableName);

    /**
     * Get the foreign key columns.
     * @return ForeignKeyColumnInterface[] Foreign key columns.
     */
    public function getForeignKeyColumns();

    /**
     * Identify if foreign key columns have been set.
     * @return bool
     */
    public function hasForeignKeyColumns();

    /**
     * Set the foreign key columns.
     * @param ForeignKeyColumnInterface[] $foreignKeyColumns Foreign key columns.
     */
    public function setForeignKeyColumns(array $foreignKeyColumns);

    /**
     * Add a foreign key column.
     * @param ForeignKeyColumnInterface $foreignKeyColumn Foreign key column.
     */
    public function addForeignKeyColumn(ForeignKeyColumnInterface $foreignKeyColumn);

    /**
     * Get the names of the columns for the foreign key.
     * @return array Column names.
     */
    public function getColumnNames();

    /**
     * Get reference column names for the foreign key.
     * @return array Reference column names.
     */
    public function getReferenceColumnNames();

    /**
     * Get the action to perform against the reference table when a row is deleted.
     * @return string Deletion action. One of self::REFERENCE_ACTION_* constants.
     */
    public function getOnDeleteAction();

    /**
     * Set the action against the reference table when a row is deleted.
     * @param string $onDeleteAction Deletion action. One of self::REFERENCE_ACTION_* constants.
     */
    public function setOnDeleteAction($onDeleteAction);

    /**
     * Get the action to perform against the reference table when the foreign key columns are updated.
     * @return string Update action. One of self::REFERENCE_ACTION_* constants.
     */
    public function getOnUpdateAction();

    /**
     * Set the action to perform against the reference table when the foreign key columns are updated.
     * @param string $onUpdateAction Update action. One of self::REFERENCE_ACTION_* constants.
     */
    public function setOnUpdateAction($onUpdateAction);
}
