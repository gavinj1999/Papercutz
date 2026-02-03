<?php
declare(strict_types=1);

namespace Papercutz\MediaFix\Model\File;

use Magento\MediaStorage\Model\File\Uploader as CoreUploader;

/**
 * Custom uploader for Windows/DDEV compatibility
 */
class Uploader extends CoreUploader
{
    /**
     * Move uploaded file and create thumbnail if required
     *
     * @param string $destinationFolder - Actually receives the tmp file path
     * @param string $newFileName - Actually receives the full destination path
     * @return array
     */
    protected function _moveFile($destinationFolder, $newFileName)
    {
        // The parameters are misleadingly named:
        // $destinationFolder = temp file path
        // $newFileName = full destination path
        
        $tmpFile = $destinationFolder;  // This is actually the temp file
        $destFile = $newFileName;       // This is actually the full destination path
        
        // Extract just the filename
        $fileName = basename($destFile);
        $destFolder = dirname($destFile);

        // Verify source file exists
        if (!file_exists($tmpFile)) {
            throw new \Exception('Temporary upload file does not exist: ' . $tmpFile);
        }

        // Use copy instead of rename for Windows compatibility
        if (!copy($tmpFile, $destFile)) {
            $error = error_get_last();
            throw new \Exception('Unable to copy file: ' . ($error['message'] ?? 'Unknown error'));
        }

        // Try to delete the temp file
        @unlink($tmpFile);

        // Return the expected format
        return [
            'file' => $fileName,
            'path' => $destFolder
        ];
    }
}
