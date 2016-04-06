<?php

class m151224_140204_favourite extends CDbMigration
{
	public function up()
	{
        $this->createTable('favourite', array(
            'id'=>'int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'user_id'=>'int(10) UNSIGNED NOT NULL',
            'type' =>'tinyint(1) UNSIGNED NOT NULL',
            'item_id' => 'int(10) UNSIGNED NOT NULL'
        ), 'ENGINE=InnoDB');

        $this->createIndex('user_id_idx', 'favourite', 'user_id', true);
        $this->addForeignKey("favourite_ibfk_1", "favourite", "user_id", "users", "id", "CASCADE", "CASCADE");
	}

	public function down()
	{
        $this->dropForeignKey('favourite_ibfk_1', 'favourite');
        $this->dropTable('favourite');
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