<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Arguments;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class AssignmentList
 * @package Subapp\Sql\Syntax\Common\Parser\Stmt
 */
class AssignmentList extends AbstractDefaultParser
{
    /**
     * @inheritDoc
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $node = new Arguments();
        $parser = $this->getAssignmentStmtParser($processor);

        do{
            $node->append($parser->parse($lexer, $processor));
        } while($lexer->toToken(Lexer::T_COMMA));

        return $node;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
       return self::PARSER_ASSIGNMENT_LIST;
    }

}