<?php

namespace Subapp\Sql\Syntax;

/**
 * Interface ParserProcessorSetupLoaderInterface
 * @package Subapp\Sql\Syntax
 */
interface ParserProcessorSetupLoaderInterface
{
    
    /**
     * @param ProcessorInterface $processor
     */
    public function setup(ProcessorInterface $processor);
    
}