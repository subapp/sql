<?php

namespace Subapp\Sql\Ast;

/**
 * Class Variable
 * @package Subapp\Sql\Ast
 */
class Variable extends AbstractNode
{

    /**
     * @var NodeInterface
     */
    private $alias;

    /**
     * @var NodeInterface
     */
    private $expression;

    /**
     * Alias constructor.
     *
     * @param NodeInterface $expression
     * @param NodeInterface $alias
     */
    public function __construct(NodeInterface $expression = null, NodeInterface $alias = null)
    {
        $this->expression = $expression;
        $this->alias = $alias;
    }

    /**
     * @return NodeInterface
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param NodeInterface $alias
     */
    public function setAlias(NodeInterface $alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return NodeInterface
     */
    public function getExpression()
    {
        return $this->expression;
    }

    /**
     * @param NodeInterface $expression
     */
    public function setExpression(NodeInterface $expression)
    {
        $this->expression = $expression;
    }

    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'converter.variable';
    }

}