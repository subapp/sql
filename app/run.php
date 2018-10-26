<?php

use Subapp\Sql\Parser\Query\SqlLexer;

include_once __DIR__ . '/../vendor/autoload.php';

$sqlVersion = '0001';

$sql = file_get_contents(sprintf('%s/sql/%s.sql', __DIR__, $sqlVersion));

$lexer = new SqlLexer();

$lexer->setInput($sql);

echo PHP_EOL;

//die(var_dump($lexer));

echo "====== SQL ======\n";
echo $sql;

echo "\n====== Tokens ======\n";

/** @var \Subapp\Lexer\TokenInterface $token */
foreach ($lexer as $token) {
    echo sprintf('%s ', $lexer->getConstantName($token->getType()));
}

echo "\n====== Tokens ID ======\n";

/** @var \Subapp\Lexer\TokenInterface $token */
foreach ($lexer as $token) {
    echo sprintf('%s ', $token->getType());
}

echo "\n====== SQL In Buffer ======\n";

/** @var \Subapp\Lexer\TokenInterface $token */
$tokens = array_map(function (\Subapp\Lexer\TokenInterface $token){
    return $token->getToken();
}, $lexer->getTokens());

echo sprintf('[%s]', implode('_', $tokens));

//var_dump($lexer);