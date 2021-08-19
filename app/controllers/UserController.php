<?php

namespace app\controllers;

use app\models\User;
use core\App;
use core\Controller;
use core\Request;
use Exception;

class UserController extends Controller
{

    public function create(Request $request)
    {
        $model = new User();
       
        if ($request->getMethod() === 'post') {
            $model->loadData($request->getBody());
           
            if ($model->validate() && $model->save()) {
                App::$app->response->redirect('/user');
                return;
            }
        }
        
        return $this->render('user/create', [
            'model' => $model
        ]);

    }

    public function index(Request $request)
    {
        $pageSize = 1;

        $page = $request->get('page', 1);
        list($pages, $users) = User::getList($pageSize, $page);
        return $this->render('user/index', [
            'users' => $users,
            'pages' => $pages,
            'pageSie' => $pageSize,
            
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $model = $this->findModel($id);

        if ($request->getMethod() === 'post') {
            $model->loadData($request->getBody());
            $model->id = $id;
           
            if ($model->validate() && $model->update()) {
                App::$app->response->redirect('/user');
                return;
            }
        }
        
        return $this->render('user/update', [
            'model' => $model
        ]);

    }

    public function delete(Request $request)
    {

        $id = $request->get('id');
        $user = $this->findModel($id);
        $sql = "DELETE FROM user WHERE id=?";
        $statement = App::$app->db->prepare($sql);
        if ($statement->execute([$user->id])) {
            App::$app->response->redirect('/user');
            return;
        }
    }

    private function findModel($id)
    {

        $user = User::findOne(['id' => $id]);
        if (!empty($user)) {
            return $user;
        }
        throw new Exception('Model not found');
    }
}