<?php

class m171123_211016_users extends CDbMigration
{
	public function up()
	{
		$this->createTable('users', array(
			'id' => 'pk',
			'email' => 'string',
			'password' => 'string',
			'created' => 'integer',
			'updated' => 'integer'
		));
		$this->createIndex('email_index', 'users', 'email', true);
	}

	public function down()
	{
		// echo "m171123_211016_users does not support migration down.\n";
		// return false;
		$this->dropTable('users');
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