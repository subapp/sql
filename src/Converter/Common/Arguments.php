<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\Arguments as ArgumentsNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Arguments
 * @package Subapp\Sql\Converter\Common
 */
class Arguments extends Collection
{
    
    /**
     * @param NodeInterface|ArgumentsNode $node
     * @param ProviderInterface           $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        // ', ' - comma-separated
        $node->setSeparator("\x2c\x20");
        
        return parent::toSql($node, $provider);
    }
    
    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        return $this->toCollection(new ArgumentsNode(), $ast, $provider);
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_ARGS;
    }
    
}