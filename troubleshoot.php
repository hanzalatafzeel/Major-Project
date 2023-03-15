<?php
@include 'config.php';
$handle = fopen("update.sql", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        $result = $db->query($line);
    }

    fclose($handle);
}
echo "successfull";
header("location: ../phpmyadmin/index.php?route=/sql&db=canteen&table=item&pos=0");
?>