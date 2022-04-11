<?php


$file1 = '/var/www/html/worker1.txt';
$file2 = '/var/www/html/worker2.txt';
$Data1 = "";
$Data2 = "";

// worker1 data
if (file_exists($file1)) {
    $fh = fopen($file1, 'r');
    while ($line = fgets($fh)) {
        $worker1 = $line;
    }
    fclose($fh);
}


// worker2 data
if (file_exists($file2)) {
    $fh = fopen($file2, 'r');
    while ($line = fgets($fh)) {
        $worker2 = $line;
    }
    fclose($fh);
}

// affichage
// Recupération du contenu de debut de page
$pathHead = "/var/www/html/header.html";
$handlerHead = fopen($pathHead, 'r');
$contenuHead = fread($handlerHead, filesize($pathHead));
fclose($handlerHead);

// Recupération du contenu de fin de page
$pathFoot = "/var/www/html/footer.html";
$handlerFoot = fopen($pathFoot, 'r');
$contenuFoot = fread($handlerFoot, filesize($pathFoot));
fclose($handlerFoot);


$pathDest = "/var/www/html/index.html";
$handleDest = fopen($pathDest, 'w');

$Data1 = "<h2>worker 1 vaut <span class='text-danger'>" . $worker1 . "</span><br>";
$Data2 = "worker 2 vaut <span class='text-danger'>" . $worker2 . "</span></h2>";

fwrite($handleDest, $contenuHead);
fwrite($handleDest, $Data1);
fwrite($handleDest, $Data2);
fwrite($handleDest, $contenuFoot);

fclose($handleDest);


