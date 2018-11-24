<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\Embrace as EmbraceNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Raw;
use Subapp\Sql\Ast\Stmt\Select;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Embrace
 * @package Subapp\Sql\Converter\Common
 */
class Embrace extends AbstractConverter
{
    
    /**
     * @param NodeInterface|EmbraceNode $node
     * @param ProviderInterface         $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        $template = ($node->getInner() instanceof Select) ? '(%s)' : '%s';
        
        return sprintf($template, $provider->toSql($node->getInner()));
    }
    
    /**
     * @inheritDoc
     *
     * @param NodeInterface|EmbraceNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);
        
        $values['inner'] = $provider->toArray($node->getInner());
        
        return $values;
    }
    
    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        return new EmbraceNode($ast['inner'] ?? new Raw('[NULL]'));
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_EMBRACE;
    }
    
}