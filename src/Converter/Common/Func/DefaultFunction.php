<?php

namespace Subapp\Sql\Converter\Common\Func;

use Subapp\Sql\Ast\Func\DefaultFunction as DefaultFunctionNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class DefaultFunction
 * @package Subapp\Sql\Converter\Common\Func
 */
class DefaultFunction extends AbstractConverter
{
    
    /**
     * @param NodeInterface|DefaultFunctionNode $node
     * @param ProviderInterface                 $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf('%s(%s)', strtoupper($provider->toSql($node->getFunctionName())),
            $provider->toSql($node->getArguments()));
    }
    
    /**
     * @inheritDoc
     *
     * @param NodeInterface|DefaultFunctionNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);
        
        $values['name'] = $provider->toArray($node->getFunctionName());
        $values['args'] = $provider->toArray($node->getArguments());
        
        return $values;
    }
    
    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        $function = new DefaultFunctionNode();
        
        $function->setFunctionName($provider->toNode($ast['name']));
        $function->setArguments($provider->toNode($ast['args']));
        
        return $function;
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_FUNC_DEFAULT;
    }
    
}