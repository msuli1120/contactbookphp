<?php
  date_default_timezone_set('America/Los_Angeles');
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Contact.php";

  session_start();

  if(empty($_SESSION['list_of_contacts'])) {
    $_SESSION['list_of_contacts'] = array ();
  }


  $app = new Silex\Application();
  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
  ));

  $app->get("/", function() use ($app) {
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

  $app->post("/create_contact", function() use ($app) {
    $name_err = '';
    $email_err = '';
    $phone_err = '';
    $new_contact = new Contact ($_POST['name'],$_POST['company'],$_POST['relation'],$_POST['mobile'],$_POST['email'],$_POST['address'],$_POST['group']);
    if (!preg_match("/^[a-zA-Z ]*$/",$_POST['name'])) {
      $name_err = "Only letters and white space allowed for Name";
      return $app['twig']->render('invalid.html.twig', array('nameerr' => $name_err));
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $email_err = "Invalid email format!";
      return $app['twig']->render('invalid.html.twig', array('emailerr' => $email_err));
    } elseif (!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $_POST['mobile'])) {
      $phone_err = "Invalid Number!Please use 000-000-0000!";
      return $app['twig']->render('invalid.html.twig', array('phoneerr' => $phone_err));
    } else {
      $new_contact->saveContact();
      return $app['twig']->render('newcontact.html.twig', array('newcon' => $new_contact));
    };
});

  $app->post("/go_back", function() use ($app) {
    return $app['twig']->render('index.html.twig', array('newcontacts'=>Contact::getContactList()));
  });

  $app->post("/sort", function() use ($app) {
    $srt = array ();
    $sort_name = $_POST['sortName'];
    foreach(Contact::getContactList() as $contact) {
      if ($sort_name === $contact->getGroup()){
        array_push($srt, $contact);
      };
    };
    return $app['twig']->render('sort.html.twig', array('contacts'=> $srt, 'grp'=>$sort_name));
  });


  $app->post("/delete_all", function() use ($app) {
    Contact::delete();
    return $app['twig']->render('delete.html.twig');
  });

  return $app;
?>
