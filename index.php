<?php


require __DIR__ . '/vendor/autoload.php';
$app = new Slim\App;
$app->get('/', function ($request, $response)
{
  die(var_dump($request->getHeaders()));
  return $request->getHeaders();
});

// $app->get('/forum[/{title}]', function ($request, $response, $args)
// {
//   //die(var_dump($args));
//   if (empty($args)) {
//     echo "ini halaman index forum";
//   }else {
//     return $args['title'];
//   }
// });

$app->run();
?>
