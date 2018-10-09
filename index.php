<?php
include("classes/Parce.class.php");
include('template/users.php'); // contains an array of DB simulated users

// Example of use:
// $a = new Template('template/list.tpl');
// $a->set('keyword', 'Checkpoint, Warning, Fire, Wild');
// echo $a->output();

$master = new Parce("template/master.tpl"); // this will act as the master layout file

// Examples of how to use the class to easily set any {{ }} to any value. Without the use of an external template.
$master->set("title", "Morningtrain challenge - PHP");
$master->set('file', __FILE__);
$master->set('url', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
$master->set('date', date('d M Y'));

// This is how you parce something from a different file onto the master layout file.
$simple = new Parce("template/simp.tpl");
$simple->set('simplified', 'I am a simplified example');
$master->set('h1', $simple->output()); // notice the use of the $master


// Loop through the users, create an instance of Template for each user.
// make a second loop, looping through the users inserting their data into Template values array.
// make an array of the Template array to use in the merge and check for errors to then finally
// get the users data and store it in a variable to be accesible through {{content}}
foreach ($users as $user) { // $users is from the included users.php.
    $row = new Parce("template/users.tpl"); // get the html from the template file.
    foreach ($user as $key => $value) { // loop through the users.
        $row->set($key, $value); // store the users in the Template values array.
    }
    $userArray[] = $row; // The Template object are stored in an array
}
$userData = Parce::merge($userArray); //merge the array from above and get the users
$master->set("content", $userData); // set {{content}} to contain all the userData from the static merge method.
// here we simply print it all out to the master layout file.
echo $master->output();
