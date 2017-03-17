<?php
  date_default_timezone_set('America/Los_Angeles');
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Contact.php";

  $app = new Silex\Application();
  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
  ));

  $app->get ("/", function() use ($app) {

    $exist_con = array ();

    $adam = new Contact ("Adam", "Cafe", "friend", "206-000-0000", "adam@mail.com", "0000 1st Ave, Seattle WA", "friends" );
    $bob = new Contact ("Bob", "Uber", "friend", "206-000-0001", "bob@mail.com", "0001 1st Ave, Seattle WA", "friends" );
    $ceaser = new Contact ("Ceaser", "Restaurant", "friend", "206-000-0002", "ceaser@mail.com", "0002 1st Ave, Seattle WA", "friends" );
    $dan = new Contact ("Dan", "Starbucks", "cousin", "206-000-0032", "dan@mail.com", "0000 2nd Ave, Seattle WA", "family" );
    $eliot = new Contact ("Eliot", "Coding", "mate", "206-000-2500", "eliot@mail.com", "0000 31st Ave, Seattle WA", "classmates" );
    $max = new Contact ("Max", "Coding", "mate", "206-000-0000", "max@mail.com", "0000 1st Ave, Seattle WA", "mates" );

    array_push($exist_con, $adam, $bob, $ceaser, $dan, $eliot, $max);
    return $app['twig']->render('index.html.twig', array('contacts'=>$exist_con));
  });

  return $app;
?>
