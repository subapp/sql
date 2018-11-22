<?php

use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Platform\MySQLPlatform;
use Subapp\Sql\Converter\Common\DefaultRepresenterSetup;
use Subapp\Sql\Converter\Representer;
use Subapp\Sql\Syntax\Common\DefaultParserSetup;
use Subapp\Sql\Syntax\Processor;

include_once __DIR__ . '/../vendor/autoload.php';

$lexer = new Lexer();

$expression1 = "(c < 300 OR f = 10 OR e = 100) 
AND (

u.id1 < 100 
AND u.create >= 1000000 
AND u.ia <= 100500 
OR activities.orderby = 1 
AND activities.starttime >= '2013-08-26 04:00:00' 
AND activities.endtime <= '2013-08-27 04:00:00'
OR u.login_cnt >= 10 + SQRT(2 / 3 * RAND(100)) * 123 + 777 / COUNT(s.id) + SUM(s.balance) * SUM(u.test) / 2 + 1

)";

$conditions = [
    $expression1,
    'a > 1 OR u.login_cnt > 10 + SQRT(2 / 3 * RAND(100)) * 123 + 777 / COUNT(s.id) + SUM(s.balance) * SUM(u.test) / 2 + 1)',
    '(t0.id + 1 <= t1.subId OR t1.id >= 1) || ((((a > 1))) and b > 10) or (a > 1) or (a + 1 > 1)',
    '(t0.cnt / 10 - 3) + 1 = sum(distinct u.cnt)',
    '(t0.cnt / 10 + 3) = 1',
    '((((t0.cnt / 10 - 3 + 1 > 1)))) and a = sum(distinct u.cnt)',
    '(t0.cnt / 10 - 3) + 1 = sum(distinct u.cnt)',
    'id > 0',
    'sum(distinct u.cnt) + 1 = sum(distinct u.cnt)',
    't.id + 1 > 1 or t.id < 10 and a.id > 0',
    '(t.id + 1 > 1 or t.id < 10) and a > 0',
    '(t.id > 1 and t.id < 10)',
    '(t.id + 1 > 10 and t.id < 100)',
    '(t.id > 1)',
    '(t.id > 1) and a > 0',
    '(t.id + 1 > 10) and (a > 0 and b < 10) or a is null',
];



$processor = new Processor($lexer, new MySQLPlatform());
$processor->setup(new DefaultParserSetup());

$renderer = new Representer();
$renderer->setup(new DefaultRepresenterSetup());

$operators = [Lexer::T_PLUS, Lexer::T_MINUS, Lexer::T_MULTIPLY, Lexer::T_DIVIDE,];
$parser = new \Subapp\Sql\Syntax\Common\Parser\Condition\Conditional();

$math = new \Subapp\Sql\Syntax\Common\Parser\Arithmetic();

foreach ($conditions as $expression) {
    
    $lexer->tokenize($expression, true);
    $lexer->rewind();

    echo sprintf("raw: %s; rendered: %s;\n", $expression, $renderer->toSql($parser->parse($lexer, $processor)));
    
    /*var_dump([
        'isTokenBetweenBraces' => $parser->isTokenBetweenBraces($lexer, true, ...$operators),
        'isTokenBehindBraces' => $parser->isTokenBehindBraces($lexer, true, ...$operators),
        'isTokenBehindExpression' => $parser->isTokenBehindExpression($lexer, true, ...$operators),
        'isMathExpression' => $parser->isMathExpression($lexer),
        'isLogicalExpression' => $parser->isLogicalExpression($lexer),

    ]);*/
}

