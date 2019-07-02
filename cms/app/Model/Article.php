<?php

class Article extends AppModel
{

	public $hasAndBelongsToMany = array(
		'Category' => array(
			'className' => 'Category',
			'joinTable' => 'articles_categories',
			'foreignKey' => 'article_id',
			'associationForeignKey' => 'category_id'
		)
	);

	/**
	 * ユーザーの編集した記事数の取得
	 */
	public function getArticleVolume($user_id)
	{
		return $this->find('count', array(
			'conditions' => array(
				'user_id' => $user_id,
				'delete_flg' => 0
			)
		));
	}

	/**
	 * 記事の保存
	 */
	public function saveArticle($userId, array $article, $filename)
	{
		$article['filename'] = $filename;
		$article['user_id'] = $userId;
		return is_array($this->save($article, false));
	}

	/**
	 * 記事の更新
	 */
	public function updateArticle($articleId, array $article, $filename)
	{
		if($filename !== null){
			$article['filename'] = $filename;
		} else {
			unset($article['filename']);
		}
		$article['id'] = $articleId;
		return is_array($this->save($article, false));
	}


	/**
	 * 記事の削除
	 */
	public function deleteArticle($articleId)
	{
		$article = array(
			'id' => $articleId,
			'delete_flg' => 1
		);
		return is_array($this->save($article, false));
	}

	/**
	 * サムネイルの削除
	 */
	public function deleteArticleImage($articleId)
	{
		$article = array(
			'id' => $articleId,
			'filename' => null
		);
		return is_array($this->save($article, false));
	}

	/**
	 * Pagenator設定
	 */
	public function getPagenatorSetting($user_id)
	{
		return array(
			'limit' => 20,
			'order' => array(
				'Article.created' => 'desc'
			),
			'conditions' => array(
				'user_id' => $user_id,
				'delete_flg' => 0
			)
		);
	}
}