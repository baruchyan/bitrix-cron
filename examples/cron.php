<?php
$_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__)."/../../..");

$DOCUMENT_ROOT = $_SERVER ["DOCUMENT_ROOT"];
define ( "NO_KEEP_STATISTIC", true );
define ( "NOT_CHECK_PERMISSIONS", true );
define ( "BX_CRONTAB", true);

require ($_SERVER ["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$cronFactory = new Baruchyan\BitrixCron\CronFactory();
$cronFactory->setNamespaceParts(['Services', 'Cron']);

try{

    $action = \Baruchyan\BitrixCron\CronBase::getAction();

    $cron = $cronFactory->build($action);
    $cron->run();

}catch (\Exception $exception){
    echo $exception->getMessage()."\r\n";
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");