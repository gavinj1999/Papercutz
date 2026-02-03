<?php
namespace Rising5th\ReviewCarousel\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class CarouselConfig extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'vendor_review_carousel_config';

    protected function _construct()
    {
        $this->_init(\Rising5th\ReviewCarousel\Model\ResourceModel\CarouselConfig::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        return [];
    }
}
