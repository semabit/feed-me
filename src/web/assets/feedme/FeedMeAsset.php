<?php

namespace semabit\feedme\web\assets\feedme;

use semabit\feedme\models\ElementGroup;
use semabit\feedme\Plugin;
use craft\helpers\Json;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;
use craft\web\View;

class FeedMeAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->sourcePath = "@craft/feedme/web/assets/feedme/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'FeedMe.js',
        ];

        $this->css = [
            'css/FeedMe.css',
        ];

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function registerAssetFiles($view): void
    {
        parent::registerAssetFiles($view);

        $elementTypeInfo = [];
        foreach (Plugin::getInstance()->getElements()->getRegisteredElements() as $elementClass => $element) {
            $groups = [];
            $elementGroups = $element->getGroups();
            foreach ($elementGroups as $group) {
                if ($group instanceof ElementGroup) {
                    $groups[$group->id] = [
                        'isSingleton' => $group->isSingleton,
                    ];
                }
            }
            $elementTypeInfo[$elementClass] = [
                'groups' => $groups,
            ];
        }

        $json = Json::encode($elementTypeInfo, JSON_UNESCAPED_UNICODE);
        $js = <<<JS
if (typeof Craft.FeedMe === typeof undefined) {
    Craft.FeedMe = {};
}
Craft.FeedMe.elementTypes = {$json};
JS;
        $view->registerJs($js, View::POS_HEAD);
    }
}
