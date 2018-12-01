<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Update as UpdateNode;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Update
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class Update extends AbstractConverter
{

    /**
     * @inheritDoc
     *
     * @param NodeInterface|UpdateNode $node
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf("UPDATE %s%s%s%s%s%s%s",
            $provider->toSql($node->getFrom()),
            $provider->toSql($node->getAssignment()),
            $provider->toSql($node->getJoins()),
            $provider->toSql($node->getWhere()),
            $provider->toSql($node->getOrderBy()),
            $provider->toSql($node->getLimit()),
            $node->isSemicolon() ? "\n;" : null
        );
    }

    /**
     * @inheritDoc
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);



        return $values;
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        // TODO: Implement toNode() method.
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_STMT_UPDATE;
    }

}