<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\Like as LikeNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Like
 * @package Subapp\Sql\Converter\Common\Condition
 */
class Like extends AbstractConverter
{
    
    /**
     * @param NodeInterface|LikeNode $node
     * @param ProviderInterface                  $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf('%s%s LIKE %s',
            $provider->toSql($node->getLeft()),
            ($node->isNot() ? ' NOT' : null),
            $provider->toSql($node->getRight()));
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|LikeNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);

        $values['left'] = $provider->toArray($node->getLeft());
        $values['isNot'] = $node->isNot();
        $values['args'] = $provider->toArray($node->getRight());

        return $values;
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        $like = new LikeNode();

        $like->setLeft($provider->toNode($ast['left']));
        $like->setIsNot($ast['isNot']);
        $like->setRight($provider->toNode($ast['right']));

        return $like;
    }
    
}