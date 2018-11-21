<?php

namespace Subapp\Sql\Representer;

use Subapp\Sql\Ast\NodeInterface;

/**
 * Interface RepresentInterface
 * @package Subapp\Sql\Representer
 */
interface ConverterInterface
{

    /**
     * @param NodeInterface $node
     * @param RepresenterInterface   $renderer
     *
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer);

    /**
     * @param NodeInterface $node
     * @param RepresenterInterface $renderer
     * @return array
     */
    public function toArray(NodeInterface $node, RepresenterInterface $renderer);

    /**
     * @param array $ast
     * @param RepresenterInterface $renderer
     * @return NodeInterface
     */
    public function toNode(array $ast, RepresenterInterface $renderer);

    /**
     * @return string
     */
    public function getName();

}