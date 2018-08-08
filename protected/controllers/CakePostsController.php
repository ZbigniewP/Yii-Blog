<?php

Yii::app()->name='Cake Blog Demo';

class CakePostsController extends Controller
{
	// public $layout = 'default.ctp';
	public $layout = 'column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array(
				'allow',  // allow all users to access 'index' and 'view' actions.
				'actions' => array('index', 'view'),
				'users' => array('*'),
			),
			array(
				'allow', // allow authenticated users to access all actions
				'users' => array('@'),
			),
			array(
				'deny',  // deny all users
				'users' => array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$post = $this->loadModel();
		$comment = $this->newComment($post);

		$this->render('view', array('model' => $post, 'comment' => $comment));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new CakePosts;
		if (isset($_POST['CakePosts'])) {
			$model->attributes = $_POST['CakePosts'];
			if ($model->save())
				$this->redirect(array('view', 'id' => $model->id));
		}

		$this->render('//cakepost/create', array('model' => $model));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model = $this->loadModel();
		if (isset($_POST['CakePosts'])) {
			$model->attributes = $_POST['CakePosts'];
			if ($model->save())
				$this->redirect(array('view', 'id' => $model->id));
		}

		$this->render('//cakepost/update', array('model' => $model));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax']))
				$this->redirect(array('index'));
		} else
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria = new CDbCriteria([
			'condition' => 'status=' . CakePosts::STATUS_PUBLISHED,
			// 'order' => 'updated DESC',
			'order' => 'created DESC',
			// 'with' => 'commentCount',
			'with' => ['category', 'user']
		]);
		if (isset($_GET['tag']))
			$criteria->addSearchCondition('category_id', $_GET['tag']);

		$dataProvider = new CActiveDataProvider('CakePosts', [
			'pagination' => array('pageSize' => 2),//Yii::app()->params['postsPerPage']
			'criteria' => $criteria,
		]);

		$this->render('//post/index', ['dataProvider' => $dataProvider]);
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new CakePosts('search');
		if (isset($_GET['Post']))
			$model->attributes = $_GET['Post'];
		$this->render('admin', ['model' => $model]);
	}

	/**
	 * Suggests tags based on the current user input.
	 * This is called via AJAX when the user is entering the tags input.
	 */
	public function actionSuggestCategory()
	{
		if (isset($_GET['q']) && ($keyword = trim($_GET['q'])) !== '') {
			$category = CakeCategories::model()->suggestCategory($keyword);
			if ($category !== array())
				echo implode("\n", $category);
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if ($this->_model === null) {
			if (isset($_GET['id'])) {
				if (Yii::app()->user->isGuest)
					$condition = 'status=' . CakePosts::STATUS_PUBLISHED . ' OR status=' . CakePosts::STATUS_ARCHIVED;
				else
					$condition = '';
				$this->_model = CakePosts::model()->findByPk($_GET['id'], $condition);
			}
			if ($this->_model === null)
				throw new CHttpException(404, 'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Creates a new comment.
	 * This method attempts to create a new comment based on the user input.
	 * If the comment is successfully created, the browser will be redirected
	 * to show the created comment.
	 * @param CakePost the post that the new comment belongs to
	 * @return CakeComment the comment instance
	 */
	protected function newComment($post)
	{
		$comment = new CakeComments;
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'comment-form') {
			echo CActiveForm::validate($comment);
			Yii::app()->end();
		}
		if (isset($_POST['CakeComments'])) {
			$comment->attributes = $_POST['CakeComments'];
			if ($post->addComment($comment)) {
				if ($comment->status == CakeComments::STATUS_PENDING)
					Yii::app()->user->setFlash('commentSubmitted', 'Thank you for your comment. Your comment will be posted once it is approved.');
				$this->refresh();
			}
		}
		return $comment;
	}

	/**
	 * Get posts by category
	 * @param string $slug wanted slug
	 * @return void
	 */
	public function category($slug)
	{
		// $posts = $this->paginate($this->Posts->find()->where(['Categories.slug' => $slug]));

		// $this->set(compact('posts'));
		// $this->set('_serialize', ['posts']);
		// $this->render('index');

		$criteria = new CDbCriteria(array(
			'condition' => 'status=' . CakePosts::STATUS_PUBLISHED,
			// 'order' => 'updated DESC',
			'order' => 'created DESC',
			// 'with' => 'commentCount',
			'with' => array('category', 'user')
		));
		$criteria->addSearchCondition('slug', $slug);

		$dataProvider = new CActiveDataProvider('CakePosts', array(
			'pagination' => array('pageSize' => 5),//Yii::app()->params['postsPerPage']
			'criteria' => $criteria,
		));
	}
}