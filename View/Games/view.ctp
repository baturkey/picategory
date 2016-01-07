<?php
echo $this->Html->css('game');
echo $this->Html->script(array('game', 'jquery.radial'));

$current_user = $game['User'][0]['GamesUser'];

if($game['Round'][0]['category'] == null && $current_user['role'] && $game['Round'][0]['round'] % 2 == $current_user['team'])
{
	echo $this->Html->div('navbar navbar-info',
						  $this->Html->div('container-fluid',
										   "Round {$game['Round'][0]['round']}: Please enter a category and how many pictures belong in that category" .
										   '<form id="CategoryForm"><input id="CategoryInput" class="inline-form" type="text" placeholder="Category"/><div id="RadialMenu"></div><button id="CategoryButton"class="btn btn-primary">&gt;&gt;</button></form>'
						  )
	);
}

$form  = $this->Form->create();
$form .= $this->Form->input('Slider', array('label' => 'Image Size: '));
$form .= $this->Form->hidden('Selected', array('value' => '[]'));
$form .= $this->Form->end();

$classes = array('bomb', 'first', 'second', 'neutral');
$map = unserialize($game['Game']['map']);
$table = '';
for($i = 0; $i < 5; $i++)
{
	$row = array();
	for($j = 0; $j < 5; $j++)
	{
		$index = $i * 5 + $j;
		$row[] = $this->Html->tag('td',
								  $this->Html->div('cell',
												   $this->Html->div('identifier ' . ($current_user['role'] ? $classes[$map[$index]] : ''), $index + 1) .
												   $this->Html->image($game['Image'][$index]['name'] . '.png',
																	  array('class' => 'image',
																			'alt'   => $game['Image'][$index]['name'])),
												   array('id' => 'cell' . ($index + 1), 'onClick' => 'log(this, 3)'))
		);
	}
	$table .= $this->Html->tableCells($row);
}

$board = $form . $this->Html->tag('table', $table, array('id' => 'GameTable'));
$left = $this->Html->div('col-lg-6', $board, array('id' => 'Game'));

$log = '';			
foreach($game['Round'] as $round)
{
	$team = $round['round'] % 2 ? 'Alpha' : 'Omega';
	$log .= $this->Html->tag('h3', "Round {$round['round']} - $team Team");

	foreach($round['User'] as $user)
	{
		$log .= $this->Html->div('submission-label', $user['username']);
		$submissions = array();
		foreach(json_decode($user['RoundsUser']['submission']) as $x)
		{
			$submissions[] = $this->Html->image($game['Image'][$x-1]['name'] . '.png',
												array('class' => 'image',
													  'alt'   => $game['Image'][$x-1]['name']));
		}
		$log .= $this->Html->nestedList($submissions, array('class' => 'list-inline'));
	}
}
$center = $this->Html->div('col-lg-3', $log, array('id' => 'Log'));

$messages = array();
foreach($game['Message'] as $message)
{
	$messages[] = $this->Html->div('row',
								   $this->Html->div('col-sm-6 username', $message['User']['username']) .
								   $this->Html->div('col-sm-6 created' , $message['created']))         .
				$this->Html->div('message',  $this->Markdown->transform($message['message']));
}
$chat  = $this->Html->nestedList($messages, array('id' => 'MessageList'));
if(!$current_user['role'])
{
	$chat .= $this->Form->create('Message', array('class' => 'form-inline',
												  'url'   => array('controller' => 'messages',
																   'action'     => 'add',
																   $game['Game']['id']))
	);
	$chat .= $this->Form->input('message', array('label' => false, 'div' => false));
	$chat .= $this->Form->hidden('game_id', array('value' => $game['Game']['id']));
	$chat .= $this->Form->hidden('user_id', array('value' => $game['User'][0]['id']));
	$chat .= $this->Form->end(array('label' => 'Post', 'class' => 'btn btn-primary'));
}
$right = $this->Html->div('col-lg-3', $chat, array('id' => 'Chat'));

echo $this->Html->div('container-fluid', $this->Html->div('row', $left . $center . $right));

debug($game);
