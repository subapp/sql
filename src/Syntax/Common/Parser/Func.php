<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Func\DefaultFunction;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class DefaultFunction
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Func extends AbstractDefaultParser
{
    
    /**
     * @var array
     */
    private $aggregateFunction = [
        'COUNT', 'SUM', 'AVG', 'MAX', 'MIN',
    ];
    
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return NodeInterface|DefaultFunction
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $token = $lexer->peek();
        $parser = null;
        $lexer->resetPeek();
        
        switch (true) {
            case $this->isAggregateFunction($token->getToken()):
                $parser = $this->getAggregateFunctionParser($processor);
                break;
            default:
                $parser = $this->getDefaultFunctionParser($processor);
        }
        
        return $parser->parse($lexer, $processor);
    }
    
    /**
     * @param string $name
     * @return boolean
     */
    public function isAggregateFunction($name)
    {
        return in_array(strtoupper($name), $this->aggregateFunction, true);
    }
    
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return self::PARSER_FUNC;
    }
    
}