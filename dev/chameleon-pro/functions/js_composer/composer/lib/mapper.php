<?php
/**
 * WPBakery Visual Composer Shortcode mapper
 *
 * @package WPBakeryVisualComposer
 *
 */



class WPBMap {
    protected static $sc = Array();
    protected static $layouts = Array();

    public static function layout($array) {
        self::$layouts[] = $array;
    }

    public static function getLayouts() {
        return self::$layouts;
    }

    public static function map( $name, $attributes ) {
        if( empty($attributes['name']) ) {
            trigger_error( sprintf( __("Wrong name for shortcode:%s. Name required", "js_composer"), $name ) );
        } elseif( empty($attributes['base']) ) {
            trigger_error( sprintf( __("Wrong base for shortcode:%s. Base required", "js_composer"), $name ) );
        } else {
            
            self::$sc[$name] = $attributes;
            self::$sc[$name]['params'] = Array();

            if(!empty($attributes['params'])) {
                $attributes_keys = Array();
                foreach($attributes['params'] as $attribute) {
                    $key = array_search($attribute['param_name'], $attributes_keys);
                    if( $key === false ) {
                        $attributes_keys[] = $attribute['param_name'];
                        self::$sc[$name]['params'][] = $attribute;
                    } else {
                        self::$sc[$name]['params'][$key] = $attribute;
                    }
                }
            }
            WPBakeryVisualComposer::getInstance()->addShortCode(self::$sc[$name]);
        }

    }
    public static function getShortCodes() {
        return self::$sc;
    }
    public static function getShortCode($name) {
        return self::$sc[$name];
    }

    public static function dropParam($name, $attribute_name) {
        foreach(self::$sc[$name]['params'] as $index => $param) {
            if($param['param_name']==$attribute_name) {
                unset(self::$sc[$name]['params'][$index]);
                return;
            }
        }
    }

    /* Extend params for settings */
    public static function addParam($name, $attribute = Array()) {
        if( !isset(self::$sc[$name]))
            return trigger_error( sprintf(__("Wrong name for shortcode:%s. Name required", "js_composer"), $name ) );
        elseif (!isset($attribute['param_name'])) {
            trigger_error( sprintf(__("Wrong attribute for '%s' shortcode. Attribute 'param_name' required", "js_composer"), $name ) );
        } else {

            $replaced = false;

            foreach(self::$sc[$name]['params'] as $index => $param) {
                if($param['param_name']==$attribute['param_name']) {
                   $replaced = true;
                   self::$sc[$name]['params'][$index] = $attribute;
                }
            }

            if($replaced === false) self::$sc[$name]['params'][] = $attribute;

            WPBakeryVisualComposer::getInstance()->addShortCode(self::$sc[$name]);
        }
    }

    public static function dropShortcode($name) {
        unset(self::$sc[$name]);
        WPBakeryVisualComposer::getInstance()->removeShortCode($name);

    }

    public static function showAllD() {
        $a = Array();
        foreach(self::$sc as $key => $params) {
            foreach($params['params'] as $p) {
                if(!isset($a[$p['type']])) {
                    $a[$p['type']] = $p;
                }
            }
        }

        var_dump(array_keys($a));

    }

}