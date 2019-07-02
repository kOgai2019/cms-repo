<div class="text-center mb-3">
	<?php if(!empty($articles[0]['Article']['filename'])): ?>
		<img class="card-img-top"src="<?php echo PUBLIC_DIR . ARTICLE_TUMBNAIL_PATH . $articles[0]['Article']['filename']; ?>" style="width: 100%; height: 200px; object-fit: cover;"></img>
	<?php endif; ?>
	<?php if(!empty($articles[0])): ?>
		<?php echo $this->Html->link('<b>' . h($articles[0]['Article']['title']). '</b>', array('controller' => 'article', 'action' => 'view', 'articleId' => $articles[0]['Article']['id']), array('escape' => false));?>
	<?php endif; ?>
</div>
<hr>
<div class="container">
	<div class="row">
		<?php foreach($articles as $key => $article): ?>
			<?php if($key === 0): ?>
				<?php continue;?>
			<?php endif; ?>
			<div class="col-3 mb-3">
				<div class="card">
					<?php if(!empty($article['Article']['filename'])): ?>
						<img class="card-img-top"src="<?php echo PUBLIC_DIR . ARTICLE_TUMBNAIL_PATH . $article['Article']['filename']; ?>" style="width: 100%; height: 200px; object-fit: cover;"></img>
					<?php endif; ?>
					<div class="card-body">
						<p class="card-text">
							<?php echo $this->Html->link('<b>' . h($article['Article']['title']). '</b>', array('controller' => 'article', 'action' => 'view', 'articleId' => $article['Article']['id']), array('escape' => false));?>
						</p>
						<hr>
						<p class="card-text">
							<?php foreach($article['Category'] as $category): ?>
							<small class="badge-info rounded"><?php echo h($category['name']); ?></small>
							<?php endforeach; ?>
						</p>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<div class="text-center p-4">
	<?php echo $this->Paginator->numbers(array('first' => 'First page')); ?>
</div>