<?php

namespace Subapp\Sql\Render\MySQL;

use Subapp\Sql\Render\Common\DefaultRendererSetup;
use Subapp\Sql\Render\MySQL\Sqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class MySQLRendererSetup
 * @package Subapp\Sql\Render\MySQL
 */
class MySQLRendererSetup extends DefaultRendererSetup
{
    
    /**
     * @param RendererInterface $renderer
     */
    public function setup(RendererInterface $renderer)
    {
        parent::setup($renderer);
        
        $renderer->addSqlizer(new Sqlizer\SelectStatement());
        $renderer->addSqlizer(new Sqlizer\From());
    }
    
}