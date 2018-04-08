<?php


require __DIR__ . '/vendor/autoload.php';
$app = new Slim\App;
$app->get('/', function ($request, $response)
{
  return 'Halo Semuaaaanyaa!!!';
});

$app->get('/forum/{title}/{user}', function ($request, $response, $args)
{
  //die(var_dump($args));
  return $args['title'].' ditulis oleh '.$args['user'];
});

$app->run();
?>
