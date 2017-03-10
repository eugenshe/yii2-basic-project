<?php
/**
 * Created by PhpStorm.
 * User: chief
 * Date: 27.02.17
 * Time: 18:35
 */

    namespace app\controllers;
    use app\models\Post;
    use yii\data\Pagination;

    class PostController extends AppController{
        public function actionIndex(){
            /*$posts= Post::find()->select('id, title, excerpt')->all();*/

            $query= Post::find()->select('id, title, excerpt')->orderBy('id DESC');
            $pages = new Pagination(['totalCount' => $query->count(),'pageSize' =>2,'pageSizeParam'=>false, 'forcePageParam'=>false ]);
            $posts= $query->offset($pages->offset)->limit($pages->limit)->all();

            /*$this->debug($posts);*/
            /*debug($posts);*/
            return $this->render('index',compact('posts','pages'));
        }

        public function actionView(){
            $id = \Yii::$app->request->get('id');
            $post=Post::findOne($id);
            if(empty($post)) throw new \yii\web\HttpException(404,'Упс,кажется такой страницы нет...');
            return $this->render('view',compact('post'));
        }

        public function actionTest(){
            return $this->render('test');
        }
    }