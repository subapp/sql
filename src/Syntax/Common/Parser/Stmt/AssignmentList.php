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
        return $this->into($processor, new Arguments());
    }

    /**
     * @param ProcessorInterface $processor
     * @param Collection|null $collection
     * @return Collection
     */
    public function into(ProcessorInterface $processor, Collection $collection = null)
    {
        $lexer = $processor->getLexer();
        $collection = $collection ?: new Collection();

        $parser = $this->getAssignmentStmtParser($processor);

        do{
            $collection->append($parser->parse($lexer, $processor));
        } while($lexer->toToken(Lexer::T_COMMA));

        return $collection;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
       return self::PARSER_ASSIGNMENT_LIST;
    }

}