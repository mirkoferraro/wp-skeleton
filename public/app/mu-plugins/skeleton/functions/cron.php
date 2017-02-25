<?php

use Cron\CronExpression;

class CronManager {
    
    private static $crons = array();
    private static $functions = array();

    public static function init() {
        self::_load();
    }

    public static function register( $name, $recurrence, $function ) {
        add_action( self::_actionName( $name ), $function );
        self::$functions[$name] = $function;

        if ( ! isset( self::$crons[$name] ) || self::$crons[$name]['recurrence'] != $recurrence ) {
            self::$crons[$name] = array(
                'recurrence' => $recurrence,
                'last_run'   => time()
            );
            self::_save();
        }
    }

    public static function unregister( $name ) {
        if ( ! isset( self::$crons[$name] ) || ! isset( self::$functions[$name] ) ) {
            return;
        }

        remove_action( self::_actionName( $name ), self::$functions[$name] );
        unset( self::$crons[$name] );
        self::_save();
    }

    private static function _load() {
        self::$crons = get_option( 'crons' );
    }

    private static function _save() {
        update_option( 'crons', self::$crons );
    }

    private static function _actionName( $name ) {
        return "cron_{$name}";
    }

    private static function _runCron( $name ) {
        do_action( self::_actionName( $name ) );

        if ( isset( self::$crons[$name] ) ) {
            self::$crons[$name]['last_run'] = time();
            self::_save();
        }
    }

    public static function run() {
        foreach ( self::$crons as $name => $crondata ) {
            $cronexp = CronExpression::factory( $crondata['recurrence'] );
            $prevDate = $cronexp->getPreviousRunDate();

            if ( $prevDate->getTimeStamp() > $crondata['last_run'] ) {
                self::_runCron( $name );
            }
        }
    }
}

CronManager::init();