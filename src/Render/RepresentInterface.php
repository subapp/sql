<?php

namespace Subapp\Sql\Render;

use Subapp\Sql\Ast\NodeInterface;

/**
 * Interface RepresentInterface
 * @package Subapp\Sql\Render
 */
interface RepresentInterface
{

    /**
     * @param NodeInterface $node
     * @param RendererInterface   $renderer
     *
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer);

    /**
     * @param NodeInterface $node
     * @param RendererInterface $renderer
     * @return array
     */
    public function toArray(NodeInterface $node, RendererInterface $renderer);

    /**
     * @param array $values
     * @param RendererInterface $renderer
     * @return NodeInterface
     */
    public function toNode(array $values, RendererInterface $renderer);

    /**
     * @return string
     */
    public function getName();

}