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

    //home
    $app->get("/", function() use ($app) {
    return $app['twig']->render('index.html.twig', array('stores' =>
    Store::getAll(), 'brands' => Brand::getAll()));
    });

    //ADD STORE
    $app->post("/add_store", function() use ($app) {

        $name = $_POST['store_name'];
        $store = new Store($name);
        $store->save();

        $name = $_POST['brand_name'];
        $brand = new Brand($name);
        $brand->save();

        $store->addBrand($brand);

    return $app['twig']->render('index.html.twig', array('stores' => Store::getAll()));
    });

    //EDIT A STORE
    $app->get("/store/{id}/edit", function($id) use ($app) {
       $store = Store::find($id);
       return $app['twig']->render("edit_store.html.twig", array("store" => $store));
    });

    //DELETE ALL STORES
    $app->post("/delete_all", function() use ($app) {
    Store::deleteAll();
    Brand::deleteAll();
    return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(),
    'brands' => Brand::getAll()));
    });

    //UPDATE
    $app->patch("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        if ( !empty($_POST['name']) ) {
            $new_name = $_POST['name'];
            $store->updateName($new_name);
        }
        if ( !empty($_POST['add_brand']) ) {
            $brand_name = $_POST['add_brand'];
            $store->addBrand($store->checkBrand($brand_name));
        }
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(),
    'brands' => Brand::getAll()));
    });


    return $app;
?>
