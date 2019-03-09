<?php

namespace Subapp\Sql\Lexer;

use Subapp\Lexer\AbstractLexer;

/**
 * Class AbstractSqlLexer
 * @package Subapp\Sql\Query
 */
abstract class AbstractSqlLexer extends AbstractLexer
{
    
    const T_UNKNOWN = 1;
    
    const T_AT                = 1000;
    const T_HASH              = 1010;
    const T_EQ                = 1020;
    const T_NE                = 1030;
    const T_GT                = 1040;
    const T_GE                = 1050;
    const T_LT                = 1060;
    const T_LE                = 1070;
    const T_MINUS             = 1080;
    const T_PLUS              = 1090;
    const T_DIVIDE            = 1100;
    const T_MULTIPLY          = 1110;
    const T_DOT               = 1120;
    const T_COMMA             = 1130;
    const T_NEGATE            = 1140;
    const T_QUESTION          = 1150;
    const T_BACKSLASH         = 1160;
    const T_VERTICAL_SLASH    = 1170;
    const T_AMPERSAND         = 1180;
    const T_COLON             = 1190;
    const T_SEMICOLON         = 1200;
    const T_GRAVE_ACCENT      = 1210;
    const T_OPEN_BRACE        = 1220;
    const T_OPEN_CURLY_BRACE  = 1230;
    const T_CLOSE_BRACE       = 1240;
    const T_CLOSE_CURLY_BRACE = 1250;
    const T_TILDA             = 1300;
    
    const T_STRING = 500;
    const T_INT    = 510;
    const T_FLOAT  = 520;


    const T_AGAINST       = 1990;
    const T_ALL           = 2000;
    const T_AND           = 2010;
    const T_AS            = 2020;
    const T_ASC           = 2030;
    const T_BETWEEN       = 2040;
    const T_BY            = 2050;
    const T_DELAYED       = 2060;
    const T_DELETE        = 2070;
    const T_DESC          = 2080;
    const T_DISTINCT      = 2090;
    const T_EXPLAIN       = 2100;
    const T_FALSE         = 2110;
    const T_FROM          = 2120;
    const T_GROUP         = 2130;
    const T_HAVING        = 2140;
    const T_IGNORE        = 2150;
    const T_IN            = 2160;
    const T_INNER         = 2170;
    const T_INSERT        = 2180;
    const T_INTO          = 2190;
    const T_IS            = 2200;
    const T_JOIN          = 2210;
    const T_LEFT          = 2220;
    const T_LIKE          = 2230;
    const T_LIMIT         = 2240;
    const T_MATCH         = 2245;
    const T_NOT           = 2250;
    const T_NULL          = 2260;
    const T_ON            = 2270;
    const T_OR            = 2280;
    const T_ORDER         = 2290;
    const T_OUTER         = 2300;
    const T_RIGHT         = 2310;
    const T_SELECT        = 2320;
    const T_SET           = 2325;
    const T_STRAIGHT_JOIN = 2330;
    const T_TABLE         = 2340;
    const T_TRUE          = 2350;
    const T_UPDATE        = 2360;
    const T_USING         = 2370;
    const T_VALUES        = 2380;
    const T_WHERE         = 2390;
    const T_XOR           = 2400;
    
    const T_IDENTIFIER      = 4000;
    const T_MODIFIER        = 5000;
    
