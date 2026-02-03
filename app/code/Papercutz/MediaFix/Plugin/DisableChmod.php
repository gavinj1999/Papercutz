<?php
declare(strict_types=1);

namespace Papercutz\MediaFix\Plugin;

use Magento\MediaStorage\Model\File\Uploader;

/**
 * Disable chmod on Windows/DDEV environments where it's not permitted
 */
class DisableChmod
{
    /**
     * Prevent chmod errors by skipping the operation
     */
    public function aroundSave(
        Uploader $subject,
        callable $proceed,
        string $destinationFolder,
        ?string $newFileName = null
    ) {
        // Temporarily disable error handler for chmod
        set_error_handler(function($errno, $errstr) {
            // Suppress chmod warnings
            if (stripos($errstr, 'chmod') !== false) {
                return true;
            }
            return false;
        });
        
        try {
            $result = $proceed($destinationFolder, $newFileName);
        } finally {
            restore_error_handler();
        }
        
        return $result;
    }
}
