<?php

include 'DBConnector.php';

$topicsQuery = "SELECT `name` FROM `topics` ORDER BY `name`;";
$topicsResult = $conn -> query($topicsQuery);

?>