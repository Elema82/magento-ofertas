<?php
namespace Omnipro\Blog\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface;


class Uninstall implements UninstallInterface
{
    protected $schemaSetup;

    public function __construct(SchemaSetupInterface $schemaSetup)
    {
        $this->schemaSetup = $schemaSetup;
    }

    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        // Aquí colocas las operaciones para eliminar los cambios de la base de datos
        $connection = $this->schemaSetup->getConnection();
        $connection->dropTable($this->schemaSetup->getTable('omnipro_blog_post'));

        $setup->endSetup();
    }
}
