<?php

namespace Subapp\Sql\Ast;

/**
 * Class Embrace
 * @package Subapp\Sql\Ast
 */
class Embrace extends AbstractExpression
{

    /**
     * @var ExpressionInterface
     */
    private $inner;

    /**
     * Embrace constructor.
     * @param ExpressionInterface $inner
     */
    public function __construct(ExpressionInterface $inner = null)
    {
        $this->inner = $inner;
    }

    /**
     * @return ExpressionInterface
     */
    public function getInner()
    {
        return $this->inner;
    }

    /**
     * @param ExpressionInterface $inner
     */
    public function setInner(ExpressionInterface $inner)
    {
        $this->inner = $inner;
    }

    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'represent.embrace';
    }

}