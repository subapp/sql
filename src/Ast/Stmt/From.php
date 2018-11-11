<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\AbstractExpression;
use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Class From
 * @package Subapp\Sql\Ast
 */
class From extends AbstractExpression
{
    
    /**
     * @var ExpressionInterface
     */
    private $expression;
    
    /**
     * From constructor.
     * @param ExpressionInterface|null $expression
     */
    public function __construct(ExpressionInterface $expression = null)
    {
        $this->expression = $expression;
    }
    
    /**
     * @return ExpressionInterface
     */
    public function getExpression()
    {
        return $this->expression;
    }
    
    /**
     * @param ExpressionInterface $expression
     */
    public function setExpression(ExpressionInterface $expression)
    {
        $this->expression = $expression;
    }
    
    /**
     * @return string
     */
    public function getRendererName()
    {
        return 'stmt.from';
    }
    
}