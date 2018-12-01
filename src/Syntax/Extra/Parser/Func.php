<?php

namespace Subapp\Sql\Syntax\Extra\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Syntax\Common\Parser\Func as BaseFunc;
use Subapp\Sql\Syntax\ProcessorInterface;
use Subapp\Sql\Syntax\Extra\ExtraParserProviderTrait;

/**
 * Class Func
 * @package Subapp\Sql\Syntax\Extra\Parser
 */
class Func extends BaseFunc
{

    use ExtraParserProviderTrait;

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

}