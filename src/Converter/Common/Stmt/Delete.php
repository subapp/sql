<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\Literal;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Delete as DeleteNode;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Delete
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class Delete extends AbstractConverter
{

    /**
     * @inheritDoc
     *
     * @param NodeInterface|DeleteNode $node
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        $arguments = $node->getArguments();
        $arguments = $arguments->isNotEmpty() ? sprintf(' %s', $provider->toSql($arguments)) : null;

        return sprintf("DELETE%s%s%s%s%s%s%s%s",
            $provider->toSql($node->getModifiers()),
            $arguments,
            $provider->toSql($node->getTableReference()),
            $provider->toSql($node->getJoins()),
            $provider->toSql($node->getWhere()),
            $provider->toSql($node->getOrderBy()),
            $provider->toSql($node->getLimit()),
            $node->isSemicolon() ? "\n;" : null
        );
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|DeleteNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);

        $values['modifiers'] = $provider->toArray($node->getModifiers());
        $values['arguments'] = $provider->toArray($node->getArguments());
        $values['reference'] = $provider->toArray($node->getTableReference());
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
        $update = new DeleteNode();

        $update->setModifiers($provider->toNode($ast['modifiers']));
        $update->setArguments($provider->toNode($ast['arguments']));
        $update->setTableReference($provider->toNode($ast['reference']));
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
        return self::CONVERTER_STMT_DELETE;
    }

}