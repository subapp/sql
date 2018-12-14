<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Insert as InsertNode;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;
use Subapp\Sql\Exception\UnsupportedException;

/**
 * Class Insert
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class Insert extends AbstractConverter
{

    /**
     * @inheritDoc
     *
     * @param NodeInterface|InsertNode $node
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        $insert = [
            sprintf('INSERT%s',
                $provider->toSql($node->getModifiers())),
            sprintf('INTO %s',
                $provider->toSql($node->getTable()))
        ];

        $type = $node->getType();

        if ($type->has(InsertNode::INSERT_SET_ASSIGNMENT)) {
            $insert[] = $provider->toSql($node->getAssignment());
        }

        if ($type->has(InsertNode::INSERT_FIELDS)) {
            $insert[] = $provider->toSql($node->getArguments());
        }

        if ($type->has(InsertNode::INSERT_VALUES)) {
            $insert[] = sprintf('VALUES %s', $provider->toSql($node->getValueList()));
        }

        if ($type->has(InsertNode::INSERT_SELECT)) {
            $insert[] = sprintf('%s', $provider->toSql($node->getValueList()));
        }

        return implode(' ', $insert);
    }

    /**
     * @inheritDoc
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        throw new UnsupportedException(__METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        throw new UnsupportedException(__METHOD__);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_STMT_INSERT;
    }


}