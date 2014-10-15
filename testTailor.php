<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
echo ("blbla Alex");
$conn = new MongoClient("mongodb://tailor.wwwowww.me");
// seleccionamos la base de datos php
$db = $conn->Mariaaaa;
// elegimos una coleccion llamada contactos
$coll = $db->contacts;

if ($conn) {
 echo nl2br("Ok, you're connected to MongoDB - ". $db . "\n\n");
} else {
 echo "Fail U.u";
}
?>

