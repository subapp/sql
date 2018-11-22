<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\QuoteIdentifier as IdentifierExpression;
use Subapp\Sql\Converter\RepresenterInterface;

/**
 * Class QuoteIdentifier
 * @package Subapp\Sql\Converter\Common
 */
class QuoteIdentifier extends Identifier
{
    
    /**
     * @param NodeInterface|IdentifierExpression $node
     * @param RepresenterInterface   $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return sprintf('%s%s%s', $node->getQuote(), parent::toSql($node->getIdentifier(), $renderer), $node->getQuote());
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|IdentifierExpression $node
     */
    public function toArray(NodeInterface $node, RepresenterInterface $renderer)
    {
        $values = parent::toArray($node, $renderer);

        $values['quote'] = $node->getQuote();

        return $values;
    }

}