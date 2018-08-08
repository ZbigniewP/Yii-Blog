<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// namespace App\Controller\Admin;

// use App\Entity\Post;
// use App\Form\PostType;
// use App\Repository\PostRepository;
// use App\Utils\Slugger;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\Form\Extension\Core\Type\SubmitType;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller used to manage blog contents in the backend.
 *
 * Please note that the application backend is developed manually for learning
 * purposes. However, in your real Symfony application you should use any of the
 * existing bundles that let you generate ready-to-use backends without effort.
 *
 * See http://knpbundles.com/keyword/admin
 *
 * @Route("/admin/post")
 * @Security("has_role('ROLE_ADMIN')")
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */

Yii::app()->defaultController = 'Blog';
Yii::app()->layout = 'base.html.twig';
// Yii::app()->name = 'Admin Symfony';
Yii::app()->theme = 'symfony';
Yii::app()->language = 'pl';
// Yii::app()->name = Yii::t('messages', 'menu.admin');
// Yii::app()->errorHandler->errorAction='//bundles/TwigBundle/Exception/error.html.twig';
// echo "<pre>";
// print_r(Yii::app()->errorHandler->errorAction);
// echo "</pre>";
// exit();
// class BlogController extends AbstractController
class BlogController extends Controller
{
	public $layout = '//layouts/base.html.twig';
	// public $layout = '//layouts/default.ctp';
	// public $layout = 'column2';

	public function getPageTitle()
	{
		if($this->action->id==='index')
			return Yii::t('messages', 'menu.admin');
		else
			return Yii::t('messages', 'menu.admin').' - '.ucfirst($this->action->id);
	}

