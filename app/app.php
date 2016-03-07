<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
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
    //Add a Stylist
    $app->post("/", function() use ($app) {
        $new_stylist = new Stylist($_POST['stylist-name']);
        $new_stylist->save();
        return $app['twig']->render('index.html.twig', array(
            'stylists' => Stylist::getAll()
        ));
    });
    //Delete all stylists
    $app->delete("/deleteAll", function() use ($app) {
        Stylist::deleteAll();
        return $app['twig']->render('index.html.twig', array(
            'stylists' => Stylist::getAll()
        ));
    });
    //Single Stylist Info
    $app->get("/stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist.html.twig', array(
            'stylist' => $stylist,
            'clients' => $stylist->getClients()
        ));
    });
    //Select Stylist to Edit
    $app->get("/stylist/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist_edit.html.twig', array(
            'stylist' => $stylist
        ));
    });
    //update a stylist's name
    $app->patch("/stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->update($_POST['new-name']);
        return $app['twig']->render('stylist.html.twig', array(
            'stylist' => $stylist,
            'clients' => $stylist->getClients()
        ));
    });
    //select stylist to delete
    $app->get("/stylist/{id}/delete", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist_delete.html.twig', array(
            'stylist' => $stylist
        ));
    });
    //delete stylist and its clients
    $app->delete("/stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app['twig']->render('index.html.twig', array(
            'stylists' => Stylist::getAll()
        ));
    });


    return $app;
 ?>
