<?php

class m150213_122301_alter_orders_delivery_price extends CDbMigration
{
	public function up()
	{
        $this->addColumn('orders','sum_delivery','float NOT NULL AFTER sum');
	}

	public function down()
	{
        $this->dropColumn('orders','sum_delivery');
        return true;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}