<?php

namespace Services\Cron\Test;


use Baruchyan\BitrixCron\CronBase;
use Baruchyan\BitrixCron\CronInterface;

class Test extends CronBase implements CronInterface
{
    private $aa = 222;

    public function __construct()
    {
        parent::__construct();

       // .. Some constructor code

        $this->aa = 33;

    }

    /**
     * run
     */
    public function run(): void
    {

        echo $this->aa."\n\r";

    }




}