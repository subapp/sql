<?php

use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Platform\MySQLPlatform;
use Subapp\Sql\Render\Common\DefaultRendererSetup;
use Subapp\Sql\Render\Renderer;
use Subapp\Sql\Syntax\Common\DefaultParserSetup;
use Subapp\Sql\Syntax\Processor;

include_once __DIR__ . '/../vendor/autoload.php';

$lexer = new Lexer();

$math = [
//    '(t0.cnt / 10 - 3) + 1 = sum(distinct u.cnt)',
//    '(t0.id + 1 <= t1.subId OR t1.id >= 1)',
//    '((((t0.cnt / 10 - 3 + 1)))) = sum(distinct u.cnt)',
//    'id > 0',
    'sum(distinct u.cnt) + 1 = sum(distinct u.cnt)',
//    '(t0.cnt / 10 - 3) + 1 = sum(distinct u.cnt)',
    't.id + 1 > 1 or t.id < 10 and a.id > 0',
    '(t.id + 1 > 1 or t.id < 10) and a > 0',
    '(t.id > 1 and t.id < 10)',
    '(t.id + 1 > 10 and t.id < 100)',
    '(t.id > 1)',
    '(t.id > 1) and a > 0',
    '(t.id + 1 > 10) and a > 0',
];



$processor = new Processor($lexer, new MySQLPlatform());
$processor->setup(new DefaultParserSetup());

$renderer = new Renderer();
$renderer->setup(new DefaultRendererSetup());

$operators = [Lexer::T_PLUS, Lexer::T_MINUS, Lexer::T_MULTIPLY, Lexer::T_DIVIDE,];
$parser = new \Subapp\Sql\Syntax\Common\Parser\Condition\Condition();

foreach ($math as $expression) {
    
    $lexer->tokenize($expression, true);
    $lexer->rewind();

    echo sprintf("raw: %s; rendered: %s;\n", $expression, $renderer->render($parser->parse($lexer, $processor)));
    
    /*var_dump([
        'isTokenBetweenBraces' => $parser->isTokenBetweenBraces($lexer, true, ...$operators),
        'isTokenBehindBraces' => $parser->isTokenBehindBraces($lexer, true, ...$operators),
        'isTokenBehindExpression' => $parser->isTokenBehindExpression($lexer, true, ...$operators),
        'isMathExpression' => $parser->isMathExpression($lexer),
        'isLogicalExpression' => $parser->isLogicalExpression($lexer),

    ]);*/
}

