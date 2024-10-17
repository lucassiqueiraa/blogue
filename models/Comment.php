<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property string $content
 * @property string $createtime
 * @property int $post_id
 *
 * @property Post $post
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'author'], 'required'],
            [['content', 'author'], 'string'],
            [['createtime'], 'safe'],
            [['post_id'], 'integer'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::class, 'targetAttribute' => ['post_id' => 'id']],
            [['author'], 'match', 'pattern' => '/^[a-zA-Z\\s]+$/', 'message' => 'The author field should contain only letters.'], // Somente letras

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author' => 'Author',
            'content' => 'Content',
            'createtime' => 'Createtime',
            'post_id' => 'Post ID',
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::class, ['id' => 'post_id']);
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            // Se for um novo registro, define a data e hora atuais
            $this->createtime = date('Y-m-d H:i:s'); // Formato do MySQL para datetime
        }

        return parent::beforeSave($insert);
    }
}
