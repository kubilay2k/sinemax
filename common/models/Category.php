<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $category_id
 * @property string|null $category_name
 * @property string|null $min_age_limit
 *
 * @property Movie[] $movies
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_name', 'min_age_limit'], 'string', 'max' => 55],
            ['min_age_limit', function ($attribute, $params) {
                /* calculate min value */
                $min = 1;
                if ($this->$attribute < $min) {
                    $this->addError($attribute, "Yaş Sınırı en az {$min} olmalı.");
                }
            }]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
            'min_age_limit' => 'Min Age Limit',
            
        ];
    }

    /**
     * Gets query for [[Movies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovies()
    {
        return $this->hasMany(Movie::className(), ['category_id' => 'category_id']);
    }
}
