<?php

namespace Subapp\Sql\Represent\MySQL\Sqlizer\Statement;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Represent\AbstractSqlizer;
use Subapp\Sql\Represent\RendererInterface;

/**
 * Class Select
 * @package Subapp\Sql\Represent\MySQL\Sqlizer\Statement
 */
class Select extends AbstractSqlizer
{
    
    /**
     * @param RendererInterface                                    $renderer
     * @param ExpressionInterface|\Subapp\Sql\Ast\Statement\Select $expression
     * @return string
     */
    public function getSql(RendererInterface $renderer, ExpressionInterface $expression)
    {
        return sprintf('SELECT * %s', $renderer->render($expression->getFrom()));
    }
    
}