<?php

namespace Subapp\Sql\Converter;

use Subapp\Sql\Ast\NodeInterface;

/**
 * Interface ConverterInterface
 * @package Subapp\Sql\Converter
 */
interface ConverterInterface
{

    const CONVERTER_ARGS = 'Converter::Arguments';
    const CONVERTER_ARITHMETIC = 'Converter::Arithmetic';
    const CONVERTER_COLLECTION = 'Converter::Collection';
    const CONVERTER_EMBRACE = 'Converter::Embrace';
    const CONVERTER_FIELD_PATH = 'Converter::FieldPath';
    const CONVERTER_IDENTIFIER = 'Converter::Identifier';
    const CONVERTER_LITERAL = 'Converter::Literal';
    const CONVERTER_MATH_OPERATOR = 'Converter::MathOperator';
    const CONVERTER_PARAMETER = 'Converter::Parameter';
    const CONVERTER_QUOTE_IDENTIFIER = 'Converter::QuoteIdentifier';
    const CONVERTER_RAW = 'Converter::Raw';
    const CONVERTER_VARIABLE = 'Converter::Variable';
    const CONVERTER_CONDITION_BETWEEN = 'Converter::Between';
    const CONVERTER_CONDITION_CMP = 'Converter::Cmp';
    const CONVERTER_CONDITION_CONDITIONS = 'Converter::Conditions';
    const CONVERTER_CONDITION_IN = 'Converter::In';
    const CONVERTER_CONDITION_IS_NULL = 'Converter::IsNull';
    const CONVERTER_CONDITION_LIKE = 'Converter::Like';
    const CONVERTER_CONDITION_LOGIC_OPERATOR = 'Converter::LogicOperator';
    const CONVERTER_CONDITION_CMP_OPERATOR = 'Converter::CmpOperator';
    const CONVERTER_FUNC_AGGREGATE = 'Converter::AggregateFunction';
    const CONVERTER_FUNC_DEFAULT = 'Converter::DefaultFunction';
    const CONVERTER_STMT_DELETE = 'Converter::Delete';
    const CONVERTER_STMT_FROM = 'Converter::From';
    const CONVERTER_STMT_GROUP_BY = 'Converter::GroupBy';
    const CONVERTER_STMT_HAVING = 'Converter::Having';
    const CONVERTER_STMT_JOIN = 'Converter::Join';
    const CONVERTER_STMT_JOIN_ITEMS = 'Converter::JoinItems';
    const CONVERTER_STMT_LIMIT = 'Converter::Limit';
    const CONVERTER_STMT_ORDER_BY = 'Converter::OrderBy';
    const CONVERTER_STMT_ORDER_BY_ITEMS = 'Converter::OrderByItems';
    const CONVERTER_STMT_SELECT = 'Converter::Select';
    const CONVERTER_STMT_UPDATE = 'Converter::Update';
    const CONVERTER_STMT_WHERE = 'Converter::Where';

    /**
     * @param NodeInterface $node
     * @param ProviderInterface   $provider
     *
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider);

    /**
     * @param NodeInterface $node
     * @param ProviderInterface $provider
     * @return array
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider);

    /**
     * @param array $ast
     * @param ProviderInterface $provider
     * @return NodeInterface
     */
    public function toNode(array $ast, ProviderInterface $provider);

    /**
     * @return string
     */
    public function getName();

}