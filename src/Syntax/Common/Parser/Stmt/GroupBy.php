<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\GroupBy as GroupByExpression;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class OrderBy
 * @package Subapp\Sql\Syntax\Common\Parser\Stmt
 */
class GroupBy extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return NodeInterface|GroupByExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $parser = $this->getParserC($processor);
        $collection = new GroupByExpression();
        
        $this->shift(Lexer::T_GROUP, $lexer);
        $this->shift(Lexer::T_BY, $lexer);
        
        do {
            $collection->append($parser->parse($lexer, $processor));
        } while ($lexer->isNext(Lexer::T_COMMA) && $lexer->next());
        
        return $collection;
    }
    
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return self::PARSER_STMT_GROUP_BY;
    }
    
}