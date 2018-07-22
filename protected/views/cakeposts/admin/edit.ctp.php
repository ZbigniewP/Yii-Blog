<h1>Edit post</h1>

<p><?= CHtml::link('< Back to posts', ['controller' => 'Admin', 'action' => 'index']) ?></p>

<?= $this->Form->create($post); ?>
<div class="row">
    <div class="col-md-6 span-12">
        <?= $this->Form->control('name', ['class' => 'form-control', 'label' => 'Name :']) ?>
    </div>
    <div class="col-md-6 span-12">
        <?= $this->Form->control('slug', ['class' => 'form-control', 'label' => 'Slug :']) ?>
    </div>
    <!-- <div class="col-md-6 span-12">
        <?= $this->Form->control('tags', ['class' => 'form-control', 'label' => 'Tags :']) ?>
    </div> -->
</div>
<div class="row">
    <div class="col-md-6 span-12">
        <?= $this->Form->control('category_id', ['class' => 'form-control', 'label' => 'Category :']) ?>
    </div>
    <!-- <div class="col-md-6 span-12">
        <?= $this->Form->control('status', ['class' => 'form-control', 'label' => 'Status :']) ?>
    </div> -->
    <div class="col-md-6 span-12">
        <?= $this->Form->control('user_id', ['class' => 'form-control', 'label' => 'Author :']) ?>
    </div>
</div>
<?= $this->Form->control('content', ['class' => 'form-control', 'label' => 'Content :']) ?>
<div class="submit">
    <input class="btn btn-primary" type="submit" value="Edit">
</div>
<?= $this->Form->end(); ?>
