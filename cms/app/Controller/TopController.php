<?php

class TopController extends AppController
{

	public $uses = array('Article');
	public $components = array('Paginator');

	public function beforeFilter()
	{
		$this->user = $this->Auth->user();
	}

	public function index(){
		$this->loadModel('Category');
		$this->Paginator->settings = $this->Article->getPagenatorSetting($this->user['id']);
		$this->set(array(
			'categories' => $this->Category->find('all'),
			'articles' => $this->Paginator->paginate('Article'),
			'articleVolume' => $this->Article->getArticleVolume($this->user['id']),
		));
	}
}