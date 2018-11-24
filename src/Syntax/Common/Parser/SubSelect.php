<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Embrace;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class SubSelect
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class SubSelect extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return NodeInterface|Embrace
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $embrace = new Embrace();
        
        $this->shift(Lexer::T_OPEN_BRACE, $lexer);
        $embrace->setInner($this->getSelectStmtParser($processor)->parse($lexer, $processor));
        $this->shift(Lexer::T_CLOSE_BRACE, $lexer);
        
        return $embrace;
    }
    
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return self::PARSER_SUB_SELECT;
    }
    
}