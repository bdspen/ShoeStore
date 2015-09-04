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

    //HOME
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stores' =>
        Store::getAll(), 'brands' => Brand::getAll()));
    });

    //ADD STORE
    $app->post("/add_store", function() use ($app) {

        $name = $_POST['store_name'];
        $store = new Store($name);
        $store->save();

        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll()));
    });

    //EDIT A STORE link
    $app->get("/store/{id}/edit", function($id) use ($app) {
       $store = Store::find($id);
       return $app['twig']->render("edit_store.html.twig", array("store" => $store,
        "brands" => Brand::getAll()));
    });

    //EDIT A BRAND link
    $app->get("/brand/{id}/edit", function($id) use ($app) {
       $brand= Brand::find($id);
       return $app['twig']->render("edit_brand.html.twig", array("brand" => $brand,
        "brands" => Brand::getAll(), "stores" => $brand->getStores()));
    });

    //DELETE ALL STORES/BRANDS
    $app->post("/delete_all", function() use ($app) {
        Store::deleteAll();
        Brand::deleteAll();
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(),
        'brands' => Brand::getAll()));
    });
    //DELETE INDIVIDUAL STORE
    $app->delete("/store/{id}/delete", function($id) use ($app) {
        $store = Store::find($id);
        $store->deleteStore();
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(),
        'brands' => Brand::getAll()));
    });

    //UPDATE
    $app->patch("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        if ( !empty($_POST['name']) )
        {
            $new_name = $_POST['name'];
            $store->updateName($new_name);
        }
        if ( !empty($_POST['add_brand']) )
        {
            $brand_name = $_POST['add_brand'];
            $store->addBrand($store->checkBrand($brand_name));
        }
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(),
    'brands' => Brand::getAll()));
    });

    $app->patch("/brand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        if ( !empty($_POST['name']) )
        {
            $new_name = $_POST['name'];
            $brand->updateName($new_name);
        }
        if ( !empty($_POST['add_store']) )
        {
            $store_name = $_POST['add_store'];
            $brand->addStore($brand->checkStore($store_name));
        }
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(),
    'brands' => Brand::getAll(), "stores" => $brand->getStores()));
    });




    return $app;
?>
