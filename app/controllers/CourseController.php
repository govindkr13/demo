<?php

use app\models\Course;
use core\App;
use core\Controller;
use core\Request;

class CourseController extends Controller
{
    
        public function create(Request $request)
        {
            $model = new Course();
           
            if ($request->getMethod() === 'post') {
                $model->loadData($request->getBody());
               
                if ($model->validate() && $model->save()) {
                    App::$app->response->redirect('/course');
                    return;
                }
            }
            
            return $this->render('course/create', [
                'model' => $model
            ]);
        }
    
        public function index(Request $request)
        {
            $pageSize = 1;
    
            $page = $request->get('page', 1);
            list($pages, $courses) = Course::getList($pageSize, $page);
            return $this->render('course/index', [
                'courses' => $courses,
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
                    App::$app->response->redirect('course');
                    return;
                }
            }
            
            return $this->render('course/create', [
                'model' => $model
            ]);
    
        }
    
        public function delete(Request $request)
        {
    
            $id = $request->get('id');
            $course = $this->findModel($id);
            $sql = "DELETE FROM course WHERE id=?";
            $statement = App::$app->db->prepare($sql);
            if ($statement->execute([$course->id])) {
                App::$app->response->redirect('/course');
                return;
            }
        }
    
        private function findModel($id)
        {
    
            $course = Course::findOne(['id' => $id]);
            if (!empty($course)) {
                return $course;
            }
            throw new Exception('Model not found');
        }
    
}