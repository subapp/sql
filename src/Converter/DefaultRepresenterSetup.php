<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Converter\Common;
use Subapp\Sql\Converter\RepresenterInterface;
use Subapp\Sql\Converter\RepresenterSetupInterface;

/**
 * Class DefaultRendererSetup
 * @package Subapp\Sql\Converter\Common
 */
class DefaultRepresenterSetup implements RepresenterSetupInterface
{
    
    /**
     * @param RepresenterInterface $renderer
     */
    public function setup(RepresenterInterface $renderer)
    {
        $renderer->append(new Common\Literal());
        $renderer->append(new Common\Parameter());
        $renderer->append(new Common\Arguments());
        $renderer->append(new Common\FieldPath());
        $renderer->append(new Common\Variable());
        $renderer->append(new Common\Identifier());
        $renderer->append(new Common\Raw());
        $renderer->append(new Common\QuoteIdentifier());
        $renderer->append(new Common\Embrace());
        $renderer->append(new Common\MathOperator());
        $renderer->append(new Common\Arithmetic());
        $renderer->append(new Common\Collection());
        
        $renderer->append(new Common\Func\DefaultFunction());
        $renderer->append(new Common\Func\AggregateFunction());
        
        $renderer->append(new Common\Condition\CmpOperator());
        $renderer->append(new Common\Condition\LogicOperator());
        $renderer->append(new Common\Condition\Cmp());
        $renderer->append(new Common\Condition\IsNull());
        $renderer->append(new Common\Condition\Between());
        $renderer->append(new Common\Condition\In());
        $renderer->append(new Common\Condition\Like());
        
        $renderer->append(new Common\Condition\Conditions());
    
        $renderer->append(new Common\Stmt\Select());
        $renderer->append(new Common\Stmt\From());
        $renderer->append(new Common\Stmt\Join());
        $renderer->append(new Common\Stmt\JoinItems());
        $renderer->append(new Common\Stmt\Where());
        $renderer->append(new Common\Stmt\Having());
        $renderer->append(new Common\Stmt\GroupBy());
        $renderer->append(new Common\Stmt\OrderBy());
        $renderer->append(new Common\Stmt\OrderByItems());
        $renderer->append(new Common\Stmt\Limit());
    }
    
}