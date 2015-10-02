<?php

/**
 * The only purpose of this class is to contain the definition of menu item order
 */
abstract class MenuOrder
{
    private static $auMenuOrder = ['Joico', 'Fudge', 'Solfine Crema Color', 'Hanz de Fuko', 'Vitaman', 'Villa Lodola'];
    private static $nzMenuOrder = ['Joico', 'iColor', 'ISO', 'Hanz de Fuko', 'ColorFix', 'Senscience Proformance', 'Quantum'];

    public static function getAuMenuOrder()
    {
        return self::$auMenuOrder;
    }

    public static function getNzMenuOrder()
    {
        return self::$nzMenuOrder;
    }

}