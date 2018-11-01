<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class FromParser
 * @package Subapp\Sql\Syntax\MySQL\Parser\Common
 */
class From extends AbstractMySQLParser
{
    
    /**
     * @inheritdoc
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->shift(Lexer::T_FROM, $lexer);

        $parser = null;

        switch (true) {
            case $this->isIdentifier($lexer):
                $parser = $this->getIdentifierParser($processor);
                break;
            case $this->isQuoteIdentifier($lexer):
                $parser = $this->getQuoteIdentifierParser($processor);
                break;
            case $this->isSubSelect($lexer):
                $parser = $this->getSubSelectParser($processor);
                break;
            default:
                $this->throwSyntaxError($lexer, 'Identifier', 'QuoteIdentifier', 'SubSelect');
        }

        $expression = $parser->parse($lexer, $processor);

        if ($this->isAlias($lexer)) {
            $expression = $this->getAliasParser($processor)->wrapExpression($processor, $expression);
        }

        return new Ast\From($expression);
    }
    
}