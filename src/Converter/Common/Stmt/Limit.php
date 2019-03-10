<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\Literal;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Limit as LimitNode;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Limit
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class Limit extends AbstractConverter
{
    
    /**
     * @param NodeInterface|LimitNode $node
     * @param ProviderInterface       $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        $offset = $node->getOffset();
        $length = $node->getLength();
        
        switch (true) {
            case ($length instanceOf Literal && (!($offset instanceOf Literal) || $offset->getValue() == 0)):
                return sprintf(' LIMIT %s', $provider->toSql($length));
            case ($length instanceOf Literal && $offset instanceOf Literal):
                return sprintf(' LIMIT %s, %s', $provider->toSql($offset), $provider->toSql($length));
        }
        
        return null;
    }
    
    /**
     * @inheritDoc
     *
     * @param NodeInterface|LimitNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);
        
        $values['offset'] = $node->getOffset()
            ? $provider->toArray($node->getOffset()) : null;
        $values['length'] = $node->getLength()
            ? $provider->toArray($node->getLength()) : null;
        
        return $values;
    }
    
    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        $offset = $ast['offset'] ? $provider->toNode($ast['offset']) : null;
        $length = $ast['length'] ? $provider->toNode($ast['length']) : null;
        
        return new LimitNode($offset, $length);
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_STMT_LIMIT;
    }
    
}