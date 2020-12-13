<?php
/**
 * User: ansaus
 * Date: 12.12.2020
 */

namespace common\models\services;


use common\models\ActiveRecord\Apples;
use common\models\Apple;
use common\models\dict\AppleStatus;
use common\models\exceptions\AppleException;
use yii\log\Logger;

class AppleService
{
    public function save(Apple $apple) {
        $appleId = $apple->getId();
        $appleRec = (!$appleId) ? new Apples() : Apples::findOne(['id' => $appleId]);
        $appleRec->color = $apple->getColor();
        $appleRec->created_date = ($apple->getCreatedDate()) ? $apple->getCreatedDate() : date('Y-m-d H:i:s');
        $appleRec->fallen_date = $apple->getFallenDate();
        $appleRec->size = $apple->getSize();
        $appleRec->status = ($apple->getStatus()) ? $apple->getStatus() : AppleStatus::TREE;
        if (!$appleRec->save()) {
            \Yii::getLogger()->log($appleRec->getErrorSummary(true), Logger::LEVEL_ERROR);
            throw new AppleException('Данные не сохранены');
        }
        if (!$appleId) $apple->setId($appleRec->id);

        return $apple;
    }

    /**
     * @param $appleId
     * @return Apple|null
     */
    public function getById($appleId) {
        if ($appleRec = Apples::findOne(['id' => $appleId])) {
           $apple = new Apple();
           $apple->setId($appleRec->id);
           $apple->setColor($appleRec->color);
           $apple->setSize($appleRec->size);
           $apple->setCreatedDate($appleRec->created_date);
           $apple->setFallenDate($appleRec->fallen_date);
           $apple->setStatus($appleRec->status);
           return $apple;
        }
        return null;
    }

    /**
     * @param Apple $apple
     * @return Apple
     * @throws AppleException
     */
    public function fallToGround(Apple $apple) {
        if ($apple->getStatus() == AppleStatus::GROUND) {
            throw new AppleException('Яблоко уже на земле!');
        }
        if ($apple->getStatus() == AppleStatus::SPOILED) {
            throw new AppleException('Яблоко уже на земле и испорчено!');
        }
        $apple->setFallenDate(date('Y-m-d H:i:s'));
        $apple->setStatus(AppleStatus::GROUND);
        return $this->save($apple);
    }

    /**
     * @param Apple $apple
     * @param $percent
     * @return Apple|null
     * @throws AppleException
     */
    public function eat(Apple $apple, $percent) {
        // проверки
        if ($percent < 0 || $percent>100) {
            throw new AppleException('Процент должен быть в диапазоне от 0 до 100');
        }
        if ($apple->getStatus() == AppleStatus::TREE) {
            throw new AppleException('Есть нельзя - яблоко на дереве');
        }
        if ($this->checkSpoiled($apple)) {
            $this->setSpoiled($apple);
            throw new AppleException('Есть нельзя - яблоко испорчено');
        }

        $apple->setSize((1-$percent/100)*$apple->getSize());

        if (!$apple->getSize()) {
            $this->remove($apple);
            return null;
        } else {
           return $this->save($apple);
        }
    }

    public function generate($count=1) {
        //$colors = ['red','green','yellow'];
        for ($i=1;$i<=$count;$i++) {
            $apple = new Apple();
            $apple->setColor( strval(dechex(rand(0, 16777215))) );
            $apple->setSize(1/* целое */);
            $this->save($apple);
        }
        return true;
    }

    /**
     * @param Apple $apple
     * @return Apple
     * @throws AppleException
     */
    public function setSpoiled(Apple $apple) {
        $apple->setStatus(AppleStatus::SPOILED);
        return $this->save($apple);
    }
    public function checkSpoiled(Apple $apple) {
        if ($apple->getStatus() == AppleStatus::SPOILED) return true;
        if ($apple->getStatus() == AppleStatus::TREE) return false;
        if ($apple->getStatus() == AppleStatus::GROUND) {
            $fallen = strtotime($apple->getFallenDate());
            $now = time();
            if (($now - $fallen) > 18000) { // больше 5 ч
                return true;
            }
        }
        return false;
    }
    public function remove(Apple $apple) {
        Apples::deleteAll(['id' => $apple->getId()]);
        return true;
    }
}
