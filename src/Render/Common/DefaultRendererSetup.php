<?php

namespace Subapp\Sql\Render\Common;

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
        $renderer->addSqlizer(new Sqlizer\Variables());
        $renderer->addSqlizer(new Sqlizer\FieldPath());
        $renderer->addSqlizer(new Sqlizer\Alias());
        $renderer->addSqlizer(new Sqlizer\Identifier());
        $renderer->addSqlizer(new Sqlizer\QuoteIdentifier());
        $renderer->addSqlizer(new Sqlizer\Embrace());
        $renderer->addSqlizer(new Sqlizer\MathOperator());
        $renderer->addSqlizer(new Sqlizer\Arithmetic());
        $renderer->addSqlizer(new Sqlizer\Func\DefaultFunction());
        $renderer->addSqlizer(new Sqlizer\Func\AggregateFunction());
    }
    
}