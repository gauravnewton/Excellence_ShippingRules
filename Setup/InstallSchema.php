<?php
/**
 * Copyright © 2015 Excellence. All rights reserved.
 */

namespace Excellence\ShippingRules\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

        $installer = $setup;

        $installer->startSetup();

        /**
         * Create table 'shippingrules_shippingrules'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('shippingrules_shippingrules')
        )
            ->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'shippingrules_shippingrules'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'name'
            )
            ->addColumn(
                'status',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false],
                'status'
            )
            ->addColumn(
                'shipping_method',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'shipping_method'
            )
            ->addColumn(
                'from_date',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false],
                'from_date'
            )
            ->addColumn(
                'to_date',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false],
                'to_date'
            )
            ->addColumn(
                'store_view',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'store_view'
            )
            ->addColumn(
                'customer_group',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [],
                'customer_group'
            )
            ->setComment(
                'Excellence ShippingRules shippingrules_shippingrules'
            );

        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}
