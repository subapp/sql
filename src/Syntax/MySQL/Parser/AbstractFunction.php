<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Identifier;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class AbstractFunction
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
abstract class AbstractFunction extends AbstractMySQLParser
{

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|Identifier
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $identifier = $this->getIdentifierParser($processor)->parse($lexer, $processor);

        return $identifier;
    }

}