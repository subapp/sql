<?php

namespace Subapp\Sql\Parser\Query;

use Subapp\Lexer\AbstractLexer;

/**
 * Class AbstractSqlLexer
 * @package Subapp\Sql\Parser\Query
 */
abstract class AbstractSqlLexer extends AbstractLexer
{

    const T_UNKNOWN = 1;

    const T_AT = 101;
    const T_HASH = 102;
    const T_EQ = 103;
    const T_GT = 104;
    const T_LT = 105;
    const T_MINUS = 106;
    const T_PLUS = 107;
    const T_DIVIDE = 108;
    const T_MULTIPLY = 109;
    const T_DOT = 110;
    const T_COMMA = 111;
    const T_NEGATE = 112;
    const T_QUESTION = 113;
    const T_BACKSLASH = 114;
    const T_VERTICAL_SLASH = 115;
    const T_COLON = 116;
    const T_SEMICOLON = 117;
    const T_GRAVE_ACCENT = 118;
    const T_OPEN_BRACE = 119;
    const T_OPEN_CURLY_BRACE = 120;
    const T_CLOSE_BRACE = 121;
    const T_CLOSE_CURLY_BRACE = 122;

    const T_STRING = 500;
    const T_INT = 510;
    const T_FLOAT = 520;

    const T_SELECT = 1000;
    const T_UPDATE = 1010;
    const T_INSERT = 1020;
    const T_DELETE = 1030;
    const T_FROM = 1032;
    const T_TABLE = 1034;
    const T_DISTINCT = 1040;
    const T_HAVING = 1050;
    const T_IN = 1060;
    const T_DELAYED = 1070;
    const T_IGNORE = 1080;
    const T_INTO = 1090;
    const T_STRAIGHT_JOIN = 1100;
    const T_AS = 1110;
    const T_INNER = 1120;
    const T_LEFT = 1130;
    const T_RIGHT = 1140;
    const T_OUTER = 1150;
    const T_JOIN = 1160;
    const T_ON = 1170;
    const T_NULL = 1180;
    const T_VALUES = 1190;
    const T_WHERE = 1200;
    const T_OR = 1210;
    const T_XOR = 1220;
    const T_AND = 1230;
    const T_BETWEEN = 1240;
    const T_IS = 1250;
    const T_LIKE = 1260;
    const T_NOT = 1270;
    const T_ALL = 1280;
    const T_FALSE = 1290;
    const T_TRUE = 1300;
    const T_GROUP = 1310;
    const T_BY = 1320;
    const T_ORDER = 1330;
    const T_ASC = 1340;
    const T_DESC = 1350;
    const T_LIMIT = 1360;

    const T_EXPLAIN = 2000;

    const T_SQL_CALC_FOUND_ROWS = 3010;
    const T_SQL_BIG_RESULT = 3020;
    const T_SQL_SMALL_RESULT = 3030;

    const T_IDENTIFIER = 4000;

