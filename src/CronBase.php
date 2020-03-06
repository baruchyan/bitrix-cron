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
        $server = $context->getServer();

        if(!empty($request->get('action')))
            return $request->get('action');

        if(!empty($server->get('argv')[1]))
            return $server->get('argv')[1];

        return '';
    }
}