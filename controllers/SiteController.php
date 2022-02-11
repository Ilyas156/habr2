<?php

namespace app\controllers;

use app\models\article\ArticleCategories;
use app\models\article\ArticleLikes;
use app\models\article\Articles;
use app\models\article\ArticlesSearch;
use app\models\article\ArticleViews;
use app\models\category\Category;
use Yii;
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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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
        $articles = Articles::getAll();

        return $this->render('index', [
            'categories' => $categories,
            'articles' => $articles
        ]);
    }

    public function actionArticle($id) // show article page
    {

        $categories = Category::getAll();
        $article = Articles::getArticle($id); // get the select article
        $views = new ArticleViews();
        $views->setViews($id); // add views +1

        return $this->render('article', [
            'categories' => $categories,
            'article' => $article
        ]);
    }

    public function actionCategory($id) // Show articles belonging to the selected category
    {
        $articles = new ArticleCategories();
        $articles = $articles->getArticlesByCategory($id); //get articles of the selected category
        $categories = Category::getAll();

        return $this->render('category', [
            'categories' => $categories,
            'articles' => $articles
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
        $like = new ArticleLikes();
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
        $articles =  new ArticlesSearch();
        $category = Category::getAll();
        $params = Yii::$app->request->get('search');

        $articles = $articles->searchIndex($params); // search articles by input string

        return $this->render('index', [
            'categories' => $category,
            'articles' => $articles
        ]);
    }

}
