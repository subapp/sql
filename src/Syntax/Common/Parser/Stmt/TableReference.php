<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Collection;
use Subapp\Sql\Ast\Stmt\TableReference as TableReferenceNode;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class TableReference
 * @package Subapp\Sql\Ast\Stmt
 */
class TableReference extends AbstractDefaultParser
{

    /**
     * @inheritDoc
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        return $this->into($processor, new TableReferenceNode());
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

        $parser = $this->getVariableParser($processor);

        do {
            $collection->append($parser->parse($lexer, $processor));
        } while ($lexer->toToken(Lexer::T_COMMA));

        return $collection;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::PARSER_STMT_TABLE_REFERENCE;
    }

}