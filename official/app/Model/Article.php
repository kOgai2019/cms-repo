<?php

class Article extends AppModel
{
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		)
	);


	public $hasAndBelongsToMany = array(
		'Category' => array(
			'className' => 'Category',
			'joinTable' => 'articles_categories',
			'foreignKey' => 'article_id',
			'associationForeignKey' => 'category_id'
		)
	);

	/**
	 * Pagenator設定
	 */
	public function getPagenatorSetting()
	{
		return array(
			'limit' => 20,
			'order' => array(
				'Article.created' => 'desc'
			),
			'conditions' => array(
				'delete_flg' => 0
			)
		);
	}

	/**
	 * ユーザーに関連した記事を取得する
	 */
	public function getUserArticle($userId)
	{
		return $this->find('all', array(
			'conditions' => array(
				'user_id' => $userId,
				'delete_flg' => 0
			),
			'order' => array(
				'Article.created' => 'desc'
			),
			'limit' => 10
		));
	}
}