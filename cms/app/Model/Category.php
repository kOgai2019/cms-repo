<?php

class Category extends AppModel
{
	public $hasAndBelongsToMany = array(
		'Article' => array(
			'className' => 'Article',
			'joinTable' => 'articles_categories',
			'foreignKey' => 'category_id',
			'associationForeignKey' => 'article_id'
		)
	);
	public function saveCategory($category)
	{
		return is_array($this->save(array(
			'Category' => array(
				'name' => $category
			)
		), false));
	}
}