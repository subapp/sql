<?php

namespace Subapp\Sql\Ast;

/**
 * Class AbstractFunction
 * @package Subapp\Sql\Ast
 */
abstract class AbstractFunction extends AbstractExpression
{
    
    /**
     * @var Identifier
     */
    private $functionName;
    
    /**
     * @var Variables
     */
    private $variables;
    
    /**
     * AbstractFunction constructor.
     */
    public function __construct()
    {
        $this->variables = new Variables();
    }
    
    /**
     * @return Identifier
     */
    public function getFunctionName()
    {
        return $this->functionName;
    }
    
    /**
     * @param Identifier $name
     */
    public function setFunctionName(Identifier $name)
    {
        $this->functionName = $name;
    }
    
    /**
     * @return Variables
     */
    public function getVariables()
    {
        return $this->variables;
    }
    
    /**
     * @param Variables $variables
     */
    public function setVariables(Variables $variables)
    {
        $this->variables = $variables;
    }
    
    /**
     * @param $index
     * @return ExpressionInterface|null
     */
    public function get($index)
    {
        return $this->variables->get($index);
    }
    
    /**
     * @param ExpressionInterface $expression
     */
    public function append(ExpressionInterface $expression)
    {
        $this->variables->append($expression);
    }
    
    /**
     * @return void
     */
    public function clear()
    {
        $this->variables->clear();
    }
    
}