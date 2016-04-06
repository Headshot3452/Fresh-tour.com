<?php

class m160301_144013_new_ask_answer extends CDbMigration
{
	public function up()
	{
        $this->addColumn('ask_answer_tree', 'images', 'text');
	}

	public function down()
	{
        $this->dropColumn('ask_answer_tree','images');
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