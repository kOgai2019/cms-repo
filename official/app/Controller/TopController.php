<?php

class TopController extends AppController
{
	public $uses = array('Article');
	public $components = array('Paginator');

	public function index()
	{
		$this->Paginator->settings = $this->Article->getPagenatorSetting();
		$this->set(array(
			'articles' => $this->Paginator->paginate('Article'),
		));
	}
}