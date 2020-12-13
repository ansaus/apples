<?php

use yii\db\Migration;

/**
 * Class m201213_134904_apple_table
 */
class m201213_134904_apple_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $connection = Yii::$app->getDb();
        $connection->createCommand("
            create table apples
            (
                id int auto_increment primary key,
                color varchar(255) not null comment 'Цвет',
                created_date datetime not null comment 'Дата появления',
                fallen_date datetime null comment 'Дата падения',
                status varchar(100) not null comment 'Статус',
                size decimal(3,2) not null comment 'Размер'
            )
            comment 'Яблоки';
        ")->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $connection = Yii::$app->getDb();
        $connection->createCommand("
           drop table apples;
        ")->execute();
    }
}
