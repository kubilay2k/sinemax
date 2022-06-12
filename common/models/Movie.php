<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * This is the model class for table "movie".
 *
 * @property int $id
 * @property string|null $movie_name
 * @property string|null $movie_description
 * @property string|null $time
 * @property string|null $image
 * @property string|null $director
 * @property string|null $actors
 * @property int|null $category_id
 *
 * @property Category $category
 * @property Session[] $sessions
 */
class Movie extends \yii\db\ActiveRecord

{
    /**
     * @var \yii\web\UploadedFile
     */
    public $thumbnail;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movie';
    }
        /**
         * @var UploadedFile
         */
    public function rules()
    {
        return [
            [['id', 'category_id','created_by','created_at','updated_by'], 'integer'],
            [['movie_name','image','movie_description','time','category_id'], 'required'],
            [['movie_name', 'movie_description', 'actors'], 'string', 'max' => 255],
            [['time', 'director'], 'string', 'max' => 55],
            //['thumbnail', 'image', 'minWidth'=>1920 ,'minHeight'=>1080],
            [['id'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'category_id']],
        ];
    }




    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'movie_name' => 'Movie Name',
            'movie_description' => 'Movie Description',
            'time' => 'Time',
            'thumbnail'=> 'Thumbnail',
            'director' => 'Director',
            'actors' => 'Actors',
            'category_id' => 'Category ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated_by'
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
    }

    /**
     * Gets query for [[Sessions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessions()
    {
        return $this->hasMany(Session::className(), ['movie_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */

    public function save($runValidation = true, $attributeNames = null)
    {
        $saved = parent::save($runValidation, $attributeNames);
        
        if (!$saved) {
            return false;
        }

        if ($this->thumbnail) {
            $thumbnailPath = Yii::getAlias('@frontend/web/storage/thumbs/'.$this->id.'.png');
            if (!is_dir(dirname($thumbnailPath))) {
                FileHelper::createDirectory(dirname($thumbnailPath));
            }
            

            $this->thumbnail->saveAs($thumbnailPath);
            Image::getImagine()->open($thumbnailPath)->thumbnail(new Box(254,361))->save();
        }

        return true;
    }


    public function getThumbnailLink(){
        return Yii::$app->params['frontendUrl'].'storage/thumbs/'.$this->id.'.png';            
    }

    public function afterDelete()
    {
        parent::afterDelete();       
        
        $thumbnailPath = Yii::getAlias('@frontend/web/storage/thumbs/'.$this->id.'.png');
        if (file_exists($thumbnailPath)) {
            unlink($thumbnailPath);    
        }
        
        }

    /**
     * Gets query for [[Session]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCinema($cinema)
    {
        return Session::find()->select('time')->where(['theater_id'=>$cinema])->all();
    }


}
