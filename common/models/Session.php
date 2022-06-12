<?php

namespace common\models;

use phpDocumentor\Reflection\Types\Null_;
use Yii;

/**
 * This is the model class for table "session".
 *
 * @property int $id
 * @property int|null $movie_id
 * @property int|null $theater_id
 * @property string|null $day
 * @property string|null $time
 * @property string|null $cost
 * @property string|null $fulltime
 * @property string|null $rezno
 * 
 * @property Movie $movie
 * @property Theater $Theater
 * @property Ticket[] $tickets
 */
class Session extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'movie_id', 'theater_id'], 'integer'],
            [['time','fulltime','rezno'], 'string', 'max' => 55],

            [['day'], 'safe'],
            [['cost'], 'string', 'max' => 11],
            [['id'], 'unique'],
            [['movie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Movie::className(), 'targetAttribute' => ['movie_id' => 'id']],
            [['theater_id'], 'exist', 'skipOnError' => true, 'targetClass' => Theater::className(), 'targetAttribute' => ['theater_id' => 'id']],
            //Kurallar
            ['cost', function ($attribute, $params) {
                $min = 1;
                if ($this->$attribute < $min) {
                    $this->addError($attribute, "Ücret en az {$min} olmalı.");
                    
                }
            }],
            ['day', function ($attribute, $params) {
                $day = date('Y-m-d');
                if ($this->$attribute < $day) {
                    $this->addError($attribute, "Geçmiş Tarihe Seans Oluşturamazsınız");
                    $daytrue= true;
                }
            }],
            ['time', function ($attribute, $params) {
                date_default_timezone_set(Yii::$app->timeZone); 
                $day = date('Y-m-d');
                $time = date('H:i');

                if($this->day <= $day && $this->time < $time ) {
                    $this->addError($attribute, "Geçmiş Saate Seans Oluşturamazsınız");
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
            'id' => 'ID',
            'movie_id' => 'Movie ID',
            'theater_id' => 'Theater ID',
            'day' => 'Day',
            'time' => 'Time',
            'cost' => 'Cost',
        ];
    }

    /**
     * Gets query for [[Movie]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovie()
    {
        return $this->hasOne(Movie::className(), ['id' => 'movie_id']);
    }

    /**
     * Gets query for [[Theater]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTheater()
    {
        return $this->hasOne(Theater::className(), ['id' => 'theater_id']);
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['session_id' => 'id']);
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery
     */

    public function purcashed($id,$seat)
    {
        if (Ticket::find()->andWhere(['session_id'=>$id,'seat_no'=>$seat])->one() != Null) {
            return true;
        }else {
            return false;
        }
        
    }
    
    public function beforeSave($insert) 
    {
        if(parent::beforeSave($insert))
            {
                if ($this->isNewRecord) 
                    {
                        $this->fulltime = $this->day.' '.$this->time;
                        $this->rezno = '#'.Yii::$app->security->generateRandomString(8);
                    } 
                else{}

                    return true;
            } 

        else 
            {
                return false;
            }
            
    }


}
