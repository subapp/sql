<?php

namespace Subapp\Sql\Render\Common;

use Subapp\Sql\Render\Common\Represent;
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
        $renderer->addSqlizer(new Represent\Literal());
        $renderer->addSqlizer(new Represent\Parameter());
        $renderer->addSqlizer(new Represent\Arguments());
        $renderer->addSqlizer(new Represent\FieldPath());
        $renderer->addSqlizer(new Represent\Variable());
        $renderer->addSqlizer(new Represent\Identifier());
        $renderer->addSqlizer(new Represent\Raw());
        $renderer->addSqlizer(new Represent\QuoteIdentifier());
        $renderer->addSqlizer(new Represent\Embrace());
        $renderer->addSqlizer(new Represent\MathOperator());
        $renderer->addSqlizer(new Represent\Arithmetic());
        $renderer->addSqlizer(new Represent\Collection());
        
        $renderer->addSqlizer(new Represent\Func\DefaultFunction());
        $renderer->addSqlizer(new Represent\Func\AggregateFunction());
        
        $renderer->addSqlizer(new Represent\Condition\CmpOperator());
        $renderer->addSqlizer(new Represent\Condition\LogicOperator());
        $renderer->addSqlizer(new Represent\Condition\Cmp());
        $renderer->addSqlizer(new Represent\Condition\IsNull());
        $renderer->addSqlizer(new Represent\Condition\Between());
        $renderer->addSqlizer(new Represent\Condition\In());
        $renderer->addSqlizer(new Represent\Condition\Like());
        
        $renderer->addSqlizer(new Represent\Condition\Conditions());
    
        $renderer->addSqlizer(new Represent\Stmt\Select());
        $renderer->addSqlizer(new Represent\Stmt\From());
        $renderer->addSqlizer(new Represent\Stmt\Join());
        $renderer->addSqlizer(new Represent\Stmt\JoinItems());
        $renderer->addSqlizer(new Represent\Stmt\Where());
        $renderer->addSqlizer(new Represent\Stmt\Having());
        $renderer->addSqlizer(new Represent\Stmt\GroupBy());
        $renderer->addSqlizer(new Represent\Stmt\OrderBy());
        $renderer->addSqlizer(new Represent\Stmt\OrderByItems());
        $renderer->addSqlizer(new Represent\Stmt\Limit());
    }
    
}