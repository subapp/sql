<?php

namespace Subapp\Sql\Ast\Func;

use Subapp\Sql\Ast\AbstractNode;
use Subapp\Sql\Ast\Arguments;
use Subapp\Sql\Ast\Identifier;
use Subapp\Sql\Ast\NodeInterface;

/**
 * Class AbstractFunction
 * @package Subapp\Sql\Ast
 */
abstract class AbstractFunction extends AbstractNode
{
    
    /**
     * @var Identifier
     */
    private $functionName;
    
    /**
     * @var Arguments
     */
    private $arguments;
    
    /**
     * AbstractFunction constructor.
     */
    public function __construct()
    {
        $this->arguments = new Arguments();
    }
    
    /**
     * @return Identifier
     */
    public function getFunctionName()
    {
        return $this->functionName;
    }
    
    /**
     * @param Identifier|NodeInterface $name
     */
    public function setFunctionName(Identifier $name)
    {
        $this->functionName = $name;
    }
    
    /**
     * @return Arguments
     */
    public function getArguments()
    {
        return $this->arguments;
    }
    
    /**
     * @param Arguments|NodeInterface $arguments
     */
    public function setArguments(Arguments $arguments)
    {
        $this->arguments = $arguments;
    }
    
    /**
     * @param $index
     * @return NodeInterface|null
     */
    public function get($index)
    {
        return $this->arguments->get($index);
    }
    
    /**
     * @param NodeInterface $expression
     */
    public function append(NodeInterface $expression)
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