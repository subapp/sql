<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Stmt\Assignment as AssignmentNode;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Assignment
 * @package Subapp\Sql\Syntax\Common\Parser\Stmt
 */
class Assignment extends AbstractDefaultParser
{

    /**
     * @inheritDoc
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $node = new AssignmentNode();
        $parserB = $this->getParserB($processor);
        $parserC = $this->getParserC($processor);

        $node->setLeft($parserC->parse($lexer, $processor));
        $this->shift(Lexer::T_EQ, $lexer);
        $node->setValue($parserB->parse($lexer, $processor));

        return $node;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::PARSER_ASSIGNMENT;
    }

}