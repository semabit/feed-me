<?php

namespace semabit\feedme\base;

use Craft;
use semabit\feedme\Plugin;
use semabit\feedme\services\DataTypes;
use semabit\feedme\services\Elements;
use semabit\feedme\services\Feeds;
use semabit\feedme\services\Fields;
use semabit\feedme\services\Logs;
use semabit\feedme\services\Process;
use semabit\feedme\services\Service;

trait PluginTrait
{
    // Properties
    // =========================================================================

    /**
     * @var Plugin
     */
    public static Plugin $plugin;

    /**
     * @var string $feedName Keeping state for logging
     */
    public static string $feedName = '';

    /**
     * @var
     */
    public static mixed $stepKey = null;


    // Static Methods
    // =========================================================================

    /**
     * @param $message
     * @param array $params
     * @param array $options
     * @throws \yii\base\InvalidConfigException
     */
    public static function error($message, array $params = [], array $options = []): void
    {
        Plugin::$plugin->getLogs()->log(__METHOD__, $message, $params, $options);
    }

    /**
     * @param $message
     * @param array $params
     * @param array $options
     * @throws \yii\base\InvalidConfigException
     */
    public static function info($message, array $params = [], array $options = []): void
    {
        Plugin::$plugin->getLogs()->log(__METHOD__, $message, $params, $options);
    }

    /**
     * @param $message
     */
    public static function debug($message): void
    {
        if (Craft::$app->getRequest()->getIsConsoleRequest()) {
            return;
        }

        if (Craft::$app->getRequest()->getSegment(-1) === 'debug') {
            echo "<pre>";
            print_r($message);
            echo "</pre>";
        }
    }


    // Public Methods
    // =========================================================================

    /**
     * @return DataTypes
     * @throws \yii\base\InvalidConfigException
     */
    public function getData(): DataTypes
    {
        return $this->get('data');
    }

    /**
     * @return Elements
     * @throws \yii\base\InvalidConfigException
     */
    public function getElements(): Elements
    {
        return $this->get('elements');
    }

    /**
     * @return Feeds
     * @throws \yii\base\InvalidConfigException
     */
    public function getFeeds(): Feeds
    {
        return $this->get('feeds');
    }

    /**
     * @return Fields
     * @throws \yii\base\InvalidConfigException
     */
    public function getFields(): Fields
    {
        return $this->get('fields');
    }

    /**
     * @return Logs
     * @throws \yii\base\InvalidConfigException
     */
    public function getLogs(): Logs
    {
        return $this->get('logs');
    }

    /**
     * @return Process
     * @throws \yii\base\InvalidConfigException
     */
    public function getProcess(): Process
    {
        return $this->get('process');
    }

    /**
     * @return Service
     * @throws \yii\base\InvalidConfigException
     */
    public function getService(): Service
    {
        return $this->get('service');
    }
}
