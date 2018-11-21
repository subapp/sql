<?php

namespace Subapp\Sql\Render;

use Subapp\Sql\Ast\NodeInterface;

/**
 * Interface RendererInterface
 * @package Subapp\Sql\Render
 */
interface RendererInterface
{
    
    /**
     * @param RendererSetupInterface $rendererSetup
     */
    public function setup(RendererSetupInterface $rendererSetup);
    
    /**
     * @param NodeInterface $expression
     * @return string
     */
    public function render(NodeInterface $expression);

    /**
     * @param NodeInterface $expression
     * @return array
     */
    public function toArray(NodeInterface $expression);

    /**
     * @param NodeInterface $node
     * @param array $values
     * @return NodeInterface
     */
    public function fromArray(NodeInterface $node, array $values);

    /**
     * @param RepresentInterface $represent
     */
    public function addRepresent(RepresentInterface $represent);
    
    /**
     * @param string $name
     */
    public function removeRepresent($name);
    
    /**
     * @param string $name
     * @return boolean
     */
    public function hasRepresent($name);
    
    /**
     * @param string $name
     * @return RepresentInterface
     */
    public function getRepresent($name);

}