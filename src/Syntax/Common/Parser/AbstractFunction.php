<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Identifier;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class AbstractFunction
 * @package Subapp\Sql\Syntax\Common\Parser
 */
abstract class AbstractFunction extends AbstractDefaultParser
{

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return NodeInterface|Identifier
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $identifier = $this->getIdentifierParser($processor)->parse($lexer, $processor);

        return $identifier;
    }

}