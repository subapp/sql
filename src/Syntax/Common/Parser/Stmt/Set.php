<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Stmt\Set as SetNode;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Set
 * @package Subapp\Sql\Syntax\Common\Parser\Stmt
 */
class Set extends AssignmentList
{

    /**
     * @inheritDoc
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
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