<?php


require __DIR__ . '/vendor/autoload.php';
$app = new Slim\App;
$app->get('/', function ($request, $response)
{

  $data = array(
          'nama' => 'iqbal',
          'age' => 20

  );



  return $response->withJson($data, 404);
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
