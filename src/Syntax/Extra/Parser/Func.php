<?php

namespace Subapp\Sql\Syntax\Extra\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Syntax\Common\Parser\Func as BaseFunc;
use Subapp\Sql\Syntax\ParserInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Func
 * @package Subapp\Sql\Syntax\Extra\Parser
 */
class Func extends BaseFunc
{

    /**
     * @inheritDoc
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $token = $lexer->peek();
        $lexer->resetPeek();
        $function = strtoupper($token->getToken());
        $hasFunctionParser = $this->hasFuncParser($function, $processor);

        return $hasFunctionParser
            ? $this->getFuncParser($function, $processor)->parse($lexer, $processor)
            : parent::parse($lexer, $processor);
    }

    /**
     * @param string $name
     * @param ProcessorInterface $processor
     * @return ParserInterface
     */
    public function getFuncParser($name, ProcessorInterface $processor)
    {
        return $processor->getParser($this->completeName($name));
    }

    /**
     * @param string $name
     * @param ProcessorInterface $processor
     * @return boolean
     */
    public function hasFuncParser($name, ProcessorInterface $processor)
    {
        return $processor->has($this->completeName($name));
    }

    /**
     * @param string $name
     * @return string
     */
    public function completeName($name)
    {
        return sprintf('EXTRA_FUNC_%s', strtoupper($name));
    }

}