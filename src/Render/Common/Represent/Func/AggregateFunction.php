<?php

namespace Subapp\Sql\Render\Common\Represent\Func;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Func\AggregateFunction as AggregateFunctionExpression;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class AggregateFunction
 * @package Subapp\Sql\Render\Common\Represent\Func
 */
class AggregateFunction extends AbstractRepresent
{

    /**
     * @param NodeInterface|AggregateFunctionExpression $node
     * @param RendererInterface $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        $distinct = $node->isDistinct() ? 'DISTINCT ' : null;
        $function = strtoupper($renderer->render($node->getFunctionName()));

        return sprintf('%s(%s%s)', $function, $distinct, $renderer->render($node->getArguments()));
    }

}