<?php
declare(strict_types=1);

namespace Papercutz\MediaFix\Plugin;

use Magento\MediaGalleryIntegration\Plugin\SaveImageInformation;
use Magento\MediaStorage\Model\File\Uploader;
use Psr\Log\LoggerInterface;

/**
 * Fix TypeError when SaveImageInformation receives false instead of array
 */
class FixSaveImageInformation
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function aroundAfterSave(
        SaveImageInformation $subject,
        callable $proceed,
        Uploader $uploader,
        $result
    ) {
        // If upload failed, don't process metadata
        if ($result === false || !is_array($result)) {
            $this->logger->debug('Media upload did not return array result', [
                'result_type' => gettype($result)
            ]);
            return $result;
        }

        return $proceed($uploader, $result);
    }
}
