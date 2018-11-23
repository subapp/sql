<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\QuoteIdentifier as IdentifierExpression;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class QuoteIdentifier
 * @package Subapp\Sql\Converter\Common
 */
class QuoteIdentifier extends Identifier
{
    
    /**
     * @param NodeInterface|IdentifierExpression $node
     * @param ProviderInterface   $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $renderer)
    {
        return sprintf('%s%s%s', $node->getQuote(), parent::toSql($node->getIdentifier(), $renderer), $node->getQuote());
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|IdentifierExpression $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $renderer)
    {
        $values = parent::toArray($node, $renderer);

        $values['quote'] = $node->getQuote();

        return $values;
    }

}