<?php

namespace common\models\ActiveRecord;

use Yii;

/**
 * This is the model class for table "apples".
 *
 * @property int $id
 * @property string $color Цвет
 * @property string $created_date Дата появления
 * @property string|null $fallen_date Дата падения
 * @property string $status Статус
 * @property float $size Размер
 */
class Apples extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apples';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color', 'created_date', 'status', 'size'], 'required'],
            [['created_date', 'fallen_date'], 'safe'],
            [['size'], 'number'],
            [['color'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Цвет',
            'created_date' => 'Дата появления',
            'fallen_date' => 'Дата падения',
            'status' => 'Статус',
            'size' => 'Размер',
        ];
    }
}
