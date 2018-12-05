<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\TableReference as TableReferenceNode;
use Subapp\Sql\Converter\Common\Arguments;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class From
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class TableReference extends Arguments
{
    
    /**
     * @param ProviderInterface                $provider
     * @param NodeInterface|TableReferenceNode $node
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf(' %s%s',
            $node->getPrefix() ? sprintf(' %s', $node->getPrefix()) : null,
            parent::toSql($node, $provider));
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|TableReferenceNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);

        $values['prefix'] = $node->getPrefix();

        return $values;
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        /** @var TableReferenceNode $node */
        $node = $this->toCollection(new TableReferenceNode(), $ast, $provider);

        $node->setPrefix($ast['prefix']);

        return $node;
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_STMT_TABLE_REFERENCE;
    }
    
}