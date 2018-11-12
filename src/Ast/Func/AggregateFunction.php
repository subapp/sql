<?php

namespace Subapp\Sql\Ast\Func;

/**
 * Class AbstractAggregateFunction
 * @package Subapp\Sql\Ast\Func
 */
class AggregateFunction extends AbstractFunction
{

    /**
     * @var boolean
     */
    private $distinct = false;

    /**
     * AggregateFunction constructor.
     * @param bool $distinct
     */
    public function __construct($distinct = false)
    {
        parent::__construct();

        $this->distinct = $distinct;
    }

    /**
     * @return bool
     */
    public function isDistinct()
    {
        return $this->distinct;
    }

    /**
     * @param bool $distinct
     */
    public function setDistinct($distinct)
    {
        $this->distinct = $distinct;
    }

    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'func.aggregate_function';
    }

}