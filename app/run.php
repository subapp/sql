<?php

use Subapp\Sql\Ast\Condition\Operator;
use Subapp\Sql\Ast\Condition\Conditions;
use Subapp\Sql\Ast\Literal;
use Subapp\Sql\Ast\MathOperator;
use Subapp\Sql\Lexer\Lexer;

include_once __DIR__ . '/../vendor/autoload.php';

$sqlVersion = '0001';

$sql = file_get_contents(sprintf('%s/sql/%s.sql', __DIR__, $sqlVersion));

$lexer = new Lexer();

$lexer->tokenize($sql);

echo PHP_EOL;

//die(var_dump($lexer));

echo "====== SQL ======\n";
echo preg_replace('/\s+/ui', ' ', $sql);

echo "\n====== Tokens ======\n";

$counter = 0;

/** @var \Subapp\Lexer\TokenInterface $token */
//foreach ($lexer as $token) {
//    echo sprintf('%s("%s")%s', $lexer->getConstantName($token->getType()), $token->getToken(), "\t")
//        . ($counter++ % 5 === 0 ? PHP_EOL : null);
//}

echo "Tokens: " . count($lexer->getTokens()) . PHP_EOL;

$eb = new \Subapp\Sql\Query\ExpressionBuilder();

$lexer->rewind();

$processor = new \Subapp\Sql\Syntax\Processor($lexer, new Subapp\Sql\Platform\MySQLPlatform());
$processor->setup(new \Subapp\Sql\Syntax\Common\DefaultParserSetup());

try {
    /** @var \Subapp\Sql\Ast\Stmt\Select $select */
    $time = microtime(true);
    $select = $processor->parse();
    $parseTime = microtime(true) - $time;

    var_dump($select);
    
    $renderer = new \Subapp\Sql\Render\Renderer();
    $renderer->setup(new \Subapp\Sql\Render\Common\DefaultRendererSetup());

    $time = microtime(true);
    echo "\n====== SELECT AST Render ======\n";
    echo $renderer->render($select);
    echo PHP_EOL;
    echo sprintf('Render: %s', microtime(true) - $time);
    echo PHP_EOL;
    echo sprintf('Parser: %s', $parseTime);
    echo PHP_EOL;
    
    $lexer = new Lexer();
    
    $lexer->tokenize('6 + 1', true);
    
    $parser = new \Subapp\Sql\Syntax\Common\Parser\Complex();
    
    var_dump($renderer->render($parser->parse($lexer, $processor)));
    
    var_dump(
        $renderer->render($eb->false()),
        $renderer->render($eb->and($eb->eq(1, 2), $eb->eq(3.14, $eb->arithmetic(22, MathOperator::DIVIDE, 7))))
    );
    
    echo "\n\n\n";
    
} catch (\Throwable $exception) {
    die(sprintf("\n-----------------\n[%s]: %s\n%s\n-----------------\n", get_class($exception), $exception->getMessage(), $exception->getTraceAsString()));
}