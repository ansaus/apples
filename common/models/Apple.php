<?php
/**
 * User: ansaus
 * Date: 12.12.2020
 */

namespace common\models;


use common\models\dict\AppleStatus;
use yii\base\BaseObject;

class Apple extends BaseObject
{
    /**
     * ID
     * @var int
     */
    private $id;
    /**
     * Цвет
     * @var string
     */
    private $color;
    /**
     * Дата появления
     * @var string
     */
    private $createdDate;
    /**
     * Дата падения
     * @var string
     */
    private $fallenDate;
    /**
     * Статус яблока
     * @var string
     * @see AppleStatus
     */
    private $status;
    /**
     * Размер
     * @var float
     */
    private $size;

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @return string
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @return string
     */
    public function getFallenDate()
    {
        return $this->fallenDate;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return float
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @param string $createdDate
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @param string $fallenDate
     */
    public function setFallenDate($fallenDate)
    {
        $this->fallenDate = $fallenDate;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param float $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }
}
