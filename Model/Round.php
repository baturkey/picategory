<?php
class Round extends AppModel
{
	public $actsAs              = array('Containable');
	public $belongsTo           = array('Game');
	public $hasAndBelongsToMany = array('User');
	public $hasMany             = array('Submission');
	public $order               = 'round desc';
}
