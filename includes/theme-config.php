<?php
if (!defined('ABSPATH')) exit;

/**
 * AMAC Builders Central Theme Configuration
 * Single Source of Truth for Brand Colors.
 * Changing values here or in WP Admin (AMAC Colors) updates all widgets, styles, and buttons.
 */
class AMAC_Theme_Config {

    const PRIMARY_DARK = '#0B1325';
    const PRIMARY_GOLD = '#C5A059';
    const GOLD_HOVER   = '#B38728';
    const BTN_TEXT     = '#0B1325';

    public static function get_dark() {
        $c = get_option('amac_color_dark');
        return !empty($c) ? $c : self::PRIMARY_DARK;
    }

    public static function get_gold() {
        $c = get_option('amac_color_gold');
        return !empty($c) ? $c : self::PRIMARY_GOLD;
    }

    public static function get_hover() {
        $c = get_option('amac_color_gold_hover');
        return !empty($c) ? $c : self::GOLD_HOVER;
    }

    public static function get_btn_text() {
        $c = get_option('amac_color_btn_text');
        return !empty($c) ? $c : self::BTN_TEXT;
    }
}
