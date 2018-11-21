<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Join;
use Subapp\Sql\Ast\Stmt\JoinItems as JoinItemsExpression;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class JoinCollection
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class JoinItems extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return NodeInterface|JoinItemsExpression|Join[]
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $joins = new JoinItemsExpression();
        $parser = $this->getJoinParser($processor);
        
        while ($this->isJoin($lexer)) {
            $joins->append($parser->parse($lexer, $processor));
        }
        
        return $joins;
    }
    
}