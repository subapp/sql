<?php

namespace Subapp\Sql\Syntax;

/**
 * Interface ParserSetupInterface
 * @package Subapp\Sql\Syntax
 */
interface ParserSetupInterface
{
    
    /**
     * @param ProcessorInterface $processor
     */
    public function setup(ProcessorInterface $processor);
    
}