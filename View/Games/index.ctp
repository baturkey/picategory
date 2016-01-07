<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
<?php
echo $this->Html->tag('h1', 'My Games');
echo $this->Html->tag('h2', 'Current');
$game_list = array();
foreach($games as $game)
{
	$game_list[] = $this->Html->link('Game ' . $game['id'], array('action' => 'view', $game['id']));
}
echo $this->Html->nestedList($game_list);
echo $this->Html->tag('h2', 'Ended');
?>
		</div>
		<div class="col-md-6">
			<h1>Open Games</h1>
		</div>
	</div>
</div>
