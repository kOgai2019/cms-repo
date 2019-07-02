<?php echo $this->Form->create('user', array('type' => 'post')); ?>
	<div align="center">
		<?php echo $this->Form->input('user.email', array('required' => true, 'class' => 'form-control', 'label' => false, 'placeholder' => 'メールアドレス', 'style' => 'width:20em', 'maxLength' => '40')); ?>
	</div>
	<div align="center" class="mt-2">
		<?php echo $this->Form->input('user.password', array('required' => true, 'class' => 'form-control', 'label' => false, 'placeholder' => 'パスワード', 'style' => 'width:20em', 'maxLength' => '40')); ?>
	</div>
	<div align="center" class="mt-3">
		<?php echo $this->Form->submit('ログイン', array('class' => 'form-control', 'style' => 'width:6em')); ?>
	</div>
<?php echo $this->Form->end(); ?>