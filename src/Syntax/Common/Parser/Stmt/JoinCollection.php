<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Collection;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Stmt\Join;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class JoinCollection
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class JoinCollection extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|Collection|Join[]
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $joins = new Collection();
        $parser = $this->getJoinParser($processor);
        
        while ($this->isJoin($lexer)) {
            $joins->append($parser->parse($lexer, $processor));
        }
        
        return $joins;
    }
    
}