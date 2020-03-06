<?php

namespace Baruchyan\BitrixCron;


use Bitrix\Main\Context;
use Bitrix\Main\HttpRequest;
use Bitrix\Main\Loader;
use Bitrix\Main\Server;

/**
 * Class CronBase
 * @package Baruchyan\BitrixCron\Cron
 */
abstract class CronBase
{
    /** @var  HttpRequest */
    protected $request;

    /** @var  Server */
    protected $server;

    /** @var array */
    protected $useModules = [];

    /**
     * CronBase constructor.
     */
    public function __construct()
    {
        $context = Context::getCurrent();
        $this->request = $context->getRequest();
        $this->server = $context->getServer();

        $this->includeModules();

    }

    /**
     * запуск
     */
    abstract public function run(): void;

    /**
     * Получение имени сайта
     * @return string
     */

    /**
     * Подключение модулей
     * @throws \Bitrix\Main\LoaderException
     */
    private function includeModules(): void
    {
        if(empty($this->useModules))
            return;

        foreach($this->useModules as $module){
            Loader::includeModule($module);
        }
    }

    /**
     * Определение действия
     * @return string
     */
    static public function getAction(): string
    {
        $context = Context::getCurrent();
        $request = $context->getRequest();

        if(!empty($request->get('action')))
            return $request->get('action');

        if(!empty($argv[1]))
            return $argv[1];

        return '';
    }
}