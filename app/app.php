<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_db';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();


    //Home page
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array(
            'stylists' => Stylist::getAll(),
        ));
    });



    
    return $app;
 ?>
