<?php

namespace Subapp\Sql\Converter;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Common\ClassNameTrait;

/**
 * Class AbstractConverter
 * @package Subapp\Sql\Converter
 */
abstract class AbstractConverter implements ConverterInterface
{
    
    use ClassNameTrait;
    
    /**
     * @inheritDoc
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        // converter key-name
        return ['node' => $this->getName(), 'constant' => $this->getConstantName($this->getName()),];
    }
    
    /**
     * @param $value
     * @return null|string
     */
    private function getConstantName($value)
    {
        static $constants;
        
        if (!$constants) {
            $constants = (new \ReflectionObject($this))->getConstants();
        }
        
        $key = array_search($value, $constants);
        
        return $key ? str_replace('CONVERTER_', null, $key) : null;
    }
    
}