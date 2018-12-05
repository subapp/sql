<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\MatchAgainst as MatchAgainstNode;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class MatchAgainst
 * @package Subapp\Sql\Converter\Common
 */
class MatchAgainst extends AbstractConverter
{
    /**
     * @inheritDoc
     *
     * @param MatchAgainstNode $node
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        $against = [];

        foreach ($node->getAgainstWords() as $value => $modifier) {
            $against[] = sprintf(MatchAgainstNode::AGAINST_TEMPLATES[$modifier], $value);
        }

        $searchModifier = $node->getSearchModifier();
        $searchModifier = ($searchModifier ? sprintf(' %s', $searchModifier) : null);

        return sprintf('MATCH (%s) AGAINST ("%s"%s)',
            $provider->toSql($node->getMatchColumns()), implode(' ', $against), $searchModifier);
    }

    /**
     * @inheritDoc
     *
     * @param MatchAgainstNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);

        $values['mode'] = $node->getSearchModifier();
        $values['against'] = $provider->toArray($node->getAgainstWords());
        $values['columns'] = $provider->toArray($node->getMatchColumns());

        return $values;
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        $matchAgainst = new MatchAgainstNode();



        return $matchAgainst;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_MATCH_AGAINST;
    }

}