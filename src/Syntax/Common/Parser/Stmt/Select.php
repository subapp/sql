<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ParserInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Select
 * @package Subapp\Sql\Syntax\MySQL\Parser\Stmt
 */
class Select extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return \Subapp\Sql\Ast\NodeInterface|Ast\Stmt\Select
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        // If lexer was executed like lexer->tokenize(sql, FALSE) - (without unshifting within blank token)
        // that means next token is NOT SELECT
        $this->shiftIf(Lexer::T_SELECT, $lexer);
        
        $root = new Ast\Root();
        
        $root->setArguments($this->getVariablesParser($processor)->parse($lexer, $processor));
        $root->setFrom($this->parseFromExpression($processor));
        
        if ($this->isJoin($lexer)) {
            $parser = $this->getJoinItemsParser($processor);
            $root->setJoins($parser->parse($lexer, $processor));
        }
        
        if ($this->isWhere($lexer)) {
            $root->setWhere($this->getWhereParser($processor)->parse($lexer, $processor));
        }
        
        if ($this->isGroupBy($lexer)) {
            $root->setGroupBy($this->getGroupByParser($processor)->parse($lexer, $processor));
        }
        
        if ($this->isOrderBy($lexer)) {
            $root->setOrderBy($this->getOrderByParser($processor)->parse($lexer, $processor));
        }
        
        if ($this->isLimit($lexer)) {
            $root->setLimit($this->getLimitParser($processor)->parse($lexer, $processor));
        }
        
        $root->setSemicolon($lexer->toToken(Lexer::T_SEMICOLON));
        
        $select = new Ast\Stmt\Select();
        
        $select->setRoot($root);
        
        return $select;
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return Ast\NodeInterface|Ast\Stmt\From
     */
    public function parseFromExpression(ProcessorInterface $processor)
    {
        return $processor->getParser(ParserInterface::PARSER_STMT_FROM)->parse($processor->getLexer(), $processor);
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::PARSER_STMT_SELECT;
    }
    
}