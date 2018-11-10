<?php

namespace Subapp\Sql\Render\Common\Sqlizer;

use Subapp\Sql\Ast\VariableDeclaration as VariableDeclarationExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Alias
 * @package Subapp\Sql\Render\Common\Sqlizer
 */
class VariableDeclaration extends AbstractSqlizer
{

    /**
     * @param ExpressionInterface|VariableDeclarationExpression $expression
     * @param RendererInterface                                 $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf('%s%s',
            $renderer->render($expression->getExpression()),
            ($expression->getAlias() ? sprintf(' AS %s', $renderer->render($expression->getAlias())) : null)
        );
    }

}