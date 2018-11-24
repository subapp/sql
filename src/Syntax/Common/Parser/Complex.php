<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Complex
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Complex extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return NodeInterface
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $parser = null;
        
        switch (true) {
            
            // (t0.id + 10 / 2) * PI()
            case $this->isMathExpression($lexer):
                $parser = $this->getArithmeticParser($processor);
                break;
            
            // (select id from table0)
            case $this->isSubSelect($lexer):
                $parser = $this->getSubSelectParser($processor);
                break;
            
            // Embrace, Function, Primary
            default:
                $parser = $this->getExpressionParser($processor);
        }
        
        return $parser->parse($lexer, $processor);
    }
    
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return self::PARSER_COMPLEX;
    }
    
}