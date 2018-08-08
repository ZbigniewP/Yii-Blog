<?php

Yii::app()->name = 'Symfony Blog Demo';

class DemoCommentController extends Controller
{
	public $layout='column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		## perform access control for CRUD operations
		return ['accessControl'];
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return [
			## allow authenticated users to access all actions
			['allow', 'users'=>['@'] ],
			## deny all users
			['deny', 'users'=>['*']],
		];
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model = $this->loadModel();
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if (isset($_POST['DemoComment'])) {

			$model->attributes = $_POST['DemoComment'];
			if ($model->save())
				$this->redirect(['index']);
		}

		$this->render('//comment/update', ['model' => $model]);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if (Yii::app()->request->isPostRequest) {
			## we only allow deletion via POST request
			$this->loadModel()->delete();

			## if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_POST['ajax']))
				$this->redirect(['index']);
		} else
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('DemoComment', [
			'criteria' => [
				'with' => 'post',
				'order' => 't.status, t.publishedAt DESC',
			],
		]);
		$this->render('//comment/index', ['dataProvider' => $dataProvider]);
	}

	/**
	 * Approves a particular comment.
	 * If approval is successful, the browser will be redirected to the comment index page.
	 */
	public function actionApprove()
	{
		if (Yii::app()->request->isPostRequest) {
			$comment = $this->loadModel();
			$comment->approve();
			$this->redirect(['index']);
		} else
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if ($this->_model === null) {
			if (isset($_GET['id']))
				$this->_model = DemoComment::model()->findbyPk($_GET['id']);
			if ($this->_model === null)
				throw new CHttpException(404, 'The requested page does not exist.');
		}
		return $this->_model;
	}
}