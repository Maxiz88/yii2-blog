
------------------------------------------------------------------------------------------------
Импортировать дамп базы данных shop.sql(находится в корне)
Кодировка БД UTF-8

В products/_form использовал виджет Chosen, поэтому для корректной работы нужно загрузить библиотеку
php composer.phar require "nex/yii2-chosen" "*"

CRUD категорий в categories/
CRUD товаров в products/
Загрузка и обновление картинок товаров происходит в products/_form, единственное с отображением
картинок не до конца разобрался


Метод, получающий все данные о товаре доступен по products/get-product-details?product_id=4