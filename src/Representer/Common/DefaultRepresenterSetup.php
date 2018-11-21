<?php

namespace Subapp\Sql\Representer\Common;

use Subapp\Sql\Representer\Common\Converter;
use Subapp\Sql\Representer\RepresenterInterface;
use Subapp\Sql\Representer\RepresenterSetupInterface;

/**
 * Class DefaultRendererSetup
 * @package Subapp\Sql\Representer\Common
 */
class DefaultRepresenterSetup implements RepresenterSetupInterface
{
    
    /**
     * @param RepresenterInterface $renderer
     */
    public function setup(RepresenterInterface $renderer)
    {
        $renderer->append(new Converter\Literal());
        $renderer->append(new Converter\Parameter());
        $renderer->append(new Converter\Arguments());
        $renderer->append(new Converter\FieldPath());
        $renderer->append(new Converter\Variable());
        $renderer->append(new Converter\Identifier());
        $renderer->append(new Converter\Raw());
        $renderer->append(new Converter\QuoteIdentifier());
        $renderer->append(new Converter\Embrace());
        $renderer->append(new Converter\MathOperator());
        $renderer->append(new Converter\Arithmetic());
        $renderer->append(new Converter\Collection());
        
        $renderer->append(new Converter\Func\DefaultFunction());
        $renderer->append(new Converter\Func\AggregateFunction());
        
        $renderer->append(new Converter\Condition\CmpOperator());
        $renderer->append(new Converter\Condition\LogicOperator());
        $renderer->append(new Converter\Condition\Cmp());
        $renderer->append(new Converter\Condition\IsNull());
        $renderer->append(new Converter\Condition\Between());
        $renderer->append(new Converter\Condition\In());
        $renderer->append(new Converter\Condition\Like());
        
        $renderer->append(new Converter\Condition\Conditions());
    
        $renderer->append(new Converter\Stmt\Select());
        $renderer->append(new Converter\Stmt\From());
        $renderer->append(new Converter\Stmt\Join());
        $renderer->append(new Converter\Stmt\JoinItems());
        $renderer->append(new Converter\Stmt\Where());
        $renderer->append(new Converter\Stmt\Having());
        $renderer->append(new Converter\Stmt\GroupBy());
        $renderer->append(new Converter\Stmt\OrderBy());
        $renderer->append(new Converter\Stmt\OrderByItems());
        $renderer->append(new Converter\Stmt\Limit());
    }
    
}