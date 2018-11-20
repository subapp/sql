<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Lexer\Lexer;
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
        $isConditional = $this->isComparisonExpression($lexer);
        $isCommaSeparated = $this->isExpressionWithComma($lexer);
        $isVarsLikeOrderBy = $this->isTokenBehindExpression($lexer, true, Lexer::T_ASC, Lexer::T_DESC);
        $isVarsWithAlias = $this->isExpressionWithAlias($lexer);
        
        $parser = $this->getComplexParser($processor);

        switch (true) {
            case $isConditional:
                $parser = $this->getConditionalParser($processor);
                break;
            case $isVarsLikeOrderBy:
                $parser = $this->getOrderByParser($processor);
                break;
            case $isVarsWithAlias:
            case $isCommaSeparated:
                $parser = $this->getVariablesParser($processor);
                break;
        }
        
        return $parser->parse($lexer, $processor);
    }
    
}