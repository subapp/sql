<?php

namespace Subapp\Sql\Query;

use Subapp\Sql\Ast;
use Subapp\Sql\Converter\Converter;
use Subapp\Sql\Converter\ProviderInterface;
use Subapp\Sql\Exception\UnsupportedException;

/**
 * Query Builder (Facade) based on AST
 *  - use Recognizer for parsing short-part sql
 *  - with compliance fluent interface
 *
 * Class QueryNode
 * @package Subapp\Sql\Query
 */
class Query
{
    
    public const SELECT = 1;
    public const DELETE = 2;
    public const UPDATE = 4;
    public const INSERT = 8;
    
    public const GROUP_BY = 16;
    public const ORDER_BY = 32;
    public const WHERE    = 64;
    public const HAVING   = 128;
    
    public const ALL = PHP_INT_MAX;
    
    /**
     * @var Builder
     */
    private $builder;
    
    /**
     * @var integer
     */
    private $type = Query::SELECT;
    
    /**
     * @var Ast\Root
     */
    private $root;
    
    /**
     * @var Converter
     */
    private $converter;
    
    /**
     * QueryNode constructor.
     * @param Builder $builder
     */
    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
        $this->root = new Ast\Root();
    }
    
    /**
     * @param int $type
     * @return $this
     */
    public function reset($type = Query::ALL)
    {
        $root = $this->getRoot();
        
        switch (true) {
            case ($type & Query::SELECT):
                $root->getArguments()->clear();
                break;
            
            case ($type & Query::UPDATE):
                $root->getAssignment()->clear();
                break;
            
            case ($type & Query::INSERT):
                $root->getAssignment()->clear();
                $root->getValues()->clear();
                break;
            
            case ($type & Query::GROUP_BY):
                $root->getGroupBy()->clear();
                break;
            
            case ($type & Query::WHERE):
                $root->getWhere()->clear();
                break;
            
            case ($type & Query::HAVING):
                $root->getHaving()->clear();
                break;
            
            case ($type & Query::ORDER_BY):
                $root->getOrderBy()->clear();
                break;
        }
        
        return $this;
    }
    
    /**
     * @return $this
     */
    public function resetSelect()
    {
        return $this->reset(Query::SELECT);
    }
    
    /**
     * @return $this
     */
    public function resetInsert()
    {
        return $this->reset(Query::INSERT);
    }
    
    /**
     * @return $this
     */
    public function resetUpdate()
    {
        return $this->reset(Query::UPDATE);
    }
    
    /**
     * @return $this
     */
    public function resetWhere()
    {
        return $this->reset(Query::WHERE);
    }
    
    /**
     * @return $this
     */
    public function resetHaving()
    {
        return $this->reset(Query::HAVING);
    }
    
    /**
     * @return $this
     */
    public function resetGroupBy()
    {
        return $this->reset(Query::GROUP_BY);
    }
    
    /**
     * @return $this
     */
    public function resetOrderBy()
    {
        return $this->reset(Query::ORDER_BY);
    }
    
    /**
     * @return $this
     */
    public function asSelect()
    {
        $this->setType(Query::SELECT);
        
        return $this;
    }
    
    /**
     * @return $this
     */
    public function asDelete()
    {
        $this->setType(Query::DELETE);
        
        return $this;
    }
    
    /**
     * @return $this
     */
    public function asUpdate()
    {
        $this->setType(Query::UPDATE);
        
        return $this;
    }
    
    /**
     * @return $this
     */
    public function asInsert()
    {
        $this->setType(Query::INSERT);
        
        return $this;
    }
    
    /**
     * @param string $table
     * @return $this
     */
    public function select($table)
    {
        return $this->asSelect()->from($table);
    }
    
    /**
     * @param string $table
     * @return $this
     */
    public function insert($table)
    {
        return $this->asInsert()->into($table);
    }
    
    /**
     * @param string $table
     * @return $this
     */
    public function delete($table)
    {
        return $this->asDelete()->tables($table, null, 'FROM');
    }
    
    /**
     * @param string $table
     * @return $this
     */
    public function update($table)
    {
        return $this->asUpdate()->tables($table);
    }
    
    /**
     * @return $this
     */
    public function quick()
    {
        $this->root->modifiers()->add(Ast\Modifiers::MODIFIER_QUICK);
        
        return $this;
    }
    
    /**
     * @return $this
     */
    public function ignore()
    {
        $this->root->modifiers()->add(Ast\Modifiers::MODIFIER_IGNORE);
        
        return $this;
    }
    
    /**
     * @return $this
     */
    public function distinct()
    {
        $this->root->modifiers()->add(Ast\Modifiers::MODIFIER_DISTINCT);
        
        return $this;
    }
    
    /**
     * @return $this
     */
    public function delayed()
    {
        $this->root->modifiers()->add(Ast\Modifiers::MODIFIER_DELAYED);
        
        return $this;
    }
    
    /**
     * @return $this
     */
    public function noCache()
    {
        $this->root->modifiers()->add(Ast\Modifiers::MODIFIER_SQL_NO_CACHE);
        
        return $this;
    }
    
    /**
     * @param string|Ast\NodeInterface ...$columns
     * @return Query
     */
    public function columns(...$columns)
    {
        return $this->arguments(false, ...$columns);
    }
    
    /**
     * @param bool                     $wrapped
     * @param string|Ast\NodeInterface ...$arguments
     * @return $this
     */
    public function arguments($wrapped = false, ...$arguments)
    {
        /** @var Ast\Arguments $arguments */
        $arguments = $this->builder->recognize($arguments);
        $arguments->setWrapped($wrapped);
        
        $this->root->setArguments($arguments);
        
        return $this;
    }
    
    /**
     * @param $source
     * @param $alias
     * @return $this
     */
    public function into($source, $alias = null)
    {
        return $this->tables($source, $alias, 'INTO');
    }
    
    /**
     * @param $source
     * @param $alias
     * @return $this
     */
    public function from($source, $alias = null)
    {
        return $this->tables($source, $alias, 'FROM');
    }
    
    /**
     * @param string      $name
     * @param string|null $alias
     * @param string|null $prefix
     * @return $this
     */
    public function tables($name, $alias = null, $prefix = null)
    {
        $table = $this->root->tableReference();
        $variable = $this->builder->variable($name, $alias);
        
        $table->setPrefix($prefix);
        $table->append($variable);
        
        return $this;
    }
    
    /**
     * @param             $name
     * @param null|string $alias
     * @return Query
     */
    public function table($name, $alias = null)
    {
        $variable = $this->builder->variable($name, $alias);
        
        $this->root->setTable($variable);
        
        return $this;
    }
    
    /**
     * @param string ...$fields
     * @return $this
     */
    public function fields(...$fields)
    {
        return $this->arguments(true, ...$fields);
    }
    
    /**
     * @param array ...$values
     * @return $this
     */
    public function values(array $values)
    {
        $builder = $this->getBuilder();
        $root = $this->getRoot();
        
        /** @var Ast\Arguments $values */
        $values = $builder->normalize($values);
        
        $values->each(function ($key, Ast\Arguments $set) use ($root) {
            $set->setWrapped(true);
            $root->values()->append($set);
        });
        
        return $this;
    }
    
    /**
     * @param string|Ast\Condition\AbstractPredicate $x
     * @param boolean                                $clear
     * @return $this
     */
    public function where($x, $clear = true)
    {
        return $this->condition($this->root->where(), $x, $clear);
    }
    
    /**
     * @param string|Ast\Condition\AbstractPredicate $e
     * @param boolean                                $clear
     * @return $this
     */
    public function having($e, $clear = true)
    {
        return $this->condition($this->root->having(), $e, $clear);
    }
    
    /**
     * @param Ast\Condition\Conditions    $conditions
     * @param Ast\NodeInterface|string $e
     * @param bool                        $clear
     * @return $this
     */
    private function condition(Ast\Condition\Conditions $conditions, $e, $clear = true)
    {
        $outer = $conditions->getOperator();
        
        $predicates = $this->builder()->recognize($e);
        
        if ($predicates instanceof Ast\Condition\Conditions) {
            $inner = $predicates->getOperator();
            $ifGreaterThanOne = ($predicates->count() > 1);
            $predicates->setWrapped(!($outer->getOperator() == $inner->getOperator()) && $ifGreaterThanOne);
        }
        
        if ($clear) {
            $conditions->clear();
        }
        
        $conditions->append($predicates);
        
        return $this;
    }
    
    /**
     * @param $table
     * @param $a
     * @param $condition
     * @return Query
     */
    public function crossJoin($table, $a, $condition)
    {
        return $this->join($table, $a, $condition, Ast\Stmt\Join::CROSS);
    }
    
    /**
     * @param string                      $table
     * @param string                      $a
     * @param string|Ast\NodeInterface $condition
     * @return Query
     */
    public function rightJoin($table, $a, $condition)
    {
        return $this->join($table, $a, $condition, Ast\Stmt\Join::RIGHT);
    }
    
    /**
     * @param string                      $table
     * @param string                      $a
     * @param string|Ast\NodeInterface $condition
     * @return Query
     */
    public function leftJoin($table, $a, $condition)
    {
        return $this->join($table, $a, $condition, Ast\Stmt\Join::LEFT);
    }
    
    /**
     * @param string                      $table
     * @param string                      $a
     * @param string|Ast\NodeInterface $condition
     * @return Query
     */
    public function innerJoin($table, $a, $condition)
    {
        return $this->join($table, $a, $condition, Ast\Stmt\Join::INNER);
    }
    
    /**
     * @param string                      $table
     * @param string                      $a
     * @param string|Ast\NodeInterface $condition
     * @param string                      $type
     * @return $this
     */
    public function join($table, $a, $condition, $type = Ast\Stmt\Join::INNER)
    {
        $join = new Ast\Stmt\Join($type);
        $builder = $this->getBuilder();
        
        $this->root->getJoins()->append($join);
        
        $condition = $builder->recognize($condition);
        
        $join->setLeft($builder->table($table));
        $join->setConditionType(($condition instanceof Ast\Arguments) ? Ast\Stmt\Join::USING : Ast\Stmt\Join::ON);
        $join->setCondition($condition);
        
        return $this;
    }
    
    /**
     * @param string|Ast\NodeInterface $left
     * @param string|Ast\NodeInterface $value
     * @return $this
     */
    public function assignment($left, $value)
    {
        $this->root->assignment()->append(
            $this->builder->assignment($left, $value)
        );
        
        return $this;
    }
    
    /**
     * @param array|string[]|Ast\NodeInterface[] $assignments
     * @return $this
     */
    public function sets(array $assignments)
    {
        foreach ($assignments as $left => $value) {
            $this->set($left, $value);
        }
        
        return $this;
    }
    
    /**
     * @param string|Ast\NodeInterface $left
     * @param string|Ast\NodeInterface $value
     * @return $this
     */
    public function set($left, $value)
    {
        return $this->assignment($left, $value);
    }
    
    /**
     * @param string|Ast\NodeInterface ...$variables
     * @return $this
     */
    public function group(...$variables)
    {
        /** @var Ast\Arguments $variables */
        $variables = $this->builder->recognize($variables);
        $this->root->groupBy()->asBatch($variables->toArray());
        
        return $this;
    }
    
    /**
     * @param string|Ast\NodeInterface ...$arguments
     * @return $this
     */
    public function order(...$arguments)
    {
        $orderByNode = $this->root->orderBy();
        
        /** @var Ast\Arguments $arguments */
        $arguments = $this->builder->recognize($arguments);
        
        // @todo perhaps exist most elegant solution
        $arguments->each(function ($index, Ast\Stmt\OrderByItems $collection) use ($orderByNode) {
            $orderByNode->asBatch($collection->toArray());
        });
        
        return $this;
    }
    
    /**
     * @param integer $length
     * @param integer $offset
     * @return $this
     */
    public function limit($length, $offset = 0)
    {
        $limit = $this->root->limit();
        
        $limit->setLength($this->builder->int($length));
        $limit->setOffset($this->builder->int($offset));
        
        return $this;
    }
    
    /**
     * @return Ast\Stmt\Delete|Ast\Stmt\Select|Ast\Stmt\Update|Ast\Stmt\Insert
     * @throws UnsupportedException
     */
    public function getAst()
    {
        /** @var Ast\Stmt\Select|Ast\Stmt\Delete|Ast\Stmt\Update $ast */
        $ast = null;
        
        switch ($this->type) {
            case Query::SELECT:
                $ast = new Ast\Stmt\Select();
                break;
            case Query::DELETE:
                $ast = new Ast\Stmt\Delete();
                break;
            case Query::UPDATE:
                $ast = new Ast\Stmt\Update();
                break;
            case Query::INSERT:
                $ast = new Ast\Stmt\Insert();
                break;
            default:
                throw new UnsupportedException(sprintf('Cannot create AST builder for type: "%s"',
                    $this->getType()));
        }
        
        $ast->setRoot($this->root);
        
        return $ast;
    }
    
    /**
     * @return string
     * @throws UnsupportedException
     */
    public function getSql()
    {
        $converter = $this->getConverter();
        
        if ($converter == null) {
            throw new UnsupportedException(
                'Unable to build SQL string from AST tree because converter is not initialized yet');
        }
        
        return $converter->toSql($this->getAst());
    }
    
    /**
     * @param ProviderInterface $renderer
     * @return string
     */
    public function getQuery(ProviderInterface $renderer)
    {
        return $renderer->toSql($this->getAst());
    }
    
    
    /**
     * @return Builder
     */
    public function getBuilder()
    {
        return $this->builder;
    }
    
    /**
     * Alias: $this->getBuilder(): Query\builderBuilder
     *
     * @return Builder
     */
    public function builder()
    {
        return $this->getBuilder();
    }
    
    /**
     * @return Ast\Root
     */
    public function getRoot()
    {
        return $this->root;
    }
    
    /**
     * @param Ast\Root $root
     */
    public function setRoot(Ast\Root $root)
    {
        $this->root = $root;
    }
    
    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
    
    /**
     * @return Converter
     */
    public function getConverter()
    {
        return $this->converter;
    }
    
    /**
     * @param Converter $converter
     */
    public function setConverter(Converter $converter)
    {
        $this->converter = $converter;
    }
    
}
