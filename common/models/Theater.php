<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "theater".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property Session[] $sessions
 */
class Theater extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'theater';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'],'required','message'=>'Sinema İsmi Boş Bırakılamaz'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Sessions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessions()
    {
        return $this->hasMany(Session::className(), ['theater_id' => 'id']);
    }
}
