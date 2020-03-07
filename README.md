# Bitrix Cron Package

##Пакет для работы с Cron в Битрикс

Единая точка входа для задач cron 

Пример использования в папке examples

Точка входа 
bitrix/php_interface/cron/cron.php

В точке входа нужно переать в каком namespace лежат исполняемые cron классы
```php
$cronFactory->setNamespaceParts(['Services', 'Cron']); 
```

Namespace класса задания Services\Cron\Test (local/php_interface/classes/Services/Cron/Test.Test.php)

Вызов 

```sh
php bitrix/php_interface/cron/cron.php test:test 
```



