<?php
namespace Rising5th\ReviewCarousel\Model\ResourceModel\Carousel;

use Magento\Framework\ObjectManagerInterface;

class CollectionFactory
{
    protected $objectManager;
    protected $instanceName;

    public function __construct(ObjectManagerInterface $objectManager, $instanceName = \Rising5th\ReviewCarousel\Model\ResourceModel\Carousel\Collection::class)
    {
        $this->objectManager = $objectManager;
        $this->instanceName = $instanceName;
    }

    public function create(array $data = [])
    {
        return $this->objectManager->create($this->instanceName, $data);
    }
}
