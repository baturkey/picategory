<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
<?php
echo $this->Html->tag('title', 'Picategory');
echo $this->Html->css(array('jquery-ui.min', 'bootstrap.min', 'bootstrap-slider', 'default'));
echo $this->Html->script(array('jquery.min', 'jquery-ui.min', 'bootstrap.min', 'bootstrap-slider'));
?>
	</head>
	<body>
<?php
$menu = array(
	$this->Html->link('How to Play', array('controller' => 'pages', 'action' => 'how_to_play')),
	$this->Html->link('About'      , array('controller' => 'pages', 'action' => 'about')),
);

$logged_in = array(
	$this->Html->link('Games'      , array('controller' => 'games')),
	$this->Html->link('Logout'     , array('controller' => 'users', 'action' => 'logout')),
);

if(count($user))
{
	$menu = array_merge($menu, $logged_in);
}

echo $this->Html->div('navbar navbar-default',
					  $this->Html->div('container-fluid',
									   $this->Html->link('Picategory', '/', array('id' => 'Logo', 'escape' => false)) .
									   $this->Html->nestedList($menu, array('class' => 'menu list-inline')
									   )
					  )
);
echo $this->fetch('content');
echo $this->Html->div('navbar navbar-fixed-bottom', $this->Html->div('container-fluid', "&copy; 2015 Jeffrey Liu - Photo credits: " . $this->Html->link('VisualHunt', 'http://visualhunt.com/')));
?>
	</body>
</html>
