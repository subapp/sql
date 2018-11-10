<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Stmt\OrderBy as OrderByItem;
use Subapp\Sql\Ast\Stmt\OrderByCollection;
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
     * @return ExpressionInterface|OrderByCollection
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $parser = $this->getExpressionParser($processor);
        $collection = new OrderByCollection();
        
        $this->shift(Lexer::T_ORDER, $lexer);
        $this->shift(Lexer::T_BY, $lexer);
        
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
        } while($lexer->isNext(Lexer::T_COMMA) && $lexer->next());
        
        return $collection;
    }
    
}