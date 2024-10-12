<?php

namespace App\Services;

class PdfCompression
{
    /**
     * Compress a PDF using Ghostscript.
     *
     * @param string $inputPath  Path to the original PDF file
     * @param string $outputPath Path where the compressed PDF will be saved
     * @param int $quality Quality level (e.g., 75-85)
     * @return bool True if compression was successful, false otherwise
     */
    public function compressPdf(string $inputPath, string $outputPath, int $quality = 110): bool
    {
        // Ghostscript command with parameters
        $gsPath = env('URL_COMPRESOR_PDF'); // Ajusta <version> según la versión instalada
        $command = sprintf(
            '"%s" -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/printer -dDownsampleColorImages=true -dColorImageResolution=250 -dJPEGQ=%d -dCompressFonts=true -dSubsetFonts=true -dNOPAUSE -dQUIET -dBATCH -sOutputFile=%s %s 2>&1',
            $gsPath,
            $quality,
            escapeshellarg($outputPath),
            escapeshellarg($inputPath)
        );

        $output = shell_exec($command);
        \Log::info("Ghostscript output: $output");

       // Imprimir el comando para depuración
        \Log::info("Ghostscript command: $command");

        // Comprobar si el archivo comprimido fue creado correctamente
        return file_exists($outputPath);
    }
}