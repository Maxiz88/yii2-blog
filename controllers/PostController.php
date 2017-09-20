<?php

namespace app\controllers;

use app\models\Comment;
use Yii;
use app\models\Post;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'delete' => ['POST'],
                ],
            ],

            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'delete', 'my-blog', 'update-comment', 'delete-comment', 'delete-image'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['@', '?']
                    ],
                ]
            ]
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model= Post::find()->orderBy(['created'=>SORT_DESC])->all();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionMyBlog()
    {

            $model = Post::find()
                ->where(['user_id' => Yii::$app->user->identity->id])
                ->orderBy(['created' => SORT_DESC])
                ->all();

            return $this->render('my_blog', [
                'model' => $model
            ]);

    }
    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $comment = new Comment();
        if(!Yii::$app->user->isGuest) {
            if ($comment->load(Yii::$app->request->post())) {
                $comment->post_id = $id;
                $comment->user_id = Yii::$app->user->identity->id;
                $comment->created = new Expression('NOW()');

                if ($comment->save()) {
                    return $this->redirect(['view', 'id' => $comment->post_id]);

                }
            }
        } else {
            Yii::$app->getSession()->setFlash('error_comment', 'You must register or login to comment posts!');
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'comment' => $comment
        ]);
    }

    public function actionUpdateComment($id)
    {

        $model = Comment::findOne(['id' => $id]);
        if(!Yii::$app->user->isGuest && $model->user->id == Yii::$app->user->identity->id) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->post_id]);
            }
        } else {
            throw new NotFoundHttpException('The requested page does not found!');
        }

    }



    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->id;
            $model->created = new Expression('NOW()');

            $imageName = time();
            $model->file = UploadedFile::getInstance($model, 'file');
            if(!empty($model->file))
            {
                $path = Yii::$app->params['uploads'];
                $model->file->saveAs($path.'/uploads/blog_'.$imageName.'.'.$model->file->extension);
                $model->image = '/uploads/blog_'.$imageName.'.'.$model->file->extension;

            }

            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(!Yii::$app->user->isGuest && $model->user->id == Yii::$app->user->identity->id) {
            if ($model->load(Yii::$app->request->post())) {
                $model->created = new Expression('NOW()');
                $imageName = time();
                $model->file = UploadedFile::getInstance($model, 'file');
                if(!empty($model->file))
                {
                    $path = Yii::$app->params['uploads'];
                    $model->file->saveAs($path.'/uploads/blog_'.$imageName.'.'.$model->file->extension);
                    $model->image = '/uploads/blog_'.$imageName.'.'.$model->file->extension;

                }
                if($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not found!');
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
            if(!Yii::$app->user->isGuest && $model->user->id == Yii::$app->user->identity->id) {
            $imgName = $model->image;
                if($imgName) {
                    unlink(Yii::$app->params['uploads'].$imgName);
                }

            $model->delete();

        return $this->redirect(['index']);
        } else {
            throw new NotFoundHttpException('The requested page does not found!');
        }
    }

    public function actionDeleteComment($id)
    {
        $comment = Comment::findOne($id);
        if(!Yii::$app->user->isGuest && $comment->user->id == Yii::$app->user->identity->id) {

        $comment->deleteAll('parent_id = :id', [':id' => $id]);
        $comment->delete();
        return 'comment deleted';
        } else {
            throw new NotFoundHttpException('The requested page does not found!');
        }
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDeleteImage($id)
    {
        $model = $this->findModel($id);
        if(!Yii::$app->user->isGuest && $model->user->id == Yii::$app->user->identity->id) {
            $imgName = $model->image;
            unlink(Yii::$app->params['uploads'] . $imgName);
            $model->image = null;
            $model->update();
            if (Yii::$app->request->isAjax) {
                return 'Deleted';
            } else {
                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            throw new NotFoundHttpException('The requested page does not found!');
        }
    }



}
