<?php

namespace Subapp\Sql\Representer\Common\Converter;

use Subapp\Sql\Ast\Arguments as ArgumentsExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class Arguments
 * @package Subapp\Sql\Representer\Common\Converter
 */
class Arguments extends Collection
{
    
    /**
     * @param NodeInterface|ArgumentsExpression $node
     * @param RepresenterInterface                       $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        // ', ' - comma-separated
        $node->setSeparator("\x2c\x20");
        
        return parent::toSql($node, $renderer);
    }
    
}