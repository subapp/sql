<?php

namespace Subapp\Sql\Converter\Common\Func;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Func\DefaultFunction as DefaultFunctionExpression;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\RepresenterInterface;

/**
 * Class DefaultFunction
 * @package Subapp\Sql\Converter\Common\Func
 */
class DefaultFunction extends AbstractConverter
{
    
    /**
     * @param NodeInterface|DefaultFunctionExpression $node
     * @param RepresenterInterface   $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return sprintf('%s(%s)', strtoupper($renderer->toSql($node->getFunctionName())),
            $renderer->toSql($node->getArguments()));
    }


    
}