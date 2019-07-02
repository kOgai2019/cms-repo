<?php

class ArticlesCategory extends AppModel
{
	public function saveCategory($articleId, array $categoryIds)
	{
		$category = array(
			'ArticlesCategory' => array(
				'article_id' => $articleId,
				'category_id' => null 
			)
		);
		foreach($categoryIds as $categoryId){
			$category['ArticlesCategory']['category_id'] = $categoryId;
			$this->create();
			
			if(!is_array($this->save($category, false))){
				return false;
			}
		}
		return true;
	}
}