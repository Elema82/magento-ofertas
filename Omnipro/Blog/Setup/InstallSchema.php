<?php
namespace Omnipro\Blog\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;


class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

        $installer = $setup;
        $installer->startSetup();

        // Obtener la tabla para el blog
        $tableName = $installer->getTable('omnipro_blog_post');

        // Verificar si la tabla no existe
        if (!$installer->getConnection()->isTableExists($tableName)) {
            // Crear la tabla del blog
            $table = $installer->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    'post_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                    'ID'
                )
                ->addColumn('title', Table::TYPE_TEXT, 255, ['nullable' => false], 'Titulo')
                ->addColumn('content', Table::TYPE_TEXT, '2M', [], 'Contenido')
                ->addColumn('created_at', Table::TYPE_TIMESTAMP, null, ['default' => Table::TIMESTAMP_INIT], 'Fecha de Creación')
                ->setComment('Tabla de Publicaciones del Blog');

            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}
