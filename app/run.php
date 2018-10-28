<?php

use Subapp\Sql\Lexer\Lexer;

include_once __DIR__ . '/../vendor/autoload.php';

$sqlVersion = '0002';

$sql = file_get_contents(sprintf('%s/sql/%s.sql', __DIR__, $sqlVersion));

$lexer = new Lexer();

$lexer->setInput($sql);

echo PHP_EOL;

//die(var_dump($lexer));

echo "====== SQL ======\n";
echo $sql;

echo "\n====== Tokens ======\n";

/** @var \Subapp\Lexer\TokenInterface $token */
foreach ($lexer as $token) {
    echo sprintf('%s ', $lexer->getConstantName($token->getType())) . PHP_EOL;
}

$lexer->rewind();

$trimFunction = new \Subapp\Sql\Parser\Func\TrimFunctionParser();
var_dump($trimFunction->isFunction($lexer));
$trimFunction->parse($lexer);
