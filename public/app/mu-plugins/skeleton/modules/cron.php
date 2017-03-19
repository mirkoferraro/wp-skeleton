<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Cron\CronExpression;

class CronManager {
    
    private static $crons = array();
    private static $functions = array();

    public static function init() {
        self::_load();

        add_action( 'init', function() {
            add_menu_page( 'Cron', 'Cron', 'manage_options', 'cron', 'CronManager::adminPage', 'dashicons-controls-repeat', 1001 );
        });
    }

    public static function adminPage() {
        $crons = self::getCrons();
        $current = self::getCurrent();
        ?>
        <h2>Running</h2>
        <?php if ( $current ) : ?>
            <p>Name: <?= $current['name'] ?></p>
            <p>Started at: <?= date( '', $current['started_at'] ) ?></p>
        <?php else: ?>
            <p>No running crons</p>
        <?php endif ?>

        <h2>Cron List</h2>
        <table>
            <thead>
                <td><strong>Name</strong></td>
                <td><strong>Last run</strong></td>
            </thead>
            <tbody>
            <?php foreach( $crons as $name => $data ) : ?>
                <tr>
                    <td><?= $name ?></td>
                    <td><?= date( 'd-m-Y H:i', $data['last_run'] ) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php
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

    public static function getCrons() {
        return get_option( 'crons' );
    }

    public static function getCurrent() {
        return get_option( 'current_cron' );
    }

    private static function _load() {
        self::$crons = get_option( 'crons' );
    }

    private static function _save() {
        update_option( 'crons', self::$crons );
    }

    private static function _current( $name = false ) {
        $current = empty( $name ) ? null : array(
            'name'       => $name,
            'started_at' => time()
        );

        update_option( 'current_cron', $current );
    }

    private static function _actionName( $name ) {
        return "cron_{$name}";
    }

    private static function _runCron( $name ) {
        self::_current( $name );
        do_action( self::_actionName( $name ) );
        self::_current();

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