<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Func\DefaultFunction;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class DefaultFunction
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class Func extends AbstractMySQLParser
{

    /**
     * @var array
     */
    private $aggregateFunction = [
        'COUNT', 'SUM', 'AVG', 'MAX', 'MIN',
    ];

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|DefaultFunction
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

}