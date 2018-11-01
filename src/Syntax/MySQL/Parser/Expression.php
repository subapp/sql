<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Expression
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class Expression extends AbstractMySQLParser
{

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $parser = null;

        switch (true) {
            case $this->isBraced($lexer):
                $parser = $this->getEmbraceParser($processor);
                break;
            case $this->isFunction($lexer):
                $parser = $this->getFunctionParser($processor);
                break;
            default:
                $parser = $this->getPrimaryParser($processor);
        }

        return $parser->parse($lexer, $processor);
    }

}