<?php

use Subapp\Sql\Ast\Literal;
use Subapp\Sql\Lexer\Lexer;

include_once __DIR__ . '/../vendor/autoload.php';

$sqlVersion = 'SelectWhere';

$sql = file_get_contents(sprintf('%s/sql/%s.sql', __DIR__, $sqlVersion));

$lexer = new Lexer();

$lexer->setInput($sql);

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

$lexer->rewind();

$processor = new \Subapp\Sql\Syntax\Processor($lexer, new Subapp\Sql\Platform\MySQLPlatform());
$processor->setup(new \Subapp\Sql\Syntax\MySQL\MySQLParserSetup());

try {
    /** @var \Subapp\Sql\Ast\Statement\Select $select */
    $time = microtime(true);
    $select = $processor->parse();
    $parseTime = microtime(true) - $time;
    
    $renderer = new \Subapp\Sql\Render\Renderer();
    $renderer->setup(new \Subapp\Sql\Render\MySQL\MySQLRendererSetup());
    
//    $select->setPrimaryTable('test');
//    $select->getVariables()->append(new Literal(3.14, Literal::STRING));

//    var_dump($select);
    $time = microtime(true);
    echo "\n====== SELECT AST Render ======\n";
    echo $renderer->render($select);
    echo PHP_EOL;
    echo sprintf('Render: %s', microtime(true) - $time);
    echo PHP_EOL;
    echo sprintf('Parser: %s', $parseTime);


//    $query = new \Subapp\Sql\Ast\Statement\Select();
//    $query->setPrimaryTable('test');
//
//    echo "\n====== SELECT AST Render ======\n";
//    echo $renderer->render($query);
    
    echo "\n\n\n";
    
} catch (\Throwable $exception) {
    die(sprintf("\n-----------------\n[%s]: %s\n%s\n-----------------\n", get_class($exception), $exception->getMessage(), $exception->getTraceAsString()));
}