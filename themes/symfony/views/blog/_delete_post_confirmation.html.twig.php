<!-- {# Bootstrap modal, see http://getbootstrap.com/javascript/#modals #} -->
<div class="modal fade" id="confirmationModal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h4><?= Yii::t('messages', 'delete_post_modal.title') ?></h4>
				<p><?= Yii::t('messages', 'delete_post_modal.body') ?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" id="btnNo" data-dismiss="modal">
					<i class="fa fa-ban" aria-hidden="true"></i> <?= Yii::t('messages', 'label.cancel') ?>
				</button>
				<button type="button" class="btn btn-danger" id="btnYes" data-dismiss="modal">
					<i class="fa fa-trash" aria-hidden="true"></i> <?= Yii::t('messages', 'label.delete_post') ?>
				</button>
			</div>
		</div>
	</div>
</div>