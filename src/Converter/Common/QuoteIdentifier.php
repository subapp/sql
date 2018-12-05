<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\QuoteIdentifier as IdentifierNode;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class QuoteIdentifier
 * @package Subapp\Sql\Converter\Common
 */
class QuoteIdentifier extends Identifier
{
    
    /**
     * @param NodeInterface|IdentifierNode $node
     * @param ProviderInterface            $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf('%s%s%s', $node->getQuote(), $node->getIdentifier(), $node->getQuote());
    }
    
    /**
     * @inheritDoc
     *
     * @param NodeInterface|IdentifierNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);
        
        $values['quote'] = $node->getQuote();

        return $values;
    }
    
    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        $identifier = parent::toNode($ast, $provider);
        
        $identifier->setQuote($ast['quote']);
        
        return $identifier;
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_QUOTE_IDENTIFIER;
    }
    
}