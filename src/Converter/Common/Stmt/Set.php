<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Set as SetNode;
use Subapp\Sql\Converter\Common\Arguments;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Set
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class Set extends Arguments
{

    /**
     * @inheritDoc
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf('SET %s', parent::toSql($node, $provider));
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        return $this->toCollection(new SetNode(), $ast, $provider);
    }


    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_STMT_SET;
    }

}