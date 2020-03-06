<?php

namespace Baruchyan\BitrixCron;


class CronFactory
{
    /** @var  array */
    private $namespaceParts;

    /**
     * @param $type
     * @return CronInterface
     * @throws \Exception
     */
    public function build($type): CronBase
    {

        if(empty($type))
            throw new \Exception('Не указано действие');

        $className = $this->makeClassName($type);

        if(!class_exists($className))
            throw new \Exception('Не найден исполняющий класс');

        return new $className;

    }

    /**
     * @param array $namespaceParts
     */
    public function setNamespaceParts(array $namespaceParts)
    {
        $this->namespaceParts = $namespaceParts;
    }

    /**
     * Генерируем имя класса
     * @param string $type
     * @return string
     */
    private function makeClassName(string $type): string
    {
        $result = [];

        $parts = explode(':', $type);

        foreach($parts as $part){

            $subparts = explode('_', $part);

            if(empty($subparts))
                continue;

            $partString = '';

            foreach($subparts as $subpart){
                $partString .= ucfirst($subpart);
            }

            $result[] = $partString;

        }

        return implode('\\', array_merge($this->namespaceParts, $result));
    }
}