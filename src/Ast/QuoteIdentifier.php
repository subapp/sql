<?php

namespace Subapp\Sql\Ast;

/**
 * Class QuoteIdentifier
 * @package Subapp\Sql\Ast
 */
class QuoteIdentifier extends Identifier
{
    
    /**
     * @return string
     */
    public function getRendererName()
    {
        return 'sqlizer.quote_identifier';
    }
    
}