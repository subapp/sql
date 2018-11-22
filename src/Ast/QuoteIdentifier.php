<?php

namespace Subapp\Sql\Ast;

use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class QuoteIdentifier
 * @package Subapp\Sql\Ast
 */
class QuoteIdentifier extends Identifier
{

    const DEFAULT_QUOTE = '`';

    /**
     * @var string
     */
    private $quote = self::DEFAULT_QUOTE;

    /**
     * @return string
     */
    public function getQuote()
    {
        return $this->quote;
    }

    /**
     * @param string $quote
     */
    public function setQuote($quote)
    {
        $this->quote = $quote;
    }

    /**
     * @return string
     */
    public function getRenderer()
    {
        return ConverterInterface::CONVERTER_QUOTE_IDENTIFIER;
    }
    
}