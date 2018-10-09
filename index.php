<?php
include("classes/Parce.class.php");
include('template/users.php');              // contains an array of DB simulated users

                                            // Example of use:
                                            // $a = new Template('template/list.tpl');
                                            // $a->stage('keyword', 'Checkpoint, Warning, Fire, Wild');
                                            // echo $a->output();

$master = new Parce("template/master.tpl"); // this will act as the master layout file.

// Examples of how to parce without use of external template file.
$master->stage("title", "Morningtrain challenge - PHP");
$master->stage('file', __FILE__);
$master->stage('url', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
$master->stage('date', date('d M Y'));

// Example of how you parce with the use of an external template file.
$simple = new Parce("template/simp.tpl");
$simple->stage('simplified', 'I am a simplified example');
$simple->stage('another', 'I am another example');
$master->stage('h1', $simple->output());    // notice the use of the $master.


                                            //Loop through users array.
                                            //Create instance of Parce for each user.
                                            //Stage the users into the protected _values.
                                            //Create an array of objects with the users data.
                                            //Loop through objects and get the array data.
                                            //Pass the ::chain data to the master using the stage method.
foreach($users as $user)
{
  $row = new Parce('template/users.tpl');   // create instance of users for each user found.
  foreach($user as $key => $value)
  {
    $row->stage($key, $value);              // set each users into the protected _values array.
  }
$userArray[] = $row;                        // Create an array of objects containing the users data.
}
$userData = Parce::chain($userArray);       // loop through array of objects and get array data.
$master->stage('content', $userData);       // put array data into the master template.

echo $master->output();                     // Finally parce the master and print the output.
