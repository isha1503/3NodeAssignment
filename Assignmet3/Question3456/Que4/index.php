<?php
$dir = "/files/";

if (is_dir($dir)) {
    $files = scandir($dir);
    
    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            echo $file . "<br>";
        }
    }
} else {
    echo "The specified path is not a directory.";
}
?>