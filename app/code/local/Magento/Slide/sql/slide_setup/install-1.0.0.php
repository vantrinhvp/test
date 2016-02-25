<?php
$installer = $this;
$table = $installer->getConnection()
    ->newTable($installer->getTable('slide/slide'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array(
        'unsigned' => true,
        'identity' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Id')
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable'=>true,
        'default'=>null,
    ),'Title')
    ->addColumn('image', Varien_Db_Ddl_Table::TYPE_VARCHAR,255, array(
        'nullable'=>true,
        'default'=>null,
    ),'Images')
    ->addColumn('description', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable'=>true,
        'default'=>null,
    ),'Description')
    ->addColumn('url', Varien_Db_Ddl_Table::TYPE_VARCHAR,255, array(
        'nullable'=>true,
        'default'=>null,
    ),'URL')
    ->addColumn('page', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable'=>true,
        'default'=>null,
    ),'Page')
    ->addColumn('position', Varien_Db_Ddl_Table::TYPE_TINYINT, 10, array(
        'nullable'=>true,
        'default'=>null,
    ),'position')
    ->addColumn('status',Varien_Db_Ddl_Table::TYPE_TINYINT, 2, array(
        'nullable'=>true,
        'default'=>null,
    ),'Status')
    ->setComment('slide');
$installer->getConnection()->createTable($table);
