  <?php foreach ($models as $model) : ?>
 // display a model
  <?php endforeach; ?>
 
  // display pagination
  <?php
  $this->widget('CLinkPager', ['pages' => $pages]) ?>