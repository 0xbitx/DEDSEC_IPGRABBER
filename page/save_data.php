<?php

$data = file_get_contents("php://input");

$file = "data.txt";

if (file_put_contents($file, $data) !== false) {
    echo "Data saved successfully.";
} else {
    echo "Error saving data.";
}
?>
