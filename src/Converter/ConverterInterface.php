<?php

namespace Subapp\Sql\Converter;

use Subapp\Sql\Ast\NodeInterface;

/**
 * Interface ConverterInterface
 * @package Subapp\Sql\Converter
 */
interface ConverterInterface
{

    const CONVERTER_ARGS                     = 'ARGS';
    const CONVERTER_ARITHMETIC               = 'ARITHMETIC';
    const CONVERTER_ASSIGNMENT               = 'ASSIGNMENT';
    const CONVERTER_COLLECTION               = 'COLLECTION';
    const CONVERTER_EMBRACE                  = 'EMBRACE';
    const CONVERTER_FIELD_PATH               = 'FIELD_PATH';
    const CONVERTER_IDENTIFIER               = 'IDENTIFIER';
    const CONVERTER_LITERAL                  = 'LITERAL';
    const CONVERTER_MATH_OPERATOR            = 'MATH_OPERATOR';
    const CONVERTER_PARAMETER                = 'PARAMETER';
    const CONVERTER_QUOTE_IDENTIFIER         = 'QUOTE_IDENTIFIER';
    const CONVERTER_RAW                      = 'RAW';
    const CONVERTER_VARIABLE                 = 'VARIABLE';
    const CONVERTER_CONDITION_BETWEEN        = 'CONDITION_BETWEEN';
    const CONVERTER_CONDITION_CMP            = 'CONDITION_CMP';
    const CONVERTER_CONDITION_CONDITIONS     = 'CONDITION_CONDITIONS';
    const CONVERTER_CONDITION_IN             = 'CONDITION_IN';
    const CONVERTER_CONDITION_IS_NULL        = 'CONDITION_IS_NULL';
    const CONVERTER_CONDITION_LIKE           = 'CONDITION_LIKE';
    const CONVERTER_CONDITION_LOGIC_OPERATOR = 'CONDITION_LOGIC_OPERATOR';
    const CONVERTER_CONDITION_CMP_OPERATOR   = 'CONDITION_CMP_OPERATOR';
    const CONVERTER_FUNC_AGGREGATE           = 'FUNC_AGGREGATE';
    const CONVERTER_FUNC_DEFAULT             = 'FUNC_DEFAULT';
    const CONVERTER_MATCH_AGAINST            = 'MATCH_AGAINST';
    const CONVERTER_MODIFIERS                = 'MODIFIERS';
    const CONVERTER_STMT_DELETE              = 'STMT_DELETE';
    const CONVERTER_STMT_TABLE_REFERENCE     = 'STMT_TABLE_REFERENCE';
    const CONVERTER_STMT_GROUP_BY            = 'STMT_GROUP_BY';
    const CONVERTER_STMT_HAVING              = 'STMT_HAVING';
    const CONVERTER_STMT_INSERT              = 'STMT_INSERT';
    const CONVERTER_STMT_JOIN                = 'STMT_JOIN';
    const CONVERTER_STMT_JOIN_ITEMS          = 'STMT_JOIN_ITEMS';
    const CONVERTER_STMT_LIMIT               = 'STMT_LIMIT';
    const CONVERTER_STMT_ORDER_BY            = 'STMT_ORDER_BY';
    const CONVERTER_STMT_ORDER_BY_ITEMS      = 'STMT_ORDER_BY_ITEMS';
    const CONVERTER_STMT_SELECT              = 'STMT_SELECT';
    const CONVERTER_STMT_SET                 = 'STMT_SET';
    const CONVERTER_STMT_UPDATE              = 'STMT_UPDATE';
    const CONVERTER_STMT_WHERE               = 'STMT_WHERE';

    /**
     * @param NodeInterface     $node
     * @param ProviderInterface $provider
     *
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider);

    /**
     * @param NodeInterface     $node
     * @param ProviderInterface $provider
     * @return array
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider);

    /**
     * @param array             $ast
     * @param ProviderInterface $provider
     * @return NodeInterface
     */
    public function toNode(array $ast, ProviderInterface $provider);

    /**
     * @return string
     */
    public function getName();

}