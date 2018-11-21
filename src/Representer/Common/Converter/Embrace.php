<?php

namespace Subapp\Sql\Representer\Common\Converter;

use Subapp\Sql\Ast\Embrace as EmbraceExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Select;
use Subapp\Sql\Representer\AbstractConverter;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class Embrace
 * @package Subapp\Sql\Representer\Common\Converter
 */
class Embrace extends AbstractConverter
{

    /**
     * @param NodeInterface|EmbraceExpression $node
     * @param RepresenterInterface $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        $template = ($node->getInner() instanceof Select) ? '(%s)' : '%s';
        
        return sprintf($template, $renderer->toSql($node->getInner()));
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|EmbraceExpression $node
     */
    public function toArray(NodeInterface $node, RepresenterInterface $renderer)
    {
        return ['inner' => $renderer->toArray($node->getInner()),];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, RepresenterInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}