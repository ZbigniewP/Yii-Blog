<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// namespace App\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Controller used to manage the application security.
 * See https://symfony.com/doc/current/cookbook/security/form_login_setup.html.
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
// class SecurityController extends AbstractController

Yii::app()->defaultController = 'Security';
Yii::app()->name = Yii::t('messages', 'title.login');
Yii::app()->theme = 'symfony';
// Yii::app()->language = 'pl';
// Yii::app()->layout = 'base.html.twig';
// Yii::app()->name = 'Symfony Blog Demo';

// $redirect_to = Yii::app()->user->returnUrl;
// public function setReturnUrl($value)
// public function getReturnUrl($defaultUrl=null)
class SecurityController extends Controller
{
	// public $layout = '//layouts/base.html.twig';
	// public $layout = '//layouts/default.ctp';
	// public $layout = 'column1';

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
			// ['label' => Yii::t('messages', 'menu.post_list'), 'url' => 'symfony/admin/blog/index']
		]];

		$this->breadcrumbs = [
			Yii::t('messages', 'menu.back_to_blog') => '/symfony/blog/index',
			// Yii::t('messages', 'menu.post_list') => '/symfony/admin/blog/index',
		];
		$this->layout = '//layouts/base.html.twig';
		// $this->layout = 'column1';
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return [
			## allow all users to access 'index' and 'view' actions.
			['allow', 'actions' => ['index'], 'users' => ['*']],
			## allow authenticated users to access all actions
			['allow', 'users' => ['@']],
			## deny all users
			['deny', 'users' => ['*']],
		];
	}

	## Uncomment the following methods and override them if needed
	/**
	 * @return array action filters
	 */
	// public function filters()
	// {
	// 	## perform access control for CRUD operations
	// 	return ['accessControl'];
	// 	## return the filter configuration for this controller, e.g.:
	// 	// return ['inlineFilterName',
	// 	// 	['class'=>'path.to.FilterClass', 'propertyName'=>'propertyValue'],
	// 	// ];
	// }
	// public function actions()
	// {
	// 	// return external action classes, e.g.:
	// 	return [
	// 		'action1'=>'path.to.ActionClass',
	// 		'action2'=>[
	// 			'class'=>'path.to.AnotherActionClass',
	// 			'propertyName'=>'propertyValue',
	// 		],
	// 	];
	// }

	public function actionIndex()
	{
		## display the login form
		// $this->render('index', ['model' => $model]);
		// $this->render('//security/login.html.twig');
		$this->layout = '//layouts/homepage.html.twig';
		

		// $this->render('index');
		$this->renderText('layouts/homepage.html.twig');

		// $model = new DemoLoginForm;
		// $this->render('login', ['model' => $model, 'last_username' => Yii::app()->user->name]);
	}

	/**
	 * @Route("/login", name="security_login")
	 */
	// public function login(AuthenticationUtils $helper): Response
	// {
	//     return $this->render('security/login.html.twig', [
	//         // last username entered by the user (if any)
	//         'last_username' => $helper->getLastUsername(),
	//         // last authentication error (if any)
	//         'error' => $helper->getLastAuthenticationError(),
	//     ]);
	// }
	public function actionLogin()
	{
		if (!defined('CRYPT_BLOWFISH') || !CRYPT_BLOWFISH)
			throw new CHttpException(500, "This application requires that PHP was compiled with Blowfish support for crypt().");

		$model = new DemoLoginForm;

		## if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		## collect user input data
		if (isset($_POST['DemoLoginForm'])) {
			$model->attributes = $_POST['DemoLoginForm'];

			## validate user input and redirect to the previous page if valid
			if ($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}

		## display the login form
		// $this->render('login', ['model' => $model]);
		$this->render('/security/login.html.twig', ['model' => $model, 'last_username' => Yii::app()->user->name]);
		// $this->render('//admin/blog/show.html.twig');
	}

	/**
	 * This is the route the user can use to logout.
	 *
	 * But, this will never be executed. Symfony will intercept this first
	 * and handle the logout automatically. See logout in config/packages/security.yaml
	 *
	 * @Route("/logout", name="security_logout")
	 */
	// public function logout(): void
	// {
	//     throw new \Exception('This should never be reached!');
	// }
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}