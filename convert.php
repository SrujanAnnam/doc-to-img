<?php
require_once 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\File\UploadedFile;

$uploadDir = 'uploads/';
$outputDir = 'output_images/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create the output folder for the current conversion
    $timestamp = time();
    $outputFolder = $outputDir . $timestamp . '/';
    mkdir($outputFolder, 0777, true);

    $convertedFiles = [];

    // Process each uploaded file
    foreach ($_FILES['documents']['tmp_name'] as $key => $tmpFilePath) {
        $originalFileName = $_FILES['documents']['name'][$key];
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $pdfPath = $tmpFilePath;
        $outputFileName = pathinfo($originalFileName, PATHINFO_FILENAME);
        $convertedFilePath = $outputFolder . $outputFileName . '.png';

        $returnCode = 0; // Initialize $returnCode variable
        $isPDFConverted = false; // Flag to track PDF conversion status

        if (strtolower($extension) === 'pdf') {
            // Convert PDF to image using ImageMagick
            $convertCommand = "magick convert -density 300 -antialias \"$pdfPath\" \"$convertedFilePath\"";
            exec($convertCommand, $output, $returnCode);
        } elseif (in_array(strtolower($extension), ['doc', 'docx'])) {
            try {
       // Convert DOC or DOCX to PDF using LibreOffice
$pdfFilePath = $uploadDir . $outputFileName . '.pdf';
$convertCommand = "soffice --headless --convert-to pdf:writer_pdf_Export --outdir $uploadDir \"$pdfPath\"";
exec($convertCommand, $output, $returnCode);

// Set the flag to indicate successful PDF conversion
if ($returnCode === 0) {
    $isPDFConverted = true;

    // Search for the generated PDF file in the "uploads" folder
    $generatedPDF = glob($uploadDir . '*.pdf');
    if (count($generatedPDF) === 1) {
        $pdfFilePath = $generatedPDF[0];
    }
}

// Convert the generated PDF to image using ImageMagick
if ($isPDFConverted) {
    $convertCommand = "magick convert -density 300 -antialias \"$pdfFilePath\" \"$convertedFilePath\"";
    exec($convertCommand, $output, $returnCode);
    // Remove the temporary PDF file if it exists
    if (file_exists($pdfFilePath)) {
        unlink($pdfFilePath);
    }
}

                

            } catch (Exception $e) {
                echo "Conversion failed for $originalFileName with error: $e\n";
                $convertedFiles[] = ['filename' => $originalFileName, 'success' => false];
            }
        } elseif (in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
            // Directly copy and save the image file
            move_uploaded_file($tmpFilePath, $outputFolder . $originalFileName);
            $convertedFiles[] = ['filename' => $originalFileName, 'success' => true];
        } else {
            // Unsupported file format, skip conversion
            echo "Unsupported file format: $extension for $originalFileName\n";
            continue;
        }

        if ($returnCode === 0) {
            echo "Conversion successful for $originalFileName\n";
            $convertedFiles[] = ['filename' => $originalFileName, 'success' => true];
        } else {
            // Check if the PDF conversion was successful before considering it a failure
            if ($isPDFConverted) {
                echo "Conversion failed for $originalFileName with code: $returnCode\n";
                $convertedFiles[] = ['filename' => $originalFileName, 'success' => false];
            }
        }
    }

    echo json_encode(['conversions' => $convertedFiles]);
}

?>
