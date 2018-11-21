<?php

namespace Subapp\Sql\Render\Common\Represent;

use Subapp\Sql\Ast\Arguments as ArgumentsExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Arguments
 * @package Subapp\Sql\Render\Common\Represent
 */
class Arguments extends Collection
{
    
    /**
     * @param NodeInterface|ArgumentsExpression $node
     * @param RendererInterface                       $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        // ', ' - comma-separated
        $node->setSeparator("\x2c\x20");
        
        return parent::getSql($node, $renderer);
    }
    
}