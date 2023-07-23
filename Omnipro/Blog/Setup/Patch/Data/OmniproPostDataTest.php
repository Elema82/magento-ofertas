<?php


namespace Omnipro\Blog\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class OmniproPostDataTest implements DataPatchInterface
{

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;


    /**
     * OmniproPostDataTest constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {

        $connection = $this->moduleDataSetup->getConnection();
        $connection->insert(
            $connection->getTableName('omnipro_blog_post'),
            [
            'title' => "titulo de prueba",
            'content' => "Un contenido de prueba para probar lo hecho"
            ]
        );

        return $this;
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

}
