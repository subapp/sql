<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\FieldPath as FieldPathNode;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class FieldPath
 * @package Subapp\Sql\Converter\Common
 */
class FieldPath extends AbstractConverter
{
    
    /**
     * @param NodeInterface|FieldPathNode $node
     * @param ProviderInterface                       $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf('%s.%s',
            $provider->toSql($node->getTable()), $provider->toSql($node->getField()));
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|FieldPathNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        return [
            'field' => $provider->toArray($node->getField()),
            'table' => $provider->toArray($node->getTable()),
        ];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        $path = new FieldPathNode();

        $path->setField($provider->toNode($ast['field']));
        $path->setTable($provider->toNode($ast['table']));

        return $path;
    }

}