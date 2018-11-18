<?php

namespace Subapp\Sql\Render\Common;

use Subapp\Sql\Render\Common\Sqlizer;
use Subapp\Sql\Render\RendererInterface;
use Subapp\Sql\Render\RendererSetupInterface;

/**
 * Class DefaultRendererSetup
 * @package Subapp\Sql\Render\Common
 */
class DefaultRendererSetup implements RendererSetupInterface
{
    
    /**
     * @param RendererInterface $renderer
     */
    public function setup(RendererInterface $renderer)
    {
        $renderer->addSqlizer(new Sqlizer\Literal());
        $renderer->addSqlizer(new Sqlizer\Parameter());
        $renderer->addSqlizer(new Sqlizer\Arguments());
        $renderer->addSqlizer(new Sqlizer\FieldPath());
        $renderer->addSqlizer(new Sqlizer\Variable());
        $renderer->addSqlizer(new Sqlizer\Identifier());
        $renderer->addSqlizer(new Sqlizer\Raw());
        $renderer->addSqlizer(new Sqlizer\QuoteIdentifier());
        $renderer->addSqlizer(new Sqlizer\Embrace());
        $renderer->addSqlizer(new Sqlizer\MathOperator());
        $renderer->addSqlizer(new Sqlizer\Arithmetic());
        $renderer->addSqlizer(new Sqlizer\Collection());
        
        $renderer->addSqlizer(new Sqlizer\Func\DefaultFunction());
        $renderer->addSqlizer(new Sqlizer\Func\AggregateFunction());
        
        $renderer->addSqlizer(new Sqlizer\Condition\CmpOperator());
        $renderer->addSqlizer(new Sqlizer\Condition\LogicOperator());
        $renderer->addSqlizer(new Sqlizer\Condition\Cmp());
        $renderer->addSqlizer(new Sqlizer\Condition\IsNull());
        $renderer->addSqlizer(new Sqlizer\Condition\Between());
        $renderer->addSqlizer(new Sqlizer\Condition\In());
        $renderer->addSqlizer(new Sqlizer\Condition\Like());
        
        $renderer->addSqlizer(new Sqlizer\Condition\Conditions());
    
        $renderer->addSqlizer(new Sqlizer\Stmt\Select());
        $renderer->addSqlizer(new Sqlizer\Stmt\From());
        $renderer->addSqlizer(new Sqlizer\Stmt\Join());
        $renderer->addSqlizer(new Sqlizer\Stmt\JoinItems());
        $renderer->addSqlizer(new Sqlizer\Stmt\Where());
        $renderer->addSqlizer(new Sqlizer\Stmt\Having());
        $renderer->addSqlizer(new Sqlizer\Stmt\GroupBy());
        $renderer->addSqlizer(new Sqlizer\Stmt\OrderBy());
        $renderer->addSqlizer(new Sqlizer\Stmt\OrderByItems());
        $renderer->addSqlizer(new Sqlizer\Stmt\Limit());
    }
    
}