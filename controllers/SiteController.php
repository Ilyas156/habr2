<?php

namespace app\controllers;

use app\models\article\ArticleLike;
use app\models\article\Article;
use app\models\article\ArticleSearch;
use app\models\article\ArticleViews;
use app\models\category\Category;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegistrationForm;
use app\models\ContactForm;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'like'],
                'rules' => [
                    [
                        'actions' => ['logout', 'like'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() // show main page
    {
        $categories = Category::getAll();
        $query = Article::find()->joinWith('author', 'categories');
        $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 2
                ]
            ]);

        return $this->render('index', [
            'categories' => $categories,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionArticle($id) // show article page
    {

        $categories = Category::getAll();
        $article = Article::getArticle($id); // get the select article
        $views = new ArticleViews();
        $views->setViews($id); // add views +1

        return $this->render('article', [
            'categories' => $categories,
            'article' => $article
        ]);
    }

    public function actionCategory($id) // Show articles belonging to the selected category
    {
        $category = new Category();
        $categories = Category::getAll();
        $query = $category->getCategory($id)->getArticles();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 1
            ]
        ]);

        return $this->render('category', [
            'categories' => $categories,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    /**
     * Registration action.
     *
     * @return Response|string
     */
    public function actionRegistration()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegistrationForm();
        if ($model->load(Yii::$app->request->post()) && $model->registration()) {
            return $this->redirect(['login']);
        }

        $model->password = '';
        return $this->render('registration', [
            'model' => $model,
        ]);
    }
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail']))
        {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionLike($id)
    {
        $like = new ArticleLike();
        $like->setLikes($id); // add Like

        return true;
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSearch() // view results of Search
    {
        $articles =  new ArticleSearch();
        $category = Category::getAll();

        $dataProvider = $articles->searchIndex(Yii::$app->request->get('search')); // search articles by input string

        return $this->render('index', [
            'categories' => $category,
            'dataProvider' => $dataProvider
        ]);
    }

}
