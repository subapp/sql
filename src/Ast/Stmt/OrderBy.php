<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\AbstractExpression;
use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Class OrderBy
 * @package Subapp\Sql\Ast
 */
class OrderBy extends AbstractExpression
{
    
    const ASC   = 'ASC';
    const DESC  = 'DESC';
    
    /**
     * @var string
     */
    private $direction;
    
    /**
     * @var ExpressionInterface
     */
    private $expression;
    
    /**
     * OrderBy constructor.
     *
     * @param ExpressionInterface $expression
     * @param string              $direction
     */
    public function __construct(ExpressionInterface $expression, $direction = OrderBy::ASC)
    {
        $this->expression = $expression;
        $this->direction = $direction;
    }
    
    /**
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }
    
    /**
     * @param string $direction
     */
    public function setDirection(string $direction)
    {
        $this->direction = $direction;
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
    public function getSqlizerName()
    {
        return 'stmt.order_by';
    }
    
}