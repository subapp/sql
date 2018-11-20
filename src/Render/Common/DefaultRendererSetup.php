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
        $renderer->addRepresent(new Represent\Literal());
        $renderer->addRepresent(new Represent\Parameter());
        $renderer->addRepresent(new Represent\Arguments());
        $renderer->addRepresent(new Represent\FieldPath());
        $renderer->addRepresent(new Represent\Variable());
        $renderer->addRepresent(new Represent\Identifier());
        $renderer->addRepresent(new Represent\Raw());
        $renderer->addRepresent(new Represent\QuoteIdentifier());
        $renderer->addRepresent(new Represent\Embrace());
        $renderer->addRepresent(new Represent\MathOperator());
        $renderer->addRepresent(new Represent\Arithmetic());
        $renderer->addRepresent(new Represent\Collection());
        
        $renderer->addRepresent(new Represent\Func\DefaultFunction());
        $renderer->addRepresent(new Represent\Func\AggregateFunction());
        
        $renderer->addRepresent(new Represent\Condition\CmpOperator());
        $renderer->addRepresent(new Represent\Condition\LogicOperator());
        $renderer->addRepresent(new Represent\Condition\Cmp());
        $renderer->addRepresent(new Represent\Condition\IsNull());
        $renderer->addRepresent(new Represent\Condition\Between());
        $renderer->addRepresent(new Represent\Condition\In());
        $renderer->addRepresent(new Represent\Condition\Like());
        
        $renderer->addRepresent(new Represent\Condition\Conditions());
    
        $renderer->addRepresent(new Represent\Stmt\Select());
        $renderer->addRepresent(new Represent\Stmt\From());
        $renderer->addRepresent(new Represent\Stmt\Join());
        $renderer->addRepresent(new Represent\Stmt\JoinItems());
        $renderer->addRepresent(new Represent\Stmt\Where());
        $renderer->addRepresent(new Represent\Stmt\Having());
        $renderer->addRepresent(new Represent\Stmt\GroupBy());
        $renderer->addRepresent(new Represent\Stmt\OrderBy());
        $renderer->addRepresent(new Represent\Stmt\OrderByItems());
        $renderer->addRepresent(new Represent\Stmt\Limit());
    }
    
}