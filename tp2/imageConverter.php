<?php

$sourceDir = '/images';
$outputDir = '/images/converted';
$defaultWidth = 800;
$defaultHeight = 600;

if (!is_dir($outputDir)) {
    mkdir($outputDir, 0777, true);
}

foreach (glob("$sourceDir/*.jpg") as $inputFile) {
    $outputFile = $outputDir . '/' . basename(preg_replace('/\.jpg$/i', '.webp', $inputFile));

    $image = imagecreatefromjpeg($inputFile);
    if (!$image) {
        echo "Erreur : impossible de charger l'image $inputFile\n";
        continue;
    }

    $resizedImage = imagecreatetruecolor($defaultWidth, $defaultHeight);
    imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $defaultWidth, $defaultHeight, imagesx($image), imagesy($image));

    if (imagewebp($resizedImage, $outputFile)) {
        echo "Image convertie avec succès : $outputFile\n";
    } else {
        echo "Échec de la conversion pour : $inputFile\n";
    }

    imagedestroy($image);
    imagedestroy($resizedImage);
}
