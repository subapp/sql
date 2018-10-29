<?php

namespace Subapp\Sql\Represent\MySQL;

use Subapp\Sql\Represent\MySQL\Sqlizer;
use Subapp\Sql\Represent\RendererInterface;
use Subapp\Sql\Represent\RendererSetupInterface;

/**
 * Class MySQLRendererSetupLoader
 * @package Subapp\Sql\Represent\MySQL
 */
class MySQLRendererSetup implements RendererSetupInterface
{
    
    /**
     * @param RendererInterface $renderer
     */
    public function setup(RendererInterface $renderer)
    {
        $renderer->addSqlizer(new Sqlizer\Statement\Select());
        $renderer->addSqlizer(new Sqlizer\From());
        
        // common SQLizers
        $renderer->addSqlizer(new Sqlizer\Literal());
        $renderer->addSqlizer(new Sqlizer\Variables());
        $renderer->addSqlizer(new Sqlizer\FieldPath());
        $renderer->addSqlizer(new Sqlizer\OrdinaryFunction());
        $renderer->addSqlizer(new Sqlizer\Identifier());
        $renderer->addSqlizer(new Sqlizer\Operand());
        $renderer->addSqlizer(new Sqlizer\Arithmetic());
    }
    
}