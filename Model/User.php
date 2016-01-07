<?php
class User extends AppModel
{
	public $actsAs = array('Containable');
	public $hasAndBelongsToMany = array('Game');
	public $hasMany = array('Message');
}
