<div class="container">
	<?php echo $this->Form->create('article', array('type' => 'post', 'enctype' => 'multipart/form-data')); ?>
		<?php echo $this->Form->input('article.title', array('required' => true, 'class' => 'form-control', 'label' => false, 'placeholder' => 'タイトル', 'value' => $article['Article']['title'], 'maxLength' => '30')); ?>
		<div class="text-right">
			<?php if(!empty($article['Article']['filename'])): ?>
				<?php echo $this->Html->link('<small>サムネイルを削除する</small>', array('controller' => 'article', 'action' => 'imageDelete', $article['Article']['id']), array('escape' => false)); ?>
			<?php endif; ?>
		</div>
		<?php if(!empty($article['Article']['filename'])): ?>
			<?php echo $this->Form->file('article.filename', array('class' => 'dropify', 'data-default-file' => PUBLIC_DIR . ARTICLE_TUMBNAIL_PATH . $article['Article']['filename'], 'data-show-remove' => 'false')); ?>
		<?php else: ?>
			<?php echo $this->Form->file('article.filename', array('class' => 'dropify', 'data-show-remove' => 'false')); ?>
		<?php endif; ?>
		<?php echo $this->Form->textarea('article.sentense', array('required' => true, 'class' => 'form-control', 'label' => false, 'placeholder' => '本文', 'value' => $article['Article']['sentense'])); ?>
		<?php echo $this->Form->select('article.category', array($categories), array('multiple' => true, 'class' => 'form-control mt-3', 'value' => $savedCategories))?>
		<div align="right" class="mt-3">
			<?php echo $this->Form->submit('投稿', array('class' => 'form-control', 'style' => 'width:6em')); ?>
		</div>
	<?php echo $this->Form->end(); ?>
</div>
<script>
	$(document).ready(function(){
		$('.dropify').dropify({
		messages: {
			'default': '画像をドラッグするか、クリックして下さい。',
			'replace': '画像をドラッグするか、クリックすることで画像の入れ替えができます。',
			'remove': '削除',
			'error': 'エラーが発生しました。'
		}
	});
});
</script>