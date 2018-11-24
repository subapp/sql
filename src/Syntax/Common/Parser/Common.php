<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\NodeInterface;
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
     * @return NodeInterface
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
    
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return self::PARSER_COMMON;
    }
    
}