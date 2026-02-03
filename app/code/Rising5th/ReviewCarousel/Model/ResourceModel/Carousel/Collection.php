<?php
namespace Rising5th\ReviewCarousel\Model\ResourceModel\Carousel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init(\Rising5th\ReviewCarousel\Model\Carousel::class, \Rising5th\ReviewCarousel\Model\ResourceModel\Carousel::class);
    }
}
