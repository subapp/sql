<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Modifiers as ModifiersNode;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Modifiers
 * @package Subapp\Sql\Converter\Common
 */
class Modifiers extends AbstractConverter
{

    /**
     * @inheritDoc
     *
     * @param ModifiersNode $node
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        $modifiers = [];

        foreach ($node->getModifiersMap() as $bit => $name) {
            if ($node->getModifiers() & $bit) {
                $modifiers[] = $name;
            }
        }
        
        return empty($modifiers) ? null : sprintf(' %s', implode("\x20", $modifiers));
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        return new ModifiersNode($ast['modifiers']);
    }

    /**
     * @inheritDoc
     * @param ModifiersNode $node
     *
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);

        $values['modifiers'] = $node->getModifiers();

        return $values;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_MODIFIERS;
    }

}