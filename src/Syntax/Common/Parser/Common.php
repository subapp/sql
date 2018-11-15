<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Common
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Common extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $parser = $this->getComplexParser($processor);
        
        if ($this->isComparisonExpression($lexer)) {
            $parser = $this->getConditionalParser($processor);
        }
        
        return $parser->parse($lexer, $processor);
    }
    
}