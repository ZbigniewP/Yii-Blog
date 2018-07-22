<?php

// namespace App\Controller;

// use App\Model\Entity\Post;
// use App\Model\Table\PostsTable;
// use Cake\Datasource\Exception\RecordNotFoundException;
// use Cake\Event\Event;
// use Cake\Http\Response;
Yii::app()->name = 'Cake Blog Demo';
// Yii::app()->layout = 'default.ctp';
/**
 * Posts Controller
 *
 * @property PostsTable $Posts
 *
 * @method Post[] paginate($object = null, array $settings = [])
 */
// echo "<pre>";
// print_r(Yii::app());
// echo "</pre>";
// exit();
// class PostsController extends AppController
class PostCakeController extends Controller
{
	// public $layout = '//layouts/default.ctp';
	public $layout = 'column2';
	// public $layout = 'postcake';

	public $paginate = [
		'contain' => ['category', 'user'],
		'limit' => 5
	];

	public function initialize()
	{
		// $this->layout = 'postcake';
	}

	/**
	 * beforeFilter Event
	 * @param Event $event current event
	 * @return void
	 */
	public function filters()
	{
		## perform access control for CRUD operations
		return ['accessControl'];
	}

	/**
	 * Index method
	 * @return void
	 */
	// public function index()
	// {
	// 	$posts = $this->paginate($this->Posts);

	// 	$this->set(compact('posts'));
	// 	$this->set('_serialize', ['posts']);
	// }
	public function actionIndex()
	{
		$criteria = new CDbCriteria(['with' => $this->paginate['contain']]);
		$count = CakePosts::model()->count($criteria);
		$pages = new CPagination($count);

		## results per page
		$pages->pageSize = $this->paginate['limit'];
		$pages->applyLimit($criteria);
		$models = CakePosts::model()->findAll($criteria);

		// $this->renderText(Yii::app()->getViewPath());
		$this->render('/postcake/index.ctp', [
			'posts' => $models,
			'pages' => $pages
		]);
		// $criteria = new CDbCriteria([
		// 	// 'condition' => 'status=' . CakePosts::STATUS_PUBLISHED,
		// 	// 'order' => 'created DESC',
		// 	'with' => $this->paginate['contain']
		// ]);
		// // if (isset($_GET['tag']))
		// // 	$criteria->addSearchCondition('category_id', $_GET['tag']);

		// $dataProvider = new CActiveDataProvider('CakePosts', [
		// 	'pagination' => ['pageSize' => $this->paginate['limit']],
		// 	// 'criteria' => $criteria,
		// ]);
		// $this->render('index', ['dataProvider' => $dataProvider]);
	}

	/**
	 * Get posts by author
	 * @param int $id author Id
	 * @return void
	 */
	// public function author($id)
	// {
	// 	$posts = $this->paginate($this->Posts->find()->where(['Posts.user_id' => $id]));

	// 	$this->set(compact('posts'));
	// 	$this->set('_serialize', ['posts']);
	// 	$this->render('index');
	// }
	public function actionAuthor($id)
	{
		$criteria = new CDbCriteria(['condition' => 'user_id=' . $id]);
		$count = CakePosts::model()->count($criteria);
		$pages = new CPagination($count);

		## results per page
		$pages->pageSize = $this->paginate['limit'];
		$pages->applyLimit($criteria);
		$models = CakePosts::model()->findAll($criteria);

		$this->render('/postcake/index.ctp', [
			'posts' => $models,
			'pages' => $pages
		]);
	}

	/**
	 * Get posts by category
	 * @param string $slug wanted slug
	 * @return void
	 */
	// public function category($slug)
	// {
	// 	$posts = $this->paginate($this->Posts->find()->where(['Categories.slug' => $slug]));

	// 	$this->set(compact('posts'));
	// 	$this->set('_serialize', ['posts']);
	// 	$this->render('index');
	// }
	public function actionCategory($slug)
	{
		$criteria = new CDbCriteria(['with' => 'category', 'condition' => 'category.slug="'.$slug.'"']);
		$count = CakePosts::model()->count($criteria);
		$pages = new CPagination($count);
		## results per page
		$pages->pageSize = $this->paginate['limit'];
		$pages->applyLimit($criteria);

		$models = CakePosts::model()->findAll($criteria);

		$this->render('/postcake/index.ctp', [
			'posts' => $models,
			'pages' => $pages
		]);
	}

	/**
	 * View method
	 *
	 * @param string|null $slug Post slug.
	 * @return Response|void
	 * @throws RecordNotFoundException When record not found.
	 */
	// public function view($slug = null)
	// {
	// 	$errors = [];
	// 	$comment = $this->Posts->Comments->newEntity();
	// 	$this->Posts->Comments->_connection = 'db_cake';
	// 	if ($this->request->is(['post'])) {
	// 		$comment = $this->Posts->Comments->patchEntity($comment, $this->request->getData());
	// 		if ($this->Posts->Comments->save($comment)) {
	// 		}
	// 	}
	public function actionView($slug = null)
	{
		$criteria = new CDbCriteria(['with' => ['category', 'user', 'comments']]);
		if (isset($slug)) $criteria->addSearchCondition('t.slug', $slug );
		$models = CakePosts::model()->with(['category', 'user', 'comments'])->findAll($criteria);

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

		$this->render('/postcake/view.ctp', ['post' => $models[0], 'comment' => $comment]);
	}
	// 	$post = $this->Posts->find()->where(['Posts.slug' => $slug])->contain(['Categories', 'Users', 'Comments'])->first();
	// 	$this->set(compact('post', 'comment', 'errors'));
	// 	$this->set('_serialize', ['post']);
	// }
}
