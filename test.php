<?php include "Database_connection.php"; ?>
<?php


$ID = $_POST["ID"];

$query = "SELECT * FROM users WHERE ID={$ID}";
$get_to_data = mysqli_query($connection,$query);
$row = mysqli_fetch_assoc($get_to_data);

$output_string = $row["Name"].">".$row["Email"].">".$row["Current Credit"];

echo $output_string;

?>