<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Assignment as AssignmentNode;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Assignment
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class Assignment extends AbstractConverter
{

    /**
     * @inheritDoc
     *
     * @param AssignmentNode $node
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf('%s = %s', $provider->toSql($node->getLeft()), $provider->toSql($node->getValue()));
    }

    /**
     * @inheritDoc
     *
     * @param AssignmentNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);

        $values['left']     = $provider->toArray($node->getLeft());
        $values['value']    = $provider->toArray($node->getValue());

        return $values;
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        return new AssignmentNode($provider->toNode($ast['left']), $provider->toNode($ast['value']));
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_ASSIGNMENT;
    }

}