<?php
namespace Rising5th\ReviewCarousel\Model\ResourceModel\CarouselConfig;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'config_id';

    protected function _construct()
    {
        $this->_init(\Rising5th\ReviewCarousel\Model\CarouselConfig::class, \Rising5th\ReviewCarousel\Model\ResourceModel\CarouselConfig::class);
    }
}
