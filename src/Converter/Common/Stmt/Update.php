<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\Literal;
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
        return sprintf("UPDATE%s%s%s%s%s%s%s%s",
            $provider->toSql($node->getModifiers()),
            $provider->toSql($node->getTableReference()),
            $provider->toSql($node->getAssignment()),
            $provider->toSql($node->getJoins()),
            $provider->toSql($node->getWhere()),
            $provider->toSql($node->getOrderBy()),
            $provider->toSql($node->getLimit()),
            $node->isSemicolon() ? ";" : null
        );
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|UpdateNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);

        $values['modifiers'] = $provider->toArray($node->getModifiers());
        $values['reference'] = $provider->toArray($node->getTableReference());
        $values['assignment'] = $provider->toArray($node->getAssignment());
        $values['joins'] = $provider->toArray($node->getJoins());
        $values['where'] = $provider->toArray($node->getWhere());
        $values['orderBy'] = $provider->toArray($node->getOrderBy());
        $values['limit'] = $provider->toArray($node->getLimit());
        $values['semicolon'] = $provider->toArray(new Literal($node->isSemicolon(), Literal::BOOLEAN));

        return $values;
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        $update = new UpdateNode();

        $update->setModifiers($provider->toNode($ast['modifiers']));
        $update->setTableReference($provider->toNode($ast['reference']));
        $update->setAssignment($provider->toNode($ast['assignment']));
        $update->setJoins($provider->toNode($ast['joins']));
        $update->setWhere($provider->toNode($ast['where']));
        $update->setOrderBy($provider->toNode($ast['orderBy']));
        $update->setLimit($provider->toNode($ast['limit']));

        $update->setSemicolon($ast['semicolon']['value']);

        return $update;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_STMT_UPDATE;
    }

}