<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property string $createtime
 *
 * @property Comment[] $comments
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'tags'], 'required'],
            [['content'], 'string'],
            [['createtime'], 'safe'],
            [['title'], 'string', 'max' => 150],
            [['tags'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'tags' => 'Tags',
            'createtime' => 'Createtime',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['post_id' => 'id']);
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
