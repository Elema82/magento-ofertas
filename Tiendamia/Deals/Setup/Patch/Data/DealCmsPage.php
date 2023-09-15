<?php

declare (strict_types = 1);

namespace Tiendamia\Deals\Setup\Patch\Data;

use Magento\Cms\Model\PageFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class DealCmsPage implements DataPatchInterface
{
    /**
     * ModuleDataSetupInterface
     *
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param PageFactory $pageFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        PageFactory $pageFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->pageFactory = $pageFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {

        $pageData = [
            'title' => 'Week\'s  Deals',
            'page_layout' => '1column',
            'meta_keywords' => 'TiendaMia deals Meta Keywords',
            'meta_description' => 'TiendaMia deals Meta Description',
            'identifier' => 'deals',
            'content_heading' => '',
            'content' => '',
            'layout_update_xml' => '',
            'url_key' => 'tienda-mia-deals',
            'is_active' => 1,
            'stores' => [0, 1],
            'sort_order' => 0,
        ];

        $this->moduleDataSetup->startSetup();
        $this->pageFactory->create()->setData($pageData)->save();
        $this->moduleDataSetup->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
