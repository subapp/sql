<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Expression
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Expression extends AbstractDefaultParser
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
            case $this->isFunction($lexer):
                $parser = $this->getFunctionParser($processor);
                break;
            case $this->isOpenBrace($lexer):
                $parser = $this->getUncoverParser($processor);
                break;
            default:
                $parser = $this->getPrimaryParser($processor);
        }

        return $parser->parse($lexer, $processor);
    }

}