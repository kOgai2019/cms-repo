<?php if(h($this->Session->read('Auth')['User']['user_auth_type_id']) == 1): ?>

		<?php echo $this->Form->create('category', array('type' => 'post', 'url' => '/category/add')); ?>
			<div class="input-group p-3 mb-2">
				<?php echo $this->Form->input('category.name', array('label' => false, 'class' => 'form-control', 'div' => false, 'placeholder' => 'カテゴリを追加')); ?>
				<div class="input-group-append">
					<?php echo $this->Form->button('追加', array('class' => 'btn btn-outline-secondary', 'div' => false)); ?>
				</div>
			</div>
		<?php echo $this->Form->end(); ?>
	<div class="container">
		<table class="table">
			<th>名前</th>
			<th>登録件数</th>
			<th></th>
			<?php foreach($categories as $category): ?>
				<tr>
					<td>
						<?php echo $category['Category']['name']; ?>
					</td>
					<td><?php echo h(count($category['Article'])); ?></td>
					<td><?php echo $this->Html->link('削除', array('controller' => 'category', 'action' => 'delete', $category['Category']['id'])); ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
<?php elseif(h($this->Session->read('Auth')['User']['user_auth_type_id']) == 2): ?>
	<div class="text-right p-3">
		<?php echo $this->Html->link('<small>記事を作成する</small>', array('controller' => 'article', 'action' => 'add'), array('escape' => false)); ?>
	</div>
	<div class="container">
		<div class="row">
			<?php foreach($articles as $article): ?>
				<div class="col-4 mb-3">

					<div class="card">
						<?php if(!empty($article['Article']['filename'])): ?>
							<img class="card-img-top"src="<?php echo PUBLIC_DIR . ARTICLE_TUMBNAIL_PATH . $article['Article']['filename']; ?>" style="width: 100%; height: 200px; object-fit: cover;"></img>
						<?php else: ?>
							<?php echo $this->Html->image(MATERIAL_PATH . 'not_found.png', array('class' => 'card-img-top', 'style' => 'width: 100%; height: 200px; object-fit: cover;')); ?>
						<?php endif; ?>
						<div class="card-body">
							<p class="card-text">
								<?php echo $this->Html->link('<b>' . h($article['Article']['title']). '</b>', array('controller' => 'article', 'action' => 'input', 'articleId' => $article['Article']['id']), array('escape' => false));?>
							</p>
							<div class=text-right>
								<?php echo $this->Html->link('<small>削除</small>', array('controller' => 'article', 'action' => 'delete', $article['Article']['id']), array('escape' => false));?>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="text-center p-4">
		<?php echo $this->Paginator->numbers(array('first' => 'First page')); ?>
	</div>
<?php endif?>