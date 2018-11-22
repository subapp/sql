<?php

namespace Subapp\Sql\Converter;

use Subapp\Sql\Ast\NodeInterface;

/**
 * Interface RepresenterInterface
 * @package Subapp\Sql\Converter
 */
interface RepresenterInterface
{
    
    /**
     * @param RepresenterSetupInterface $rendererSetup
     */
    public function setup(RepresenterSetupInterface $rendererSetup);
    
    /**
     * @param NodeInterface $expression
     * @return string
     */
    public function toSql(NodeInterface $expression);

    /**
     * @param NodeInterface $expression
     * @return array
     */
    public function toArray(NodeInterface $expression);

    /**
     * @param array $ast
     * @return NodeInterface
     */
    public function toNode(array $ast);

    /**
     * @param ConverterInterface $represent
     */
    public function append(ConverterInterface $represent);
    
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