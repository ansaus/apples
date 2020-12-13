<?php
/**
 * User: ansaus
 * Date: 12.12.2020
 */

namespace common\models\dict;

/**
 * Справочник статусов яблока
 */
class AppleStatus
{
    /**
     * На дереве
     */
    const TREE='tree';
    /**
     * На земле
     */
    const GROUND='ground';
    /**
     * Испорчено
     */
    const SPOILED='spoiled';

    /**
     * Получить список
     * @return array
     */
    public static function getList() {
        return [
            self::TREE => 'На дереве',
            self::GROUND => 'На земле',
            self::SPOILED => 'Испорчено',
        ];
    }
}
