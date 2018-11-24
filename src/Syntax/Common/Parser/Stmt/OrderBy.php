<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\OrderBy as OrderByItem;
use Subapp\Sql\Ast\Stmt\OrderByItems;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class OrderBy
 * @package Subapp\Sql\Syntax\Common\Parser\Stmt
 */
class OrderBy extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return NodeInterface|OrderByItems
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $parser = $this->getExpressionParser($processor);
        $collection = new OrderByItems();
        
        $this->shiftIf(Lexer::T_ORDER, $lexer);
        $this->shiftIf(Lexer::T_BY, $lexer);
        
        do {
            $orderBy = new OrderByItem($parser->parse($lexer, $processor));
            
            switch (true) {
                case $lexer->toToken(Lexer::T_ASC):
                    $orderBy->setDirection(OrderByItem::ASC);
                    break;
                case $lexer->toToken(Lexer::T_DESC):
                    $orderBy->setDirection(OrderByItem::DESC);
                    break;
            }
            
            $collection->append($orderBy);
        } while ($lexer->isNext(Lexer::T_COMMA) && $lexer->next());
        
        return $collection;
    }
    
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return self::PARSER_STMT_ORDER_BY;
    }
    
}