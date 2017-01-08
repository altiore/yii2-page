<?php

namespace altiore\page\models;

use altiore\page\PageModule;
use altiore\page\behaviors\PositionBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property integer $id
 * @property string  $title
 * @property string  $url
 * @property string  $text
 * @property integer $position
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Page extends ActiveRecord
{
    /**
     * @var string
     */
    private $msgCategoryName;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['title', 'text', 'url'], 'required'],
            [['text'], 'string'],
            [['title', 'url'], 'string', 'max' => 255],
            ['position', 'exist', 'when' => function ($model) {
                return $model->position != 0;
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => Yii::t($this->msgCategoryName, 'ID'),
            'title'      => Yii::t($this->msgCategoryName, 'Title'),
            'url'        => Yii::t($this->msgCategoryName, 'Permanent Link'),
            'text'       => Yii::t($this->msgCategoryName, 'Text'),
            'position'   => Yii::t($this->msgCategoryName, 'Position'),
            'created_at' => Yii::t($this->msgCategoryName, 'Created At'),
            'updated_at' => Yii::t($this->msgCategoryName, 'Updated At'),
            'created_by' => Yii::t($this->msgCategoryName, 'Created By'),
            'updated_by' => Yii::t($this->msgCategoryName, 'Updated By'),
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
            PositionBehavior::class,
        ];
    }

    /**
     * Initialize
     */
    public function init()
    {
        parent::init();
        $this->msgCategoryName = Yii::$app->getModule('page')->msgCategoryName;
    }

    /**
     * @return array
     */
    public static function column()
    {
        $result = static::find()
            ->select(['title'])
            ->indexBy('position')
            ->orderBy(['position' => SORT_ASC])
            ->column();
        $result = array_map(function($var) {
            return 'Вставить перед страницей: "' . $var . '"';
        }, $result);
        $result[0] = 'Вставить последним';
        return $result;
    }

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id',
            'title',
            'url',
            'text',
            'position',
            'created_at',
            'updated_at',
        ];
    }
}
