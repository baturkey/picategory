<?php
$form  = $this->Session->flash('auth');
$form .= $this->Form->create('User', array('id'            => 'LoginForm',
										   'url'           => array('controller' => 'users',
																	'action'     => 'login'),
										   'inputDefaults' => array('div'        => 'form-group',
																	'class'      => 'form-control',
																	'label'      => false))
);
$form .= $this->Form->input('email',     array('placeholder' => __d('users', 'Email'   )));
$form .= $this->Form->input('password',  array('placeholder' => __d('users', 'Password')));
$form .= $this->Html->div('',
						  $this->Form->end(array('label' => __d('users', 'Login'), 'class' => 'btn btn-primary', 'div' => false)) . " | " .
						  $this->Html->link(__d('users', 'Register'            ), array('controller' => 'users', 'action' => 'add'           )) . " | " .
						  $this->Html->link(__d('users', 'I forgot my password'), array('controller' => 'users', 'action' => 'reset_password'))
						  
);

$content  = $this->Html->div('col-md-6', $this->Html->image('example.png', array('id' => 'ExampleImage')));
$content .= $this->Html->div('col-md-6', $this->Html->tag('h2', 'Have your team choose the correct images by revealing one word at a time.') . $form);

echo $this->Html->css('home');
echo $this->Html->div('container-fluid', $this->Html->div('row', $content));
