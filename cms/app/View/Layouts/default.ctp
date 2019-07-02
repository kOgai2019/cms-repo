<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('style');
		echo $this->Html->css('dropify.min');
		echo $this->Html->script('jq');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('dropify.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<style>
	html,body{
	    background-color:#eee;
	}
</style>
<body>
	<div id="container">
		<div id="content">

			<?php echo $this->Flash->render(); ?>
			<div class="p-3 float-left">
				<?php echo $this->Html->link('<small>CMS</small>', array('controller' => 'top', 'action' => 'index'), array('escape' => false)); ?>
			</div>
			<div class="p-3 text-right">
				<?php if(!empty($this->Session->read('Auth')['User'])): ?>
					<?php echo h($this->Session->read('Auth')['User']['name']); ?>
					<?php if(h($this->Session->read('Auth')['User']['user_auth_type_id']) == 1): ?>
						(管理者)
					<?php endif; ?>
					<?php echo $this->Html->link('<small>ログアウト</small>', array('controller' => 'account', 'action' => 'logout'), array('class' => 'p-3', 'escape' => false)); ?>
				<?php else: ?>
					<?php echo $this->Html->link('<small>アカウント作成</small>', array('controller' => 'account', 'action' => 'receptionist'), array('class' => 'p-3', 'escape' => false)); ?>
					<?php echo $this->Html->link('<small>ログイン</small>', array('controller' => 'account', 'action' => 'login'), array('class' => 'p-3', 'escape' => false)); ?>
				<?php endif; ?>
			</div>
			<hr>
			<div class="pt-5"></div>
			<div class="pt-5"></div>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<p>
				<?php //echo $cakeVersion; ?>
			</p>
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
