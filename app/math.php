<?php

use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Platform\MySQLPlatform;
use Subapp\Sql\Render\Common\DefaultRendererSetup;
use Subapp\Sql\Render\Renderer;
use Subapp\Sql\Syntax\Common\DefaultParserSetup;
use Subapp\Sql\Syntax\Processor;

include_once __DIR__ . '/../vendor/autoload.php';

$lexer = new Lexer();
$math = '(t0.cnt / 10 + 3 > 1)';
$lexer->tokenize($math, true);

$lexer->rewind();

$processor = new Processor($lexer, new MySQLPlatform());
$processor->setup(new DefaultParserSetup());

$renderer = new Renderer();
$renderer->setup(new DefaultRendererSetup());

$operators = [Lexer::T_PLUS, Lexer::T_MINUS, Lexer::T_MULTIPLY, Lexer::T_DIVIDE,];
$parser = new \Subapp\Sql\Syntax\Common\Parser\Condition\Condition();

var_dump([
    'isTokenBetweenBraces' => $parser->isTokenBetweenBraces($lexer, true, ...$operators),
    'isTokenBehindBraces' => $parser->isTokenBehindBraces($lexer, true, ...$operators),
    'isTokenBehindExpression' => $parser->isTokenBehindExpression($lexer, true, ...$operators),
    'isMathExpression' => $parser->isMathExpression($lexer),
//    $parser->parse($lexer, $processor),
    $renderer->render($parser->parse($lexer, $processor)),
]);