<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $created
 * @property int $comments_status
 *
 * @property Comment[] $comments
 * @property User $user
 */
class Post extends \yii\db\ActiveRecord
{
    public $file;
    public $no_image = '/uploads/no_image.png';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['description', 'title'], 'required'],
            [['comments_status'], 'integer'],
            [['description'], 'string', 'min' => 3, 'max' => 10000],
            [['created'], 'safe'],
            [['title'], 'string', 'min' => 3, 'max' => 500],
            [['file'], 'file'],
//            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'description' => 'Description',
            'image' => 'Image',
            'created' => 'Created',
            'comments_status' => 'Comments Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id'])->orderBy(['comment.created'=>SORT_DESC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
