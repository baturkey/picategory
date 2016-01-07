<?php
class Game extends AppModel
{
	public $actsAs = array('Containable');
	public $hasAndBelongsToMany = array('Image', 'User');
	public $hasMany = array('Message', 'Round');
}
