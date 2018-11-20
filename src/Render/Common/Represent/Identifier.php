<?php

namespace Subapp\Sql\Render\Common\Represent;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Identifier as IdentifierExpression;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Identifier
 * @package Subapp\Sql\Render\Common\Represent
 */
class Identifier extends AbstractRepresent
{
    
    /**
     * @param ExpressionInterface|IdentifierExpression $expression
     * @param RendererInterface                        $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return (string)$expression->getIdentifier();
    }
    
}