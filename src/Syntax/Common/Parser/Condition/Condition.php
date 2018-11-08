<?php

namespace Subapp\Sql\Syntax\Common\Parser\Condition;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Collection;
use Subapp\Sql\Ast\Condition\Precedence;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Condition
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Condition extends AbstractDefaultParser
{

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|Collection
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $collection = new Collection();
        
        do {
            $expression = $this->getComparisonParser($processor)->parse($lexer, $processor);
            $collection->append($expression);
            var_dump($collection);
        } while($this->isLogicalOperator($lexer) && $lexer->next());

        return $collection;
    }

}