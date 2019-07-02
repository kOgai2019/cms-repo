<?php

class ArticleController extends AppController
{
	public $uses = array('Article', 'ArticlesCategory', 'Category');

	public $imageLimit = 1024 * 1024;

	public function beforeFilter()
	{
		$this->user = $this->Auth->user();
	}

	/**
	 * 記事の追加
	 */
	public function add()
	{
		$selectedArticle = $this->request->data('article');
		if($this->request->is('post') && !empty($selectedArticle)){
			try{
				$selectedFilename = null;
				if (!empty($selectedArticle['filename']['tmp_name'])){
					$fileExt = pathinfo($selectedArticle['filename']['name'])['extension'];
					if (!$this->checkExt($fileExt)){
						throw new Exception('jpg・png・gif以外の画像をアップロード出来ません。');
					}
					$selectedFilename = CakeText::uuid() . '.' . $fileExt;
					if ($selectedArticle['filename']['size'] > $this->imageLimit){
						throw new Exception('1MB以内の画像が登録可能です。');
					}
					$tmpName = $selectedArticle['filename']['tmp_name'];
					if (!is_uploaded_file($tmpName)){
						throw new Exception('アップロードされた画像ではありません。');
					}
					move_uploaded_file($tmpName, BASE_DIR . PUBLIC_DIR . ARTICLE_TUMBNAIL_PATH . $selectedFilename);
					chmod(BASE_DIR . PUBLIC_DIR . ARTICLE_TUMBNAIL_PATH . $selectedFilename, 0755);
				}
				$this->Article->saveArticle($this->user['id'], $selectedArticle, $selectedFilename);

				$selectedCategories = $selectedArticle['category'];
				if(!empty($selectedCategories)){
					$this->ArticlesCategory->saveCategory($this->Article->getLastInsertID(), $selectedCategories);
				}
				$this->redirect(array('controller' => 'top', 'action' => 'index'));
				// DB保存
			} catch(Exception $e){
				$error = $e->getMessage();
				if (empty($error)){
					$error = 'なんらかの不具合が発生しました。システム管理者にお問い合わせください。';
				}
				$this->Flash->error($error);
			}
		}
		$this->set(array(
			'categories' => $this->Category->find('list')
		));
	}

	/**
	 * 記事の編集
	 */
	public function input($articleId)
	{
		$article = $this->Article->findById($articleId);
		if (empty($article)){
			$this->redirect(array('controller' => 'top', 'action' => 'index'));
		}
		$selectedArticle = $this->request->data('article');
		if($this->request->is('post') && !empty($selectedArticle)){
			// ファイルがアップロードされたか確認
			try{
				$selectedFilename = null;
				if (!empty($selectedArticle['filename']['tmp_name'])){
					$fileExt = pathinfo($selectedArticle['filename']['name'])['extension'];
					if (!$this->checkExt($fileExt)){
						throw new Exception('jpg・png・gif以外の画像をアップロード出来ません。');
					}
					$selectedFilename = CakeText::uuid() . '.' . $fileExt;
					if ($selectedArticle['filename']['size'] > $this->imageLimit){
						throw new Exception('1MB以内の画像が登録可能です。');
					}
					$tmpName = $selectedArticle['filename']['tmp_name'];
					if (!is_uploaded_file($tmpName)){
						throw new Exception('アップロードされた画像ではありません。');
					}
					move_uploaded_file($tmpName, BASE_DIR . PUBLIC_DIR . ARTICLE_TUMBNAIL_PATH . $selectedFilename);
					chmod(BASE_DIR . PUBLIC_DIR . ARTICLE_TUMBNAIL_PATH . $selectedFilename, 0755);
					// 既存ファイルを消す
					$filepath = BASE_DIR . PUBLIC_DIR . ARTICLE_TUMBNAIL_PATH . $article['Article']['filename'];
					if(!empty($article['Article']['filename']) && file_exists($filepath)){
						unlink($filepath);
					}
				}
				$selectedCategories = $selectedArticle['category'];
				if(!empty($selectedCategories)){
					$this->ArticlesCategory->deleteAll(array('article_id' => $articleId));
				}
				$this->Article->saveAll(array(
					'Article' => array(
						'id' => $articleId,
						'title' => $selectedArticle['title'],
						'sentense' => $selectedArticle['sentense'],
						'filename' => $selectedFilename
					),
					'Category' => $selectedCategories
				));

				$this->redirect(array('controller' => 'top', 'action' => 'index'));
			} catch(Exception $e){
				$error = $e->getMessage();
				if (empty($error)){
					$error = 'なんらかの不具合が発生しました。システム管理者にお問い合わせください。';
				}
				$this->Flash->error($error);
			}
		}
		$this->set(array(
			'article' => $article,
			'categories' => $this->Category->find('list'),
			'savedCategories' => hash::extract($article, 'Category.{n}.id')
		));
	}

	/**
	 * 記事の削除
	 */
	public function delete($articleId)
	{
		try {
			$article = $this->Article->findById($articleId);
			if (empty($article)){
				throw new Exception('記事が存在しません。');
			}
			$filename = $article['Article']['filename'];
			if(!$this->Article->deleteArticle($articleId)){
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

	/**
	 * 画像のみを削除する
	 */
	public function imageDelete($articleId)
	{
		try {
			$article = $this->Article->findById($articleId);
			if (empty($article)){
				throw new Exception('記事が存在しません。');
			}
			$filename = $article['Article']['filename'];
			if (empty($filename)){
				throw new Exception('画像ファイルが存在しません。');
			}

			$filepath = BASE_DIR . PUBLIC_DIR . ARTICLE_TUMBNAIL_PATH . $filename;
			if(file_exists($filepath)){
				unlink($filepath);
			}
			if(!$this->Article->deleteArticleImage($articleId)){
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

	private function checkExt($ext)
	{
		$checkExts = array(
			'jpg',
			'jpeg',
			'png',
			'gif'
		);
		return in_array($ext, $checkExts);
	}
}