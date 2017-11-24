<?php

class m171123_211023_reminders extends CDbMigration
{
	public function up()
	{
		$this->createTable('events', array(
			'id' => 'pk',
			'user_id' => 'integer',
			'title' => 'string',
			'data' => 'text',
			'time' => 'integer',
			'created' => 'integer',
			'updated' => 'integer'
		));
		$this->addForeignKey('event_users', 'events', 'user_id', 'users', 'id', NULL, 'CASCADE', 'CASCADE');

		$this->createTable('reminders', array(
			'id' => 'pk',
			'event_id' => 'integer',
			'offset' => 'integer',
			'time' => 'integer',
			'created' => 'integer',
			'updated' => 'integer'
		));
		$this->addForeignKey('reminder_events', 'reminders', 'event_id', 'events', 'id', NULL, 'CASCADE', 'CASCADE');
	}

	public function down()
	{
		// echo "m171123_211023_reminders does not support migration down.\n";
		// return false;
		$this->dropForeignKey('event_users', 'events');
		$this->dropForeignKey('reminder_events', 'reminders');
		$this->dropTable('events');
		$this->dropTable('reminders');
		
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