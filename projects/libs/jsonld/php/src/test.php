<?php
require_once './Term.php';
require_once './Context.php';

$t1 = new Term();
$t1->name = 'foo';
$t1->id = 'http://yahoo.com';

$t2 = new Term();
$t2->name = 'image';
$t2->id = 'http://google.com';
$t2->type = '@id';

$t3 = new Term();
$ctx = new Context();

$ctx->addTerm($t1);
$ctx->addTerm($t2);


print_r(json_encode($ctx->toArray(), JSON_PRETTY_PRINT));