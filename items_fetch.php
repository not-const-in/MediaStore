<?php
// Retrieve the JSON data sent in the request
$data = json_decode(file_get_contents('php://input'), true);

// Process and save the data to MySQL
$host = "aws.connect.psdb.cloud";
$username = "8j9k5cbylwf5jihjypvb";
$password = "pscale_pw_5tB0oqoYuujZ3meYcciAIxtD8tFBQGIfrKIa2q4EE0K";
$database = "proiectbd";

// Connection
$dsn = "mysql:host=$host;dbname=$database";
$options = array(
    PDO::MYSQL_ATTR_SSL_CA => __DIR__ . "/cacert.pem",
);
$pdo = new PDO($dsn, $username, $password, $options);


// Query for deleting all rows
$query = "DELETE FROM item";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Prepare the SQL query for inserting data
$query = 'INSERT INTO item (id_i, title, type, genre, release_date, price, rating) VALUES ';
$placeholders = array();
$bindValues = array();

// Iterate over the data array and build the placeholders and bind values for the prepared statement
foreach ($data as $row) {
    $placeholders[] = '(?, ?, ?, ?, ?, ?, ?)';
    $bindValues = array_merge($bindValues, array_values($row));
}

// Combine the query and placeholders
$query .= implode(', ', $placeholders);

// Prepare the statement
$stmt = $pdo->prepare($query);

// Bind the values to the prepared statement
$stmt->execute($bindValues);

// Return a response indicating success or failure
if ($stmt) {
    http_response_code(200); // OK
} else {
    http_response_code(500); // Internal Server Error
}
//terminate the connection
$pdo = null;
?>