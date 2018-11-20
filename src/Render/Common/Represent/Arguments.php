<?php

namespace Subapp\Sql\Render\Common\Represent;

use Subapp\Sql\Ast\Arguments as ArgumentsExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Arguments
 * @package Subapp\Sql\Render\Common\Represent
 */
class Arguments extends Collection
{
    
    /**
     * @param ExpressionInterface|ArgumentsExpression $expression
     * @param RendererInterface                       $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        // ', ' - comma-separated
        $expression->setSeparator("\x2c\x20");
        
        return parent::getSql($expression, $renderer);
    }
    
}