<?php

namespace Subapp\Sql\Represent\MySQL\Sqlizer;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Literal as LiteralExpression;
use Subapp\Sql\Represent\AbstractSqlizer;
use Subapp\Sql\Represent\RendererInterface;

/**
 * Class Literal
 * @package Subapp\Sql\Represent\MySQL\Sqlizer
 */
class Literal extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|LiteralExpression $expression
     * @param RendererInterface                     $renderer
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        $sql = null;

        switch (true) {
            case $expression->getType() === LiteralExpression::STRING:
                $sql = sprintf("'%s'", $expression->getValue()); break;
            case $expression->getType() === LiteralExpression::INT:
            case $expression->getType() === LiteralExpression::FLOAT:
                $sql = $expression->getValue(); break;
            case $expression->getType() === LiteralExpression::BOOLEAN:
                $sql = $expression->getValue() ? 'TRUE' : 'FALSE'; break;
            case $expression->getType() === LiteralExpression::NULL:
                $sql = 'NULL'; break;
            default:
                throw new \InvalidArgumentException('Unable to render literal expression (%s) because it has unsupported type (%s)',
                    $expression->getValue(), $expression->getValue());
        }

        return $sql;
    }

}