	public function init()
	{
		$this->menu = ['item' => [
			['label' => Yii::t('messages', 'menu.back_to_blog'), 'url' => 'symfony/blog/index'],
			['label' => Yii::t('messages', 'menu.post_list'), 'url' => 'symfony/admin/blog/index']
		]];

		$this->breadcrumbs = [
			Yii::t('messages', 'menu.back_to_blog') => '/symfony/blog/index',
			Yii::t('messages', 'menu.post_list') => '/symfony/admin/blog/index',
		];
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	 */

	/**
	 * Lists all Post entities.
	 *
	 * This controller responds to two different routes with the same URL:
	 *   * 'admin_post_index' is the route with a name that follows the same
	 *     structure as the rest of the controllers of this class.
	 *   * 'admin_index' is a nice shortcut to the backend homepage. This allows
	 *     to create simpler links in the templates. Moreover, in the future we
	 *     could move this annotation to any other controller while maintaining
	 *     the route name and therefore, without breaking any existing link.
	 *
	 * @Route("/", methods={"GET"}, name="admin_index")
	 * @Route("/", methods={"GET"}, name="admin_post_index")
	 */
	// public function index(PostRepository $posts): Response
	// {
	// 	$authorPosts = $posts->findBy(['author' => $this->getUser()], ['publishedAt' => 'DESC']);

	// 	return $this->render('admin/blog/index.html.twig', ['posts' => $authorPosts]);
	// }
	public function actionIndex()
	{
		$criteria = new CDbCriteria([
			// 'condition' => ['author' => Yii::app()->user->name],
			// 'condition' => ['author_id' => Yii::app()->user->id],
			// 'condition' => 'author_id=3',
			'order' => 'publishedAt DESC',
			'with' => 'author',//'author'=>array('select'=>'id, name'),
			//'with' => $this->paginate['contain']
		]);

		$count = DemoPost::model()->count($criteria);
		$pages = new CPagination($count);

		## results per page
		$pages->pageSize = 5;//$this->paginate['limit'];
		$pages->applyLimit($criteria);
		$authorPosts = DemoPost::model()->findAll($criteria);
		// $authorPosts = DemoPost::model()->findByAttributes(['author' => $this->getUser()]);

		$this->render('//admin/blog/index.html.twig', [
			'posts' => $authorPosts,
			'pages' => $pages
		]);
		// $this->render('//admin/layout.html.twig');
	}

	/**
	 * Creates a new Post entity.
	 *
	 * @Route("/new", methods={"GET", "POST"}, name="admin_post_new")
	 *
	 * NOTE: the Method annotation is optional, but it's a recommended practice
	 * to constraint the HTTP methods each controller responds to (by default
	 * it responds to all methods).
	 */
	// public function new(Request $request): Response
	// {
	// 	$post = new Post();
	// 	$post->setAuthor($this->getUser());

	// 	// See https://symfony.com/doc/current/book/forms.html#submitting-forms-with-multiple-buttons
	// 	$form = $this->createForm(PostType::class, $post)
	// 		->add('saveAndCreateNew', SubmitType::class);

	// 	$form->handleRequest($request);

	// 	// the isSubmitted() method is completely optional because the other
	// 	// isValid() method already checks whether the form is submitted.
	// 	// However, we explicitly add it to improve code readability.
	// 	// See https://symfony.com/doc/current/best_practices/forms.html#handling-form-submits
	// 	if ($form->isSubmitted() && $form->isValid()) {
	// 		$post->setSlug(Slugger::slugify($post->getTitle()));

	// 		$em = $this->getDoctrine()->getManager();
	// 		$em->persist($post);
	// 		$em->flush();

	// 		// Flash messages are used to notify the user about the result of the
	// 		// actions. They are deleted automatically from the session as soon
	// 		// as they are accessed.
	// 		// See https://symfony.com/doc/current/book/controller.html#flash-messages
	// 		$this->addFlash('success', 'post.created_successfully');

	// 		if ($form->get('saveAndCreateNew')->isClicked()) {
	// 			return $this->redirectToRoute('admin_post_new');
	// 		}

	// 		return $this->redirectToRoute('admin_post_index');
	// 	}

	// 	return $this->render('admin/blog/new.html.twig', [
	// 		'post' => $post,
	// 		'form' => $form->createView(),
	// 	]);
	// }
	public function actionNew()
	{
		$model = new DemoPost;
		if (isset($_POST['DemoPost'])) {
			$model->attributes = $_POST['DemoPost'];
			if ($model->save())
				$this->redirect(['view', 'id' => $model->id]);
		}
		// Yii::app()->viewPath='./themes/symfony/views';
		$this->render('//admin/blog/new.html.twig', ['model' => $model]);

		// $this->renderText('<pre>'.print_r(Yii::app()->viewPath,true).'</pre>');
		// $this->renderText('<a href="javascript:history.back();">-:[BACK]:-</a>');
	}

	/**
	 * Finds and displays a Post entity.
	 *
	 * @Route("/{id<\d+>}", methods={"GET"}, name="admin_post_show")
	 */
	// public function show(Post $post): Response
	// {
	// 	// This security check can also be performed
	// 	// using an annotation: @IsGranted("show", subject="post")
	// 	$this->denyAccessUnlessGranted('show', $post, 'Posts can only be shown to their authors.');

	// 	return $this->render('admin/blog/show.html.twig', [
	// 		'post' => $post,
	// 	]);
	// }
	public function actionShow($id)
	{
		if (isset($id)) {
			$post = DemoPost::model()->with(['comments', 'symfonyDemoTags'])->findByPk($id);
			// $post = DemoPost::model()->with(['comments', 'symfonyDemoTags'])->findByAttributes(['slug' => $slug]);
		}
		$this->render('//admin/blog/show.html.twig', ['post' => $post]);
	}

	/**
	 * Displays a form to edit an existing Post entity.
	 *
	 * @Route("/{id<\d+>}/edit",methods={"GET", "POST"}, name="admin_post_edit")
	 * @IsGranted("edit", subject="post", message="Posts can only be edited by their authors.")
	 */
	// public function edit(Request $request, Post $post): Response
	// {
	// 	$form = $this->createForm(PostType::class, $post);
	// 	$form->handleRequest($request);

	// 	if ($form->isSubmitted() && $form->isValid()) {
	// 		$post->setSlug(Slugger::slugify($post->getTitle()));
	// 		$this->getDoctrine()->getManager()->flush();

	// 		$this->addFlash('success', 'post.updated_successfully');

	// 		return $this->redirectToRoute('admin_post_edit', ['id' => $post->getId()]);
	// 	}

	// 	return $this->render('admin/blog/edit.html.twig', [
	// 		'post' => $post,
	// 		'form' => $form->createView(),
	// 	]);
	// }
	public function actionEdit($id)
	{
		if (isset($id)) {
			$post = DemoPost::model()->with(['comments', 'symfonyDemoTags'])->findByPk($id);
		}
		$this->render('//admin/blog/edit.html.twig', ['post' => $post]);
	}

	/**
	 * Deletes a Post entity.
	 *
	 * @Route("/{id}/delete", methods={"POST"}, name="admin_post_delete")
	 * @IsGranted("delete", subject="post")
	 *
	 * The Security annotation value is an expression (if it evaluates to false,
	 * the authorization mechanism will prevent the user accessing this resource).
	 */
	// public function delete(Request $request, Post $post): Response
	// {
	// 	if (!$this->isCsrfTokenValid('delete', $request->request->get('token'))) {
	// 		return $this->redirectToRoute('admin_post_index');
	// 	}

	// 	// Delete the tags associated with this blog post. This is done automatically
	// 	// by Doctrine, except for SQLite (the database used in this application)
	// 	// because foreign key support is not enabled by default in SQLite
	// 	$post->getTags()->clear();

	// 	$em = $this->getDoctrine()->getManager();
	// 	$em->remove($post);
	// 	$em->flush();

	// 	$this->addFlash('success', 'post.deleted_successfully');

	// 	return $this->redirectToRoute('admin_post_index');
	// }
	public function actionDelete()
	{
		$this->renderText('<a href="javascript:history.back();">-:[BACK]:-</a>');
	}
}
