<?php

namespace Subapp\Sql\Render\MySQL;

use Subapp\Sql\Render\Common\DefaultRendererSetup;
use Subapp\Sql\Render\Common\Sqlizer;
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
        $renderer->addSqlizer(new Sqlizer\Select());
    }
    
}