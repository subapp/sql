<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Sql\Ast;
use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Common\Bit;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Insert
 * @package Subapp\Sql\Syntax\Common\Parser\Stmt
 */
class Insert extends AbstractDefaultParser
{

    /**
     * @inheritDoc
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $insert     = new Ast\Stmt\Insert();
        $root       = new Ast\Root();
        $insert->setRoot($root);

        // If lexer was executed like lexer->tokenize(sql, FALSE) - (without shifting with blank token)
        // that means next token is NOT SELECT
        $this->shiftIf(Lexer::T_INSERT, $lexer);

        // INSERT {INTO users} ...
        $root->setTable($this->getIntoStmtParser($processor)->parse($lexer, $processor));

        // - INSERT INTO users (name, age, phone) VALUES ('John', 25, '123-12-12')
        // - INSERT INTO users VALUES(50 * 2, 'John', 'Sales', 5000 + id)
        // - INSERT INTO users SELECT * FROM tmp_users
        // - INSERT INTO users SET parent_id=1000, name='John'
        $this->insert($root, $insert->getType(), $processor);

        return $insert;
    }

    /**
     * @param Ast\Root $root
     * @param Bit\AbstractBit $bit
     * @param ProcessorInterface $processor
     */
    private function insert(Ast\Root $root, Bit\AbstractBit $bit, ProcessorInterface $processor)
    {
        $lexer = $processor->getLexer();

        // Try to recognize one of syntax
        switch (true) {

            // INSERT INTO users {(name, age, phone)} VALUES ('John', 25, '123-12-12')
            case $this->isOpenBrace($lexer):

                $bit->add(Ast\Stmt\Insert::INSERT_FIELDS);

                $this->shift(Lexer::T_OPEN_BRACE, $lexer);
                $root->setArguments($this->getVariablesParser($processor)->parse($lexer, $processor));
                $this->shift(Lexer::T_CLOSE_BRACE, $lexer);

                // used the first time in ten years :D
                // just for fun
                goto valueList;

            // INSERT INTO users {VALUES(50 * 2, 'John', 'Sales', 5000 + id)}
            case $lexer->isNext(Lexer::T_VALUES):

                // oh yeah baby :D
                valueList:

                $bit->add(Ast\Stmt\Insert::INSERT_VALUES);
                $root->setValues($this->getValueListStmtParser($processor)->parse($lexer, $processor));

                break;

            // INSERT INTO users {SET parent_id=1000, name='John'}
            case $lexer->isNext(Lexer::T_SET):

                $bit->add(Ast\Stmt\Insert::INSERT_SET_ASSIGNMENT);
                $root->setAssignment($this->getSetStmtParser($processor)->parse($lexer, $processor));

                break;

            // INSERT INTO users {SELECT * FROM tmp_users}
            case $lexer->isNext(Lexer::T_SELECT):

                $bit->add(Ast\Stmt\Insert::INSERT_SELECT);
                $select = $this->getSelectStmtParser($processor)->parse($lexer, $processor);

                var_dump($select);
                break;

            // syntax error
            default:
                $this->throwSyntaxError($lexer, Lexer::T_SET, Lexer::T_VALUES, Lexer::T_SELECT, 'Columns');
        }
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::PARSER_STMT_INSERT;
    }

}