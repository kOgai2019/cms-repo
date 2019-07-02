<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class AccountController extends AppController
{
	public $uses = array('MailCue');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->user = $this->Auth->user();
		$this->Auth->allow('receptionist', 'signup', 'login', 'logout');
	}

	/**
	 * ログイン
	 */
	public function login()
	{
		if($this->request->is('post')){
			if($this->Auth->login()){
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->Flash->error('ログインに失敗しました。');
			}
		}
	}

	/**
	 * ログアウト
	 */
	public function logout()
	{
		$this->redirect($this->Auth->logout());
	}

	/**
	 * 登録受付
	 */
	public function receptionist()
	{
		$address = $this->request->data('user.email');
		if($this->request->is('post') && !empty($address)){
			// すでにアカウント登録されている場合は仮登録させない
			try{
				if ($this->User->hasAny(array('email' => $address))){
					throw new Exception('既に登録されているメールアドレスが入力されました。');
				}
				$key = CakeText::uuid();
				if (!$this->MailCue->saveCue($key, $address)){
					throw new Exception('仮登録に失敗しました。時間を空けて再度お試しください。');
				}
				$sentense = "cmsへ登録いただきありがとうございます。\ncmsでは本登録時にメールアドレスの認証をお願いしております。\nお手数ですが下記URLをクリックして表示される案内に沿ってお進み下さい。\n";
				$email = new CakeEmail('gmail');
				$email->from(array(APP_EMAIL_ADDRESS => 'cms運営'));
				$email->to($address);
				$email->subject('仮登録ありがとうございます。');
				$email->send($sentense . 'http://localhost:8888/cms/signup/' . $key);
				$this->Flash->default('本登録用のメールをお送りしました。ご確認ください。');
			} catch(Exception $e){
				$error = $e->getMessage();
				if (empty($error)){
					$error = 'なんらかの不具合が発生しました。システム管理者にお問い合わせください。';
				}
				$this->Flash->error($error);
			}
		}
	}

	/**
	 * アカウント新規登録
	 */
	public function signup($key)
	{
		try{
			$cue = $this->MailCue->findBySecret($key);
			if(empty($cue)){
				throw new Exception('本登録を行う場合は仮登録を行ってください。');
			}
			// 既にユーザー登録されていた場合
			if (!empty($this->User->findByEmail($cue['MailCue']['email']))){
				$this->MailCue->delete($cue['MailCue']['id']);
				throw new Exception('既に登録された可能性があります。');
			}
			$account = $this->request->data('user');
			if($this->request->is('post') && !empty($account)){
				$blowfish = new BlowfishPasswordHasher();
				if($this->User->saveUser($account['name'], $blowfish->hash($account['password']), $cue['MailCue']['email'], $account['user_auth_type_id'])){
					$this->MailCue->delete($cue['MailCue']['id']);
				};
				$this->redirect(array('controller' => 'account', 'action' => 'login'));
			}
		} catch(Exception $e){
			$error = $e->getMessage();
			if (empty($error)){
				$error = 'なんらかの不具合が発生しました。システム管理者にお問い合わせください。';
			}
			$this->Flash->error($error);
			$this->redirect(array('controller' => 'account', 'action' => 'receptionist'));
		}
		$this->set(array(
			'managerExists' => $this->User->hasAny(array('user_auth_type_id' => 1))
		));
	}
}