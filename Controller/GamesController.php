<?php
/**
GamesController
*/
class GamesController extends AppController
{
	public function index()
	{
		$findOps = array();
		$findOps['conditions'] = array('id' => $this->Auth->user('id'));
		$findOps['contain']    = array('Game');
		$user = $this->Game->User->find('first', $findOps);
		$games = $user['Game'];
		$this->set(compact('games'));
	}

	public function view($id)
	{
		$findOps = array();
		$findOps['conditions'] = array('id' => $id);
		$findOps['contain']    = array('Image',
									   'Message' => array('User'),
									   'Round'   => array('User', 'order' => 'round DESC'),
									   'User'    => array('conditions' => array('User.id' => $this->Auth->user('id'))));
		$game = $this->Game->find('first', $findOps);
		if(!count($game))
		{
			return $this->redirect(array('action' => 'index'));
		}

		$this->set(compact('game'));
	}

	public function create()
	{
		$map = array(0,                         // bomb
					 1, 1, 1, 1, 1, 1, 1, 1, 1, // first player
					 2, 2, 2, 2, 2, 2, 2, 2,    // second player
					 3, 3, 3, 3, 3, 3, 3        // neutral
		);
		shuffle($map);

		$image_ids = $this->Game->Image->find('list', array('fields' => 'id'));
		shuffle($image_ids);

		$image_data = array();
		foreach(array_slice($image_ids, 0, 25) as $image_id)
		{
			$image_data[] = array('image_id' => $image_id);
		}

		$game_data = array('Game'  => array('map' => serialize($map)),
						   'Image' => $image_data,
		);
		$this->Game->saveAssociated($game_data);

		return $this->redirect(array('action' => 'view', $this->Game->id));
	}
}
