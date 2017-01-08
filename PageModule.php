<?php
namespace altiore\page;

use Yii;
use yii\base\Module;
use yii\helpers\ArrayHelper;

class PageModule extends Module
{
    public $msgCategoryName = 'altiorePage';

    public function init()
    {
        parent::init();
        $this->initI18N();
    }

    /**
     * Yii i18n messages configuration for generating translations
     *
     * @return void
     */
    public function initI18N()
    {
        $reflector = new \ReflectionClass(get_class($this));
        $dir = dirname($reflector->getFileName());
        $cat = $this->msgCategoryName;
        Yii::setAlias("@{$cat}", $dir);
        $config = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => "@{$cat}/messages",
            'forceTranslation' => true
        ];
        $globalConfig = ArrayHelper::getValue(Yii::$app->i18n->translations, "{$cat}*", []);
        if (!empty($globalConfig)) {
            $config = array_merge($config, is_array($globalConfig) ? $globalConfig : (array) $globalConfig);
        }
        if (!empty($this->i18n) && is_array($this->i18n)) {
            $config = array_merge($config, $this->i18n);
        }
        Yii::$app->i18n->translations["{$cat}*"] = $config;
    }
}
