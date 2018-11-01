<?php

namespace Subapp\Sql\Represent\MySQL\Sqlizer;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Identifier as IdentifierExpression;
use Subapp\Sql\Represent\RendererInterface;

/**
 * Class QuoteIdentifier
 * @package Subapp\Sql\Represent\MySQL\Sqlizer
 */
class QuoteIdentifier extends Identifier
{
    
    /**
     * @param ExpressionInterface|IdentifierExpression $expression
     * @param RendererInterface   $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf('`%s`', parent::getSql($expression->getIdentifier(), $renderer));
    }
    
}