<?php

namespace Subapp\Sql\Syntax\MySQL;

use Subapp\Sql\Syntax\Common\DefaultParserSetup;
use Subapp\Sql\Syntax\MySQL\Parser\SelectStatement;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class MySQLParserSetup
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class MySQLParserSetup extends DefaultParserSetup
{
    
    /**
     * @param ProcessorInterface $processor
     */
    public function setup(ProcessorInterface $processor)
    {
        parent::setup($processor);
        
        $processor->addParser(new SelectStatement());
    }
    
}