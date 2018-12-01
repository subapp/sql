<?php

namespace Subapp\Sql\Converter;

use Subapp\Sql\Ast\NodeInterface;

/**
 * Interface ConverterInterface
 * @package Subapp\Sql\Converter
 */
interface ConverterInterface
{

    const CONVERTER_ARGS                     = 1100;
    const CONVERTER_ARITHMETIC               = 1110;
    const CONVERTER_ASSIGNMENT               = 1115;
    const CONVERTER_COLLECTION               = 1120;
    const CONVERTER_EMBRACE                  = 1130;
    const CONVERTER_FIELD_PATH               = 1140;
    const CONVERTER_IDENTIFIER               = 1150;
    const CONVERTER_LITERAL                  = 1160;
    const CONVERTER_MATH_OPERATOR            = 1170;
    const CONVERTER_PARAMETER                = 1180;
    const CONVERTER_QUOTE_IDENTIFIER         = 1190;
    const CONVERTER_RAW                      = 1200;
    const CONVERTER_VARIABLE                 = 1210;
    const CONVERTER_CONDITION_BETWEEN        = 1220;
    const CONVERTER_CONDITION_CMP            = 1230;
    const CONVERTER_CONDITION_CONDITIONS     = 1240;
    const CONVERTER_CONDITION_IN             = 1250;
    const CONVERTER_CONDITION_IS_NULL        = 1260;
    const CONVERTER_CONDITION_LIKE           = 1270;
    const CONVERTER_CONDITION_LOGIC_OPERATOR = 1280;
    const CONVERTER_CONDITION_CMP_OPERATOR   = 1290;
    const CONVERTER_FUNC_AGGREGATE           = 1300;
    const CONVERTER_FUNC_DEFAULT             = 1310;
    const CONVERTER_MATCH_AGAINST            = 1312;
    const CONVERTER_MODIFIERS                = 1315;
    const CONVERTER_STMT_DELETE              = 1320;
    const CONVERTER_STMT_TABLE_REFERENCE     = 1330;
    const CONVERTER_STMT_GROUP_BY            = 1340;
    const CONVERTER_STMT_HAVING              = 1350;
    const CONVERTER_STMT_JOIN                = 1360;
    const CONVERTER_STMT_JOIN_ITEMS          = 1370;
    const CONVERTER_STMT_LIMIT               = 1380;
    const CONVERTER_STMT_ORDER_BY            = 1390;
    const CONVERTER_STMT_ORDER_BY_ITEMS      = 1400;
    const CONVERTER_STMT_SELECT              = 1410;
    const CONVERTER_STMT_UPDATE              = 1420;
    const CONVERTER_STMT_WHERE               = 1430;

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