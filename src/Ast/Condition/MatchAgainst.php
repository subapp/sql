<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Ast\AbstractNode;
use Subapp\Sql\Ast\Arguments;
use Subapp\Sql\Ast\Collection;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\ConverterInterface;
use Subapp\Sql\Exception\UnsupportedException;

/**
 * Class MatchAgainst
 * @package Subapp\Sql\Ast\Condition
 */
class MatchAgainst extends AbstractNode
{
    
    const NULL_MODE                   = null;
    const BOOLEAN_MODE                = 'IN BOOLEAN MODE';
    const NATURAL_MODE                = 'IN NATURAL LANGUAGE MODE';
    const NATURAL_MODE_WITH_EXPANSION = 'IN NATURAL LANGUAGE MODE WITH QUERY EXPANSION';
    const WITH_QUERY                  = 'WITH QUERY EXPANSION';
    
    const AGAINST_NONE             = 1;
    const AGAINST_INCLUDE          = 2;
    const AGAINST_EXCLUDE          = 4;
    const AGAINST_TRUNCATION_LEFT  = 8;
    const AGAINST_TRUNCATION_RIGHT = 16;
    const AGAINST_TRUNCATION_BOTH  = 32;
    const AGAINST_NEGATION         = 64;
    
    const AGAINST_TEMPLATES = [
        self::AGAINST_NONE             => '%s',
        self::AGAINST_INCLUDE          => '+%s',
        self::AGAINST_EXCLUDE          => '-%s',
        self::AGAINST_TRUNCATION_LEFT  => '*%s',
        self::AGAINST_TRUNCATION_RIGHT => '%s*',
        self::AGAINST_TRUNCATION_BOTH  => '*%s*',
        self::AGAINST_NEGATION         => '~%s',
    ];
    
    /**
     * @var null|string
     */
    protected $searchModifier = self::NULL_MODE;
    
    /**
     * @var Collection
     */
    protected $matchColumns;
    
    /**
     * @var Collection
     */
    protected $againstWords;
    
    /**
     * @inheritDoc
     */
    public function __construct(array $columns = [], array $against = [])
    {
        $this->matchColumns = new Arguments($columns);
        $this->againstWords = new Collection($against);
    }
    
    /**
     * @param string $phrases
     *
     * @return $this
     */
    public function addPhrases($phrases)
    {
        return $this->addAgainst($phrases, static::AGAINST_NONE);
    }
    
    /**
     * @param null $phrase
     * @param int  $againstMode
     *
     * @return $this
     */
    public function addAgainst($phrase = null, $againstMode = self::AGAINST_NONE)
    {
        $pattern = '/\s+/ui';
        
        if (preg_match($pattern, $phrase)) {
            foreach (preg_split($pattern, $phrase) as $value) {
                $this->addAgainst($value, $againstMode);
            }
        } else {
            $this->againstWords->offsetSet($phrase, $againstMode);
        }
        
        return $this;
    }
    
    /**
     * @param string $phrases
     *
     * @return $this
     */
    public function addInclusionPhrases($phrases)
    {
        return $this->addAgainst($phrases, static::AGAINST_INCLUDE);
    }
    
    /**
     * @param string $phrases
     *
     * @return $this
     */
    public function addExclusionPhrases($phrases)
    {
        return $this->addAgainst($phrases, static::AGAINST_EXCLUDE);
    }
    
    /**
     * @param string $phrases
     *
     * @return $this
     */
    public function addRightTruncationPhrases($phrases)
    {
        return $this->addAgainst($phrases, static::AGAINST_TRUNCATION_RIGHT);
    }
    
    /**
     * @param string $phrases
     *
     * @return $this
     */
    public function addLeftTruncationPhrases($phrases)
    {
        return $this->addAgainst($phrases, static::AGAINST_TRUNCATION_LEFT);
    }
    
    /**
     * @param string $phrases
     *
     * @return $this
     */
    public function addBothTruncationPhrases($phrases)
    {
        return $this->addAgainst($phrases, static::AGAINST_TRUNCATION_BOTH);
    }
    
    /**
     * @param string $phrases
     *
     * @return $this
     */
    public function addNegationPhrases($phrases)
    {
        return $this->addAgainst($phrases, static::AGAINST_NEGATION);
    }
    
    /**
     * @return $this
     */
    public function clearAgainst()
    {
        $this->againstWords->clear();
        
        return $this;
    }

    /**
     * @param iterable $columns
     *
     * @return $this
     */
    public function addMatchColumns(iterable $columns = [])
    {
        foreach ($columns as $column) {
            $this->addMatchColumn($column);
        }
        
        return $this;
    }
    
    /**
     * @param NodeInterface $column
     *
     * @return $this
     */
    public function addMatchColumn(NodeInterface $column)
    {
        $this->matchColumns->append($column);
        
        return $this;
    }
    
    /**
     * @return $this
     */
    public function clearMatchColumns()
    {
        $this->matchColumns->clear();
        
        return $this;
    }
    
    /**
     * @return Collection
     */
    public function getAgainstWords()
    {
        return $this->againstWords;
    }

    /**
     * @return null|string
     */
    public function getSearchModifier()
    {
        return $this->searchModifier;
    }

    /**
     * @param string|null $searchModifier
     *
     * @return $this
     * @throws UnsupportedException
     */
    public function setSearchModifier($searchModifier)
    {
        $modifiers = [
            self::NULL_MODE,
            self::BOOLEAN_MODE,
            self::NATURAL_MODE,
            self::NATURAL_MODE_WITH_EXPANSION,
            self::WITH_QUERY,
        ];
        
        if (false === in_array($searchModifier, $modifiers)) {
            throw new UnsupportedException(sprintf('Not allowed search modifier (%s) for MATCH-AGAINST expression',
                $searchModifier));
        }
        
        $this->searchModifier = $searchModifier;
        
        return $this;
    }
    
    /**
     * @return Collection
     */
    public function getMatchColumns()
    {
        return $this->matchColumns;
    }

    /**
     * @inheritDoc
     */
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_MATCH_AGAINST;
    }

}
