<?php

// Define the database connection parameters
$host = "mysql8";
$user = "myuser";
$pwd = "monpassword";
$db = "tutoseu";

// Try to connect to the database
try {
  // Create a new PDO object
  $dbco = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);

  // Set the PDO error mode to exception
  $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

// Catch any errors that occur during the connection
catch (PDOException $e) {
  // Print the error message
  echo "Erreur : " . $e->getMessage();
}

// Initialize the hint variable
$hint = "";

// Get the postal code from the GET request
$cp = $_GET['cp'];

// Query the database for all cities with the specified postal code
$statement = $dbco->query("SELECT `ville_nom` FROM `villes_france_free` WHERE `ville_code_postal` LIKE '".$cp."%' ");

// Fetch all of the results from the query
$results = $statement->fetchAll(PDO::FETCH_COLUMN);

// If there are any results
if (count($results) != 0) {

  // Iterate over the results
  foreach ($results as $ville) {

    // If the hint variable is empty
    if ($hint === "") {

      // Set the hint variable to the city name
      $hint = $ville."<br>";
    }
    else {

      // Append the city name to the hint variable
      $hint .= $ville."<br>";
    }
  }
}

// Print the hint variable
echo $hint === ""? "pas de villes..." : $hint;

