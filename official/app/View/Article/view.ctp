<div class="text-right p-3">
	<?php foreach($article['Category'] as $category): ?>
		<small class="badge-info ml-3 p-1 rounded">
			<?php echo h($category['name']); ?>
		</small>
	<?php endforeach; ?>
</div>
<?php if(!empty($article['Article']['filename'])): ?>
	<div class="text-center">
		<img class="card-img-top rounded"src="<?php echo PUBLIC_DIR . ARTICLE_TUMBNAIL_PATH . $article['Article']['filename']; ?>" style="height: 300px; width: auto;"></img>
	</div>
	<hr>
<?php endif; ?>
	<div class="text-center" style="font-size:2em;">
		<b><?php echo h($article['Article']['title']);?></b>
	</div>
<hr>
<div class="container">
	<div class="row">
		<div class="col-10 p-3">
			<?php echo $article['Article']['sentense']; ?>
			<hr>
			<?php echo $this->Form->create('comment', array('type' => 'post')); ?>
				<?php echo $this->Form->input('comment.name', array('required' => true, 'value' => '名無しさん', 'class' => 'form-control mb-2', 'label' => false, 'placeholder' => '名前')); ?>
				<?php echo $this->Form->textarea('comment.sentense', array('required' => true, 'class' => 'form-control mb-2', 'label' => false, 'placeholder' => '本文')); ?>
				<div align="right">
					<?php echo $this->Form->submit('書き込む', array('class' => 'form-control', 'style' => 'width:6em')); ?>
				</div>
			<?php echo $this->Form->end(); ?>
			<b>コメント</b>
			<table>
				<?php foreach($comments as $comment): ?>
					<th><?php echo h($comment['Comment']['name']);?></th>
					<tr>
						<td><?php echo h($comment['Comment']['sentense']);?></td>
					</tr>
				<?php endforeach; ?>
			</table>

		</div>
		<div class="col-2 border-left">
			<p>
				<b>ライター</b>
				<div>
					<?php echo h($article['User']['name']);?>
				</div>
				<div>
					<?php echo h($article['User']['email']);?>
				</div>
			</p>
			<hr>
			<p>
				<b>他の記事</b>
				<ol style="list-style:none;">
					<?php foreach($userArticles as $userArticle):?>
						<li class="pt-2 pb-2" style="border-bottom: dotted 1px;">
							<?php if(!empty($userArticle['Article']['filename'])): ?>
								<img class="card-img-top"src="<?php echo PUBLIC_DIR . ARTICLE_TUMBNAIL_PATH . $userArticle['Article']['filename']; ?>" style="width: 100%; height: 50px; object-fit: cover;"></img>
							<?php endif; ?>
							<?php echo $this->Html->link(h($userArticle['Article']['title']), array('controller' => 'article', 'action' => 'view', $userArticle['Article']['id'])); ?>
						</li>
					<?php endforeach;?>
				</ol>
			</p>
		</div>
	</div>
</div>
<hr>