    /**
     * @var array
     */
    protected $characters = [
        '@'     => AbstractSqlLexer::T_AT,
        '#'     => AbstractSqlLexer::T_HASH,
        '='     => AbstractSqlLexer::T_EQ,
        '>'     => AbstractSqlLexer::T_GT,
        '<'     => AbstractSqlLexer::T_LT,
        '-'     => AbstractSqlLexer::T_MINUS,
        '+'     => AbstractSqlLexer::T_PLUS,
        '/'     => AbstractSqlLexer::T_DIVIDE,
        '*'     => AbstractSqlLexer::T_MULTIPLY,
        '.'     => AbstractSqlLexer::T_DOT,
        ','     => AbstractSqlLexer::T_COMMA,
        '!'     => AbstractSqlLexer::T_NEGATE,
        '?'     => AbstractSqlLexer::T_QUESTION,
        '\\'    => AbstractSqlLexer::T_BACKSLASH,
        '|'     => AbstractSqlLexer::T_VERTICAL_SLASH,
        ':'     => AbstractSqlLexer::T_COLON,
        ';'     => AbstractSqlLexer::T_SEMICOLON,
        '`'     => AbstractSqlLexer::T_GRAVE_ACCENT,
        '('     => AbstractSqlLexer::T_OPEN_BRACE,
        '{'     => AbstractSqlLexer::T_OPEN_CURLY_BRACE,
        ')'     => AbstractSqlLexer::T_CLOSE_BRACE,
        '}'     => AbstractSqlLexer::T_CLOSE_CURLY_BRACE,

        'SELECT'        => AbstractSqlLexer::T_SELECT,
        'UPDATE'        => AbstractSqlLexer::T_UPDATE,
        'INSERT'        => AbstractSqlLexer::T_INSERT,
        'DELETE'        => AbstractSqlLexer::T_DELETE,
        'TABLE'         => AbstractSqlLexer::T_TABLE,
        'FROM'          => AbstractSqlLexer::T_FROM,
        'DISTINCT'      => AbstractSqlLexer::T_DISTINCT,
        'HAVING'        => AbstractSqlLexer::T_HAVING,
        'IN'            => AbstractSqlLexer::T_IN,
        'DELAYED'       => AbstractSqlLexer::T_DELAYED,
        'IGNORE'        => AbstractSqlLexer::T_IGNORE,
        'INTO'          => AbstractSqlLexer::T_INTO,
        'STRAIGHT_JOIN' => AbstractSqlLexer::T_STRAIGHT_JOIN,
        'AS'            => AbstractSqlLexer::T_AS,
        'INNER'         => AbstractSqlLexer::T_INNER,
        'LEFT'          => AbstractSqlLexer::T_LEFT,
        'RIGHT'         => AbstractSqlLexer::T_RIGHT,
        'OUTER'         => AbstractSqlLexer::T_OUTER,
        'JOIN'          => AbstractSqlLexer::T_JOIN,
        'ON'            => AbstractSqlLexer::T_ON,
        'NULL'          => AbstractSqlLexer::T_NULL,
        'VALUES'        => AbstractSqlLexer::T_VALUES,
        'WHERE'         => AbstractSqlLexer::T_WHERE,
        'OR'            => AbstractSqlLexer::T_OR,
        'XOR'           => AbstractSqlLexer::T_XOR,
        'AND'           => AbstractSqlLexer::T_AND,
        'BETWEEN'       => AbstractSqlLexer::T_BETWEEN,
        'IS'            => AbstractSqlLexer::T_IS,
        'LIKE'          => AbstractSqlLexer::T_LIKE,
        'NOT'           => AbstractSqlLexer::T_NOT,
        'ALL'           => AbstractSqlLexer::T_ALL,
        'FALSE'         => AbstractSqlLexer::T_FALSE,
        'TRUE'          => AbstractSqlLexer::T_TRUE,
        'GROUP'         => AbstractSqlLexer::T_GROUP,
        'BY'            => AbstractSqlLexer::T_BY,
        'ORDER'         => AbstractSqlLexer::T_ORDER,
        'ASC'           => AbstractSqlLexer::T_ASC,
        'DESC'          => AbstractSqlLexer::T_DESC,
        'LIMIT'         => AbstractSqlLexer::T_LIMIT,
        'EXPLAIN'       => AbstractSqlLexer::T_EXPLAIN,

        'SQL_CALC_FOUND_ROWS'   => AbstractSqlLexer::T_SQL_CALC_FOUND_ROWS,
        'SQL_BIG_RESULT'        => AbstractSqlLexer::T_SQL_BIG_RESULT,
        'SQL_SMALL_RESULT'      => AbstractSqlLexer::T_SQL_SMALL_RESULT,
    ];

    /**
     * @param $character
     * @return integer|null
     */
    protected function getTokenCharacterType($character)
    {
        $character = ctype_alpha($character) ? strtoupper($character) : $character;

        return isset($this->characters[$character]) ? $this->characters[$character] : null;
    }

    /**
     * @param $token
     * @return string
     */
    public function getConstantName($token)
    {
        list(, $constant) = explode('::', parent::getLiteral($token));

        return $constant;
    }

    /**
     * @param $token
     * @return mixed
     */
    public function getLiteral($token)
    {
        return str_replace(__NAMESPACE__ . '\\', null, parent::getLiteral($token));
    }

    /**
     * @return array
     */
    function __debugInfo()
    {
        $tokens = [];

        foreach ($this->getTokens() as $token) {
            $tokens[] = sprintf('%s: \'%s\' on position: %d',
                $this->getLiteral($token->getType()), $token->getToken(), $token->getPosition());
        }

        return [
            'count' => count($tokens),
            'collection' => $tokens,
        ];
    }

}