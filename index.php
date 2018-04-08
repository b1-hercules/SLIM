<?php


require __DIR__ . '/vendor/autoload.php';
$app = new Slim\App(['settings'=> ['displayErrorDetails'=> true]]);

$container = $app->getContainer();

// $container['hello'] = function()
// {
//   echo "Bung!!!";
// };
// Register component on container
//container untuk View
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig( __DIR__ . '/templates', [ 'cache' => false ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

//container untuk database
$container['db'] = function ()
{
  return new PDO('mysql:host=localhost;dbname=tutorial','root','');
};

//Container untuk not found handler
$container['notFoundHandler'] = function($container){
    return function ($request, $response) use ($container)
    {
      return $container['response']
      ->withStatus(404)
      ->withHeader('Content-Type','text/html')
      ->write('halaman tidak ditemukan');
    };
};

$app->get('/', function ($request, $response)
{
  return $this->view->render($response, 'home.twig ');
  // $this->hello;
});

$app->get('/forum', function ($request, $response, $args)
{

$datas = $this->db->query("SELECT * FROM forum")->fetchAll(PDO::FETCH_OBJ);


  return $this->view->render($response, 'forum.twig', [
      // 'title' => $args['title']
      'forum'=>$datas
  ]);
  // $this->hello;
})->setName('single');

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
