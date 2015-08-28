<?php

    //initial setup for the app.php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));



    $app->get("/", function() use ($app) {
    return $app['twig']->render('index.html.twig', array('stores' =>
    Store::getAll(), 'brands' => Brand::getAll()));
    });

    $app->post("/add_store", function() use ($app) {

        $name = $_POST['store_name'];
        $store = new Store($name);
        $store->save();

    return $app['twig']->render('index.html.twig', array('stores' => Store::getAll()));
    });

    $app->get("/store/{id}/edit", function($id) use ($app) {
       $store = Store::find($id);
       return $app['twig']->render("edit.html.twig", array("store" => $store));
    });


    return $app;
?>
