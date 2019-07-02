<?php

class CategoryController extends AppController
{
	public $uses = array('Category');
	/**
	 * カテゴリーの追加
	 */
	public function add()
	{
		$category = $this->request->data('category.name');
		if($this->request->is('post') && !empty($category)){
			$this->autoRender = false;
			$this->Category->saveCategory($category);
			$this->redirect(array('controller' => 'top', 'action' => 'index'));
		}
	}

	/**
	 * カテゴリーの削除
	 */
	public function delete($categoryId)
	{
		try {
			$category = $this->Category->findById($categoryId);
			if (empty($category)){
				throw new Exception('カテゴリーが存在しません。');
			}
			$this->loadModel('ArticlesCategory');
			if(!$this->ArticlesCategory->deleteAll(array('category_id' => '$categoryId'))){
				throw new Exception('削除に失敗しました。再度お試しください。');
			}
			if(!$this->Category->delete($categoryId)){
				throw new Exception('削除に失敗しました。再度お試しください。');
			}
		} catch(Exception $e) {
			$error = $e->getMessage();
			if (empty($error)){
				$error = 'なんらかの不具合が発生しました。システム管理者にお問い合わせください。';
			}
			$this->Flash->error($error);
		}
		$this->redirect(array('controller' => 'top', 'action' => 'index'));
	}
}