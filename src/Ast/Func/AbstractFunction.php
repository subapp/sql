<?php

namespace Subapp\Sql\Ast\Func;

use Subapp\Sql\Ast\AbstractExpression;
use Subapp\Sql\Ast\Variables;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Identifier;

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
    private $arguments;
    
    /**
     * AbstractFunction constructor.
     */
    public function __construct()
    {
        $this->arguments = new Variables();
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
    public function getArguments()
    {
        return $this->arguments;
    }
    
    /**
     * @param Variables $arguments
     */
    public function setArguments(Variables $arguments)
    {
        $this->arguments = $arguments;
    }
    
    /**
     * @param $index
     * @return ExpressionInterface|null
     */
    public function get($index)
    {
        return $this->arguments->get($index);
    }
    
    /**
     * @param ExpressionInterface $expression
     */
    public function append(ExpressionInterface $expression)
    {
        $this->arguments->append($expression);
    }
    
    /**
     * @return void
     */
    public function clear()
    {
        $this->arguments->clear();
    }
    
}