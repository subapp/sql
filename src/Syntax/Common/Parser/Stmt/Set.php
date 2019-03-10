<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Stmt\Set as SetNode;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;
use Subapp\Sql\Ast;

/**
 * Class Set
 * @package Subapp\Sql\Syntax\Common\Parser\Stmt
 */
class Set extends AssignmentList
{

    /**
     * @inheritDoc
     * @return Ast\Stmt\Set|Ast\NodeInterface
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->shift(Lexer::T_SET, $lexer);

        return parent::into($processor, new SetNode());
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::PARSER_STMT_SET;
    }

}