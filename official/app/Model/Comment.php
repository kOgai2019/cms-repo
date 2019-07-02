<?php
class Comment extends AppModel
{
	/**
	 * コメントを保存する
	 */
	public function saveComment($articleId, array $comment)
	{
		$comment['article_id'] = $articleId;
		return is_array($this->save(array(
			'Comment' => $comment
		), false));
	}
}