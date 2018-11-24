<?php

namespace Subapp\Sql\Converter;

use Subapp\Sql\Ast\NodeInterface;

/**
 * Interface ProviderInterface
 * @package Subapp\Sql\Converter
 */
interface ProviderInterface
{
    
    /**
     * @param ConverterSetupInterface $setup
     */
    public function setup(ConverterSetupInterface $setup);
    
    /**
     * @param NodeInterface $node
     * @return string
     */
    public function toSql(NodeInterface $node);
    
    /**
     * @param NodeInterface $node
     * @return array
     */
    public function toArray(NodeInterface $node);
    
    /**
     * @param array $ast
     * @return NodeInterface
     */
    public function toNode(array $ast);
    
    /**
     * @param ConverterInterface $converter
     */
    public function append(ConverterInterface $converter);
    
    /**
     * @param string $name
     */
    public function remove($name);
    
    /**
     * @param string $name
     * @return boolean
     */
    public function has($name);
    
    /**
     * @param string $name
     * @return ConverterInterface
     */
    public function getConverter($name);
    
}