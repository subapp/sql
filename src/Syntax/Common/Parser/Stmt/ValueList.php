<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Arguments as ValueListNode;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\Arguments;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class ValueList
 * @package Subapp\Sql\Syntax\Common\Parser\Stmt
 */
class ValueList extends Arguments
{

    /**
     * @inheritDoc
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $values = new ValueListNode();

        $values->setClass(ValueListNode::class);

        $this->shift(Lexer::T_VALUES, $lexer);

        do {
            $this->shift(Lexer::T_OPEN_BRACE, $lexer);
            $node = parent::parse($lexer, $processor);
            $node->setWrapped(true);
            $values->append($node);
            $this->shift(Lexer::T_CLOSE_BRACE, $lexer);
        } while($lexer->toToken(Lexer::T_COMMA));

        return $values;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::PARSER_STMT_VALUES;
    }

}