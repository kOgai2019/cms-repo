<?php echo $this->Form->create('user', array('type' => 'post')); ?>
	<div align="center">
		<?php echo $this->Form->input('user.name', array('required' => true, 'class' => 'form-control', 'label' => false, 'placeholder' => '名前(20字まで)', 'style' => 'width:20em', 'maxLength' => '20')); ?>
	</div>
	<div align="center" class="mt-2">
		<?php echo $this->Form->input('user.password', array('required' => true, 'class' => 'form-control', 'label' => false, 'placeholder' => 'パスワード(30字まで)', 'style' => 'width:20em', 'maxLength' => '30')); ?>
	</div>
	<?php if(!$managerExists): ?>
		<div align="center" class="mt-2">
			<?php echo $this->Form->input('user.user_auth_type_id', array('type' => 'checkbox', 'class' => 'form-check-input', 'label' => '<small>管理者として登録</small>')); ?>
		</div>
	<?php else: ?>
		<div align="center" class="mt-2">
			<?php echo $this->Form->input('user.user_auth_type_id', array('type' => 'checkbox', 'class' => 'form-check-input', 'label' => false, 'readonly' => true, 'hidden' => true)); ?>
		</div>
	<?php endif;?>
	<div align="center" class="mt-3">
		<?php echo $this->Form->submit('登録', array('class' => 'form-control', 'style' => 'width:6em')); ?>
	</div>
<?php echo $this->Form->end(); ?>