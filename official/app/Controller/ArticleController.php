<?php
class ArticleController extends AppController
{
	public $uses = array('Article', 'Comment');
	/**
	 * 記事の詳細
	 */
	public function view($articleId)
	{
		$article = $this->Article->findById($articleId);
		if (empty($article)){
			$this->redirect(array('controller' => 'top', 'action' => 'index'));
		}
		$comment = $this->request->data('comment');
		if($this->request->is('post') && !empty($comment)){
			try{
				if(!$this->Comment->saveComment($articleId, $comment)){
					throw new Exception('コメントの書き込みに失敗しました。');
				}
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
			'userArticles' => $this->Article->getUserArticle($article['Article']['user_id']),
			'comments' => $this->Comment->findAllByArticleId($articleId)
		));
	}
}