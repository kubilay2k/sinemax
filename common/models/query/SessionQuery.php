<?php

namespace common\models\query;;

/**
 * This is the ActiveQuery class for [[\common\models\Video]].
 *
 * @see \common\models\Session
 */
class VideoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/
    
    /**
     * {@inheritdoc}
     * @return \common\models\Session[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Session|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getSession($movie_id)
    {
        return $this->andWhere(['movie_id'=>$movie_id]);
    }
}
