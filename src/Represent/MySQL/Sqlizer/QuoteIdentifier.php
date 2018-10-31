<?php

namespace Subapp\Sql\Represent\MySQL\Sqlizer;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Represent\RendererInterface;

/**
 * Class QuoteIdentifier
 * @package Subapp\Sql\Represent\MySQL\Sqlizer
 */
class QuoteIdentifier extends Identifier
{
    
    /**
     * @param ExpressionInterface $expression
     * @param RendererInterface   $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf('`%s`', parent::getSql($expression, $renderer));
    }
    
}