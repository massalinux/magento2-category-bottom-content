<?php

namespace DigitalMilk\CategoryBottomCms\Model\Rule;

class CmsBlockOptionsProvider implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var array|null
     */
    protected $options;

    /**
     * @var \Magento\Cms\Model\ResourceModel\Block\CollectionFactory
     */
    private $collectionFactory;

    public function __construct(
        \Magento\Cms\Model\ResourceModel\Block\CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        if (!$this->options) {
            $this->options = $this->collectionFactory->create()->toOptionArray();
            array_unshift($this->options, ['value' => '', 'label' => __('Please select a static block.')]);
        }
        return $this->options;
    }
}
