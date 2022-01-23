<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        // добавляем разрешение "createPost"
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // добавляем разрешение "updatePost"
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);
        // добавляем разрешение "logout"
        $logout = $auth->createPermission('logout');
        $logout->description = 'logout';
        $auth->add($logout);
        // добавляем роль "user" и даём роли разрешение "logout"
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $logout);

        // добавляем роль "author" и даём роли разрешение "createPost"
        // а также все разрешения роли "user"
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createPost);
        $auth->addChild($author, $user);
        // добавляем роль "moderator"
        // а также все разрешения роли "author"
        $moderator = $auth->createRole('moderator');
        $auth->add($moderator);
        $auth->addChild($moderator, $author);
        // добавляем роль "admin" и даём роли разрешение "updatePost"
        // а также все разрешения роли "moderator"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $moderator);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($author, 2);
        $auth->assign($admin, 1);
    }
}