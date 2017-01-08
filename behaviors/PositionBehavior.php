<?php
/**
 * Created by PhpStorm.
 * User: r
 * Date: 08.01.17
 * Time: 1:27
 */

namespace altiore\page\behaviors;

use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

class PositionBehavior extends AttributeBehavior
{
    public $attribute = 'position';

    /**
     * Initialize
     */
    public function init()
    {
        parent::init();

        $this->attributes = [
            ActiveRecord::EVENT_AFTER_VALIDATE => $this->attribute,
        ];
    }

    /**
     * Returns the value for the current attributes.
     * This method is called by [[evaluateAttributes()]]. Its return value will be assigned
     * to the attributes corresponding to the triggering event.
     * @param \yii\base\Event $event the event that triggers the current attribute updating.
     * @return mixed the attribute value
     */
    protected function getValue($event)
    {
        /** @var \yii\db\ActiveRecord $currentModel */
        $currentModel = $event->sender;
        $currentValue = $currentModel->{$this->attribute};

        if ($currentModel->hasErrors()) {
            return $currentValue;
        }

        if (!$currentValue) {
            return $currentModel::find()->max('position') + 1;
        }

        $models = $currentModel::find()
            ->where(['>=', $this->attribute, $currentValue])
            ->orderBy([$this->attribute => SORT_DESC])
            ->all();

        foreach ($models as $model) {
            $model->{$this->attribute} += 1;
            $model->save(false);
        }

        return $currentValue;
    }
}
