<?php

namespace Subapp\Sql\Render\Common\Represent\Func;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Func\DefaultFunction as DefaultFunctionExpression;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class DefaultFunction
 * @package Subapp\Sql\Render\Common\Represent\Func
 */
class DefaultFunction extends AbstractRepresent
{
    
    /**
     * @param NodeInterface|DefaultFunctionExpression $node
     * @param RendererInterface   $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return sprintf('%s(%s)', strtoupper($renderer->render($node->getFunctionName())),
            $renderer->render($node->getArguments()));
    }


    
}