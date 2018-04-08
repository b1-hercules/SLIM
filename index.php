<?php


require __DIR__ . '/vendor/autoload.php';
$app = new Slim\App;

$container = $app->getContainer();

// $container['hello'] = function()
// {
//   echo "Bung!!!";
// };
// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig( __DIR__ . '/templates', [
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

$app->get('/', function ($request, $response)
{
  return $this->view->render($response, 'home.twig ');
  // $this->hello;
});

//{
//
//   $data = array(
//           'nama' => 'iqbal',
//           'age' => 20
//
//   );
//
//
//
//   return $response->withJson($data, 404);
// });

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
