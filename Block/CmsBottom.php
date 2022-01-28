<?php
/**
 * Copyright © Digital Milk s.r.l All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DigitalMilk\CategoryBottomCms\Block;

use Magento\Catalog\Model\Category;

class CmsBottom extends \Magento\Catalog\Block\Category\View
{

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\Layer\Resolver $layerResolver,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Helper\Category $categoryHelper,
        array $data = []
    )
    {
        parent::__construct($context, $layerResolver, $registry, $categoryHelper, $data);
    }

    private function hasToBeDisplayed(): bool
    {
        $display_mode = $this->getCurrentCategory()->getDisplayMode();
        return in_array($display_mode, [Category::DM_PAGE, Category::DM_MIXED]);
    }

    private function retrieveCmsBottomBlockHtml($block_id): string
    {
        return $this->getLayout()->createBlock('Magento\Cms\Block\Block')->setBlockId($block_id)->toHtml();
    }

    public function displayBottomCms(): string
    {
        $cms_id = $this->getCurrentCategory()->getCmsBottom();
        if ($cms_id && $this->hasToBeDisplayed()){
            return  $this->retrieveCmsBottomBlockHtml($cms_id);
        }
        return '';
    }
}

