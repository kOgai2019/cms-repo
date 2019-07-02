<?php echo $this->Form->create('user', array('type' => 'post')); ?>
	<div align="center" class="mt-2">
		<?php echo $this->Form->input('user.email', array('required' => true, 'class' => 'form-control', 'label' => false, 'placeholder' => 'メールアドレス', 'maxLength' => '40', 'style' => 'width:20em')); ?>
	</div>
	<div align="center" class="mt-3">
		<?php echo $this->Form->submit('仮登録', array('class' => 'form-control', 'style' => 'width:6em')); ?>
	</div>

<?php echo $this->Form->end(); ?>
