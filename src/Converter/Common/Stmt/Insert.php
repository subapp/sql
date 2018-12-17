<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\Literal;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Insert as InsertNode;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Insert
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class Insert extends AbstractConverter
{
    
    /**
     * @inheritDoc
     *
     * @param NodeInterface|InsertNode $node
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        $insert = [
            sprintf('INSERT%s',
                $provider->toSql($node->getModifiers())),
            sprintf('INTO %s',
                $provider->toSql($node->getTable())),
        ];
        
        $node->hasType() || $node->defineType();
        
        $type = $node->getType();
        
        if ($type->has(InsertNode::INSERT_SET_ASSIGNMENT)) {
            $insert[] = trim($provider->toSql($node->getAssignment()));
        }
        
        if ($type->has(InsertNode::INSERT_FIELDS)) {
            $insert[] = $provider->toSql($node->getArguments());
        }
        
        if ($type->has(InsertNode::INSERT_VALUES)) {
            $insert[] = sprintf('VALUES %s', $provider->toSql($node->getValueList()));
        }
        
        if ($type->has(InsertNode::INSERT_SELECT)) {
            $insert[] = sprintf('%s', $provider->toSql($node->getValueList()));
        }
    
        $insert[] = $node->isSemicolon() ? ";" : null;
        
        return implode(' ', $insert);
    }
    
    /**
     * @inheritDoc
     *
     * @param NodeInterface|InsertNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);
        $insertType = $node->getType();
    
        $node->hasType() || $node->defineType();
        
        $values['insertType'] = $insertType->getBitMask();
        $values['modifiers'] = $provider->toArray($node->getModifiers());
        $values['table'] = $provider->toArray($node->getTable());
        $values['assignment'] = $provider->toArray($node->getAssignment());
        $values['fields'] = $provider->toArray($node->getArguments());
        $values['semicolon'] = $provider->toArray(new Literal($node->isSemicolon(), Literal::BOOLEAN));
        
        if ($insertType->has(InsertNode::INSERT_VALUES)) {
            $values['valueList'] = $provider->toArray($node->getValueList());
        }
        
        if ($insertType->has(InsertNode::INSERT_SELECT)) {
            $values['subSelect'] = $provider->toArray($node->getValueList());
        }
        
        return $values;
    }
    
    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        $insert = new InsertNode();

        $insertType = $insert->getType();
        $insertType->setBitMask($ast['insertType']);
    
        $insert->setModifiers($provider->toNode($ast['modifiers']));
        $insert->setTable($provider->toNode($ast['table']));
        $insert->setAssignment($provider->toNode($ast['assignment']));
        $insert->setArguments($provider->toNode($ast['fields']));
        $insert->setSemicolon($ast['semicolon']['value'] ?? false);

        if ($insertType->has(InsertNode::INSERT_VALUES)) {
            $insert->setValueList($provider->toNode($ast['valueList']));
        }
    
        if ($insertType->has(InsertNode::INSERT_SELECT)) {
            $insert->setValueList($provider->toNode($ast['subSelect']));
        }
    
        return $insert;
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_STMT_INSERT;
    }
    
    
}