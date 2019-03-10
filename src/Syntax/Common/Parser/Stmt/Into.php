<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;
use Subapp\Sql\Ast;

/**
 * Class Into
 * @package Subapp\Sql\Syntax\Common\Parser\Stmt
 */
class Into extends TableReference
{

    /**
     * @inheritDoc
     * @return Ast\Stmt\TableReference|Ast\NodeInterface
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->shift(Lexer::T_INTO, $lexer);
    
        $reference = new Ast\Stmt\TableReference();
        $reference->setPrefix('INTO');
    
        return parent::into($processor, $reference);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::PARSER_STMT_INTO;
    }

}