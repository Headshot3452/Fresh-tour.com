<?php

class m160301_140912_menu_tree extends CDbMigration
{
	public function up()
	{
        $this->addColumn('menu_item','lft','int(11) unsigned NOT NULL');
        $this->addColumn('menu_item','rgt','int(11) unsigned NOT NULL');
        $this->addColumn('menu_item','level','int(11) unsigned NOT NULL');
        $this->addColumn('menu_item','root','int(11) unsigned NOT NULL');
        $this->addColumn('menu_item','status','tinyint(4) unsigned NOT NULL');
        $this->dropForeignKey('fk_menu_item_menu_menu_id', 'menu_item');
        $this->dropColumn('menu_item','menu_id');
	}

	public function down()
	{
        $this->addColumn('menu_item','menu_id','int(11) unsigned NOT NULL');
        $this->addForeignKey("fk_menu_item_menu_menu_id", "menu_item", "menu_id", "menu", "id", "CASCADE", "CASCADE");
        $this->dropColumn('menu_item','lft');
        $this->dropColumn('menu_item','rgt');
        $this->dropColumn('menu_item','level');
        $this->dropColumn('menu_item','root');
        $this->dropColumn('menu_item','status');
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