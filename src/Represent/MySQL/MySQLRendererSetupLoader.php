<?php

namespace Subapp\Sql\Represent\MySQL;

use Subapp\Sql\Represent\MySQL\Sqlizer;
use Subapp\Sql\Represent\RendererInterface;
use Subapp\Sql\Represent\RendererSetupLoaderInterface;

/**
 * Class MySQLRendererSetupLoader
 * @package Subapp\Sql\Represent\MySQL
 */
class MySQLRendererSetupLoader implements RendererSetupLoaderInterface
{
    
    /**
     * @param RendererInterface $renderer
     */
    public function setup(RendererInterface $renderer)
    {
        $renderer->addSqlizer(new Sqlizer\Statement\Select());
        $renderer->addSqlizer(new Sqlizer\From());
    }
    
}