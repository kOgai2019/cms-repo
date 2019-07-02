<?php

class MailCue extends AppModel
{
	/**
	 * cueにメールとキーを保存するキ
	 */
	public function saveCue(string $key, string $email)
	{
		return is_array($this->save(array(
			'MailCue' => array(
			'secret' => $key,
			'email' => $email
			)
		), false));
	}
}