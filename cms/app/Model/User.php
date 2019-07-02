<?php

class User extends AppModel
{
	/**
	 * ユーザーを登録
	 */
	public function saveUser(string $name, string $password, string $email, string $userTypeId)
	{
		$authType = 2;
		switch ($userTypeId) {
		 	case 0:
				$authType = 2;
		 		break;
		 	
		 	case 1:
				$authType = 1;
		 		break;
	 	}

		return is_array($this->save(array('User' => array(
			'name' => $name,
			'password' => $password,
			'email' =>  $email,
			'user_auth_type_id' => $authType
		))));
	}
}