    /**
     * @var array
     */
    protected $characters = [
        '~' => AbstractSqlLexer::T_TILDA,
        '@' => AbstractSqlLexer::T_AT,
        '#' => AbstractSqlLexer::T_HASH,
        '=' => AbstractSqlLexer::T_EQ,
        '!=' => AbstractSqlLexer::T_NE,
        '<>' => AbstractSqlLexer::T_NE,
        '>' => AbstractSqlLexer::T_GT,
        '>=' => AbstractSqlLexer::T_GE,
        '<' => AbstractSqlLexer::T_LT,
        '<=' => AbstractSqlLexer::T_LE,
        '-' => AbstractSqlLexer::T_MINUS,
        '+' => AbstractSqlLexer::T_PLUS,
        '/' => AbstractSqlLexer::T_DIVIDE,
        '*' => AbstractSqlLexer::T_MULTIPLY,
        '.' => AbstractSqlLexer::T_DOT,
        ',' => AbstractSqlLexer::T_COMMA,
        '!' => AbstractSqlLexer::T_NEGATE,
        '?' => AbstractSqlLexer::T_QUESTION,
        '\\' => AbstractSqlLexer::T_BACKSLASH,
        '|' => AbstractSqlLexer::T_VERTICAL_SLASH,
        '&' => AbstractSqlLexer::T_AMPERSAND,
        ':' => AbstractSqlLexer::T_COLON,
        ';' => AbstractSqlLexer::T_SEMICOLON,
        '`' => AbstractSqlLexer::T_GRAVE_ACCENT,
        '(' => AbstractSqlLexer::T_OPEN_BRACE,
        '{' => AbstractSqlLexer::T_OPEN_CURLY_BRACE,
        ')' => AbstractSqlLexer::T_CLOSE_BRACE,
        '}' => AbstractSqlLexer::T_CLOSE_CURLY_BRACE,
        
        '&&' => AbstractSqlLexer::T_AND,
        '||' => AbstractSqlLexer::T_OR,
        
        'AGAINST' => AbstractSqlLexer::T_AGAINST,
        'ALL' => AbstractSqlLexer::T_ALL,
        'AND' => AbstractSqlLexer::T_AND,
        'AS' => AbstractSqlLexer::T_AS,
        'ASC' => AbstractSqlLexer::T_ASC,
        'BETWEEN' => AbstractSqlLexer::T_BETWEEN,
        'BY' => AbstractSqlLexer::T_BY,
        'DELETE' => AbstractSqlLexer::T_DELETE,
        'DESC' => AbstractSqlLexer::T_DESC,
        'DISTINCT' => AbstractSqlLexer::T_DISTINCT,
        'EXPLAIN' => AbstractSqlLexer::T_EXPLAIN,
        'FALSE' => AbstractSqlLexer::T_FALSE,
        'FROM' => AbstractSqlLexer::T_FROM,
        'GROUP' => AbstractSqlLexer::T_GROUP,
        'HAVING' => AbstractSqlLexer::T_HAVING,
        'IN' => AbstractSqlLexer::T_IN,
        'INNER' => AbstractSqlLexer::T_INNER,
        'INSERT' => AbstractSqlLexer::T_INSERT,
        'INTO' => AbstractSqlLexer::T_INTO,
        'IS' => AbstractSqlLexer::T_IS,
        'JOIN' => AbstractSqlLexer::T_JOIN,
        'LEFT' => AbstractSqlLexer::T_LEFT,
        'LIKE' => AbstractSqlLexer::T_LIKE,
        'LIMIT' => AbstractSqlLexer::T_LIMIT,
        'MATCH' => AbstractSqlLexer::T_MATCH,
        'NOT' => AbstractSqlLexer::T_NOT,
        'NULL' => AbstractSqlLexer::T_NULL,
        'ON' => AbstractSqlLexer::T_ON,
        'OR' => AbstractSqlLexer::T_OR,
        'ORDER' => AbstractSqlLexer::T_ORDER,
        'OUTER' => AbstractSqlLexer::T_OUTER,
        'RIGHT' => AbstractSqlLexer::T_RIGHT,
        'SELECT' => AbstractSqlLexer::T_SELECT,
        'SET' => AbstractSqlLexer::T_SET,
        'STRAIGHT_JOIN' => AbstractSqlLexer::T_STRAIGHT_JOIN,
        'TABLE' => AbstractSqlLexer::T_TABLE,
        'TRUE' => AbstractSqlLexer::T_TRUE,
        'UPDATE' => AbstractSqlLexer::T_UPDATE,
        'USING' => AbstractSqlLexer::T_USING,
        'VALUES' => AbstractSqlLexer::T_VALUES,
        'WHERE' => AbstractSqlLexer::T_WHERE,
        'XOR' => AbstractSqlLexer::T_XOR,
        
        'LOW_PRIORITY' => AbstractSqlLexer::T_MODIFIER,
        'HIGH_PRIORITY' => AbstractSqlLexer::T_MODIFIER,
        'DELAYED' => AbstractSqlLexer::T_MODIFIER,
        'IGNORE' => AbstractSqlLexer::T_MODIFIER,
        'DISTINCTROW' => AbstractSqlLexer::T_MODIFIER,
        'SQL_SMALL_RESULT' => AbstractSqlLexer::T_MODIFIER,
        'SQL_BIG_RESULT' => AbstractSqlLexer::T_MODIFIER,
        'SQL_BUFFER_RESULT' => AbstractSqlLexer::T_MODIFIER,
        'SQL_CACHE' => AbstractSqlLexer::T_MODIFIER,
        'SQL_NO_CACHE' => AbstractSqlLexer::T_MODIFIER,
        'SQL_CALC_FOUND_ROWS' => AbstractSqlLexer::T_MODIFIER,
        'QUICK' => AbstractSqlLexer::T_MODIFIER,
    ];
    
    /**
     * @param $character
     * @return integer|null
     */
    protected function getTokenCharacterType($character)
    {
        $character = strtoupper($character);
        
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