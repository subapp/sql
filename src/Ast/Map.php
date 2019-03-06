<?php

namespace Subapp\Sql\Ast;

/**
 * Class Map
 * @package Subapp\Sql\Ast
 */
final class Map
{

    const CLASSES = [
        Condition\AbstractIsNotPredicate::class => 'Condition.AbstractIsNotPredicate',
        Condition\AbstractPredicate::class => 'Condition.AbstractPredicate',
        Condition\Between::class => 'Condition.Between',
        Condition\Cmp::class => 'Condition.Cmp',
        Condition\Conditions::class => 'Condition.Conditions',
        Condition\In::class => 'Condition.In',
        Condition\IsNull::class => 'Condition.IsNull',
        Condition\Like::class => 'Condition.Like',
        Condition\LogicOperator::class => 'Condition.LogicOperator',
        Condition\Operator::class => 'Condition.Operator',
        Func\AggregateFunction::class => 'Func.AggregateFunction',
        Func\DefaultFunction::class => 'Func.DefaultFunction',
        Stmt\Assignment::class => 'Stmt.Assignment',
        Stmt\Delete::class => 'Stmt.Delete',
        Stmt\GroupBy::class => 'Stmt.GroupBy',
        Stmt\Having::class => 'Stmt.Having',
        Stmt\Insert::class => 'Stmt.Insert',
        Stmt\Join::class => 'Stmt.Join',
        Stmt\JoinItems::class => 'Stmt.JoinItems',
        Stmt\Limit::class => 'Stmt.Limit',
        Stmt\OrderBy::class => 'Stmt.OrderBy',
        Stmt\OrderByItems::class => 'Stmt.OrderByItems',
        Stmt\Select::class => 'Stmt.Select',
        Stmt\Set::class => 'Stmt.Set',
        Stmt\TableReference::class => 'Stmt.TableReference',
        Stmt\Update::class => 'Stmt.Update',
        Stmt\Where::class => 'Stmt.Where',
        Arguments::class => 'Root.Arguments',
        Arithmetic::class => 'Root.Arithmetic',
        Collection::class => 'Root.Collection',
        Embrace::class => 'Root.Embrace',
        FieldPath::class => 'Root.FieldPath',
        Identifier::class => 'Root.Identifier',
        Literal::class => 'Root.Literal',
        Map::class => 'Root.Map',
        MatchAgainst::class => 'Root.MatchAgainst',
        MathOperator::class => 'Root.MathOperator',
        Modifiers::class => 'Root.Modifiers',
        NodeInterface::class => 'Root.NodeInterface',
        Parameter::class => 'Root.Parameter',
        QuoteIdentifier::class => 'Root.QuoteIdentifier',
        Raw::class => 'Root.Raw',
        Root::class => 'Root.Root',
        Star::class => 'Root.Star',
        Variable::class => 'Root.Variable',
    ];

    /**
     * @param string $class
     * @return null|string
     */
    public static function toKey($class) {
        return Map::CLASSES[$class] ?? null;
    }

    /**
     * @param string $key
     * @return null|string
     */
    public static function toClass($key) {
        return array_flip(Map::CLASSES)[$key] ?? null;
    }

}