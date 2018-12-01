<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class FromParser
 * @package Subapp\Sql\Syntax\Common\Parser\Common
 */
class From extends AbstractDefaultParser
{
    
    /**
     * @inheritdoc
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->shift(Lexer::T_FROM, $lexer);

        $reference = new Ast\Stmt\TableReference();
        $this->getTableReferenceStmtParser($processor)->into($processor, $reference);
        $reference->setPrefix(Ast\Stmt\TableReference::SELECT_FROM);

        return $reference;
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::PARSER_STMT_FROM;
    }
    
}