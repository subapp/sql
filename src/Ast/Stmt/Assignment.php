<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\AbstractNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class Assignment
 * @package Subapp\Sql\Ast\Stmt
 */
class Assignment extends AbstractNode
{

    /**
     * @var NodeInterface
     */
    private $left;

    /**
     * @var NodeInterface
     */
    private $value;

    /**
     * Assignment constructor.
     * @param NodeInterface $left
     * @param NodeInterface $value
     */
    public function __construct(NodeInterface $left = null, NodeInterface $value = null)
    {
        $this->left = $left;
        $this->value = $value;
    }

    /**
     * @return NodeInterface
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @param NodeInterface $left
     */
    public function setLeft(NodeInterface $left)
    {
        $this->left = $left;
    }

    /**
     * @return NodeInterface
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param NodeInterface $value
     */
    public function setValue(NodeInterface $value)
    {
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_ASSIGNMENT;
    }

}