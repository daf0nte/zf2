<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 * @package Zend_Db
 */

namespace Zend\Db\Sql\Ddl\Constraint;

class ForeignKey extends AbstractConstraint
{
    /**
     * @var string
     */
    protected $specification = 'CONSTRAINT %1$s FOREIGN KEY (%2$s) REFERENCES %3$s (%4$s) ON DELETE %5$s ON UPDATE %6$s';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $referenceTable;

    /**
     * @var string
     */
    protected $referenceColumn;

    /**
     * @var string
     */
    protected $onDeleteRule = 'NO ACTION';

    /**
     * @var string
     */
    protected $onUpdateRule = 'NO ACTION';

    /**
     * @param array|null|string $name
     * @param string            $column
     * @param string            $referenceTable
     * @param string            $referenceColumn
     * @param string            $onDeleteRule
     * @param string            $onUpdateRule
     */
    public function __construct($name, $column, $referenceTable, $referenceColumn, $onDeleteRule = null, $onUpdateRule = null)
    {
        $this->setName($name);
        $this->setColumns($column);
        $this->setReferenceTable($referenceTable);
        $this->setReferenceColumn($referenceColumn);
        (!$onDeleteRule) ?: $this->setOnDeleteRule($onDeleteRule);
        (!$onUpdateRule) ?: $this->setOnUpdateRule($onUpdateRule);
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $referenceTable
     * @return $this
     */
    public function setReferenceTable($referenceTable)
    {
        $this->referenceTable = $referenceTable;

        return $this;
    }

    /**
     * @return string
     */
    public function getReferenceTable()
    {
        return $this->referenceTable;
    }

    /**
     * @param string $referenceColumn
     * @return $this
     */
    public function setReferenceColumn($referenceColumn)
    {
        $this->referenceColumn = $referenceColumn;

        return $this;
    }

    /**
     * @return string
     */
    public function getReferenceColumn()
    {
        return $this->referenceColumn;
    }

    /**
     * @param string $onDeleteRule
     * @return $this
     */
    public function setOnDeleteRule($onDeleteRule)
    {
        $this->onDeleteRule = $onDeleteRule;

        return $this;
    }

    /**
     * @return string
     */
    public function getOnDeleteRule()
    {
        return $this->onDeleteRule;
    }

    /**
     * @param string $onUpdateRule
     * @return $this
     */
    public function setOnUpdateRule($onUpdateRule)
    {
        $this->onUpdateRule = $onUpdateRule;

        return $this;
    }

    /**
     * @return string
     */
    public function getOnUpdateRule()
    {
        return $this->onUpdateRule;
    }

    /**
     * @return array
     */
    public function getExpressionData()
    {
        return array(array(
            $this->specification,
            array(
                $this->name,
                $this->columns[0],
                $this->referenceTable,
                $this->referenceColumn,
                $this->onDeleteRule,
                $this->onUpdateRule
            ),
            array(
                self::TYPE_IDENTIFIER,
                self::TYPE_IDENTIFIER,
                self::TYPE_IDENTIFIER,
                self::TYPE_IDENTIFIER,
                self::TYPE_LITERAL,
                self::TYPE_LITERAL,
            )

        ));
    }

}
