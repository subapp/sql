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
    public function getRenderer()
    {
        return 'represent.quote_identifier';
    }
    
}