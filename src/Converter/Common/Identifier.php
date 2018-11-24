<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\Identifier as IdentifierNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Identifier
 * @package Subapp\Sql\Converter\Common
 */
class Identifier extends AbstractConverter
{
    
    /**
     * @param NodeInterface|IdentifierNode $node
     * @param ProviderInterface            $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return (string)$node->getIdentifier();
    }
    
    /**
     * @inheritDoc
     *
     * @param NodeInterface|IdentifierNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);
        
        $values['identifier'] = $node->getIdentifier();
        
        return $values;
    }
    
    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        return new IdentifierNode($ast['identifier']);
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_IDENTIFIER;
    }
    
}