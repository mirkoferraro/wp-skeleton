<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use Cron\CronExpression;

class CronManager {

    private static $init          = false;
    private static $functions     = array();
    private static $crons         = array();
    private static $current_cron  = null;
    private static $queue         = array();
    private static $current_queue = null;

    public static function init() {
        if ( self::$init ) {
            return;
        }

        self::_loadCrons();
        self::_loadQueue();

        add_action( 'init', function() {
            add_menu_page( 'Cron Manager', 'Cron Manager', 'manage_options', 'cron', 'CronManager::adminPage', 'dashicons-controls-repeat', 1001 );
        });

        $init = true;
    }

    public static function adminPage() {
        $crons         = self::getCrons();
        $queue         = self::getQueue();
        $current_cron  = self::getCurrentCron();
        $current_queue = self::getCurrentQueue();
        ?>
        <h2>Running</h2>
        <?php if ( $current_queue ) : ?>
            <p>Name: <?= $current_queue['name'] ?></p>
            <p>Started at: <?= date( '', $current_queue['started_at'] ) ?></p>
        <?php else: ?>
            <p>No running from queue</p>
        <?php endif ?>
        <?php if ( $current_cron ) : ?>
            <p>Name: <?= $current_cron['name'] ?></p>
            <p>Started at: <?= date( '', $current_cron['started_at'] ) ?></p>
        <?php else: ?>
            <p>No running crons</p>
        <?php endif ?>

        <h2>Queue List</h2>
        <table>
            <thead>
                <td><strong>Name</strong></td>
            </thead>
            <tbody>
            <?php foreach( $queue as $data ) : ?>
                <tr>
                    <td><?= $data['name'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

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
        add_action( self::_cronName( $name ), $function );
        self::$functions[$name] = $function;

        if ( ! isset( self::$crons[$name] ) || self::$crons[$name]['recurrence'] != $recurrence ) {
            self::$crons[$name] = array(
                'recurrence' => $recurrence,
                'last_run'   => time()
            );
            self::_saveCrons();
        }
    }

    public static function unregister( $name ) {
        if ( ! isset( self::$crons[$name] ) || ! isset( self::$functions[$name] ) ) {
            return;
        }

        remove_action( self::_cronName( $name ), self::$functions[$name] );
        unset( self::$crons[$name] );
        self::_saveCrons();
    }

    public static function put( $name, $function_name, $arguments = array() ) {
        $already_exist = count( array_filter( self::$queue, function( $item ) use ( $name ) {
            return $item['name'] == $name;
        } ) );

        if ( $already_exist ) {
            return false;
        }

        self::$queue[] = array(
            'name' => $name,
            'func' => $function_name,
            'args' => $arguments,
        );
        self::_saveQueue();
        return true;
    }

    public static function getCrons() {
        return self::$crons;
    }

    public static function getQueue() {
        return self::$queue;
    }

    public static function getCurrentCron() {
        if ( null == self::$current_cron ) {
            self::$current_cron = get_option( 'current_cron' );
        }

        return self::$current_cron;
    }

    public static function getCurrentQueue() {
        if ( null == self::$current_queue ) {
            self::$current_queue = get_option( 'current_queue' );
        }

        return self::$current_queue;
    }

    private static function _loadCrons() {
        self::$crons = get_option( 'crons' );

        if ( empty( self::$crons ) ) {
            self::$crons = [];
        }
    }

    private static function _saveCrons() {
        update_option( 'crons', self::$crons );

        if ( empty( self::$crons ) ) {
            self::$crons = [];
        }
    }

    private static function _loadQueue() {
        self::$queue = get_option( 'queue' );

        if ( empty( self::$queue ) ) {
            self::$queue = [];
        }
    }

    private static function _saveQueue() {
        update_option( 'queue', self::$queue );
    }

    private static function _currentCron( $name = false ) {
        $current = empty( $name ) ? null : array(
            'name'       => $name,
            'started_at' => time()
        );

        update_option( 'current_cron', $current );
    }

    private static function _currentQueue( $name = false ) {
        $current = empty( $name ) ? null : array(
            'name'       => $name,
            'started_at' => time()
        );

        update_option( 'current_cron', $current );
    }

    private static function _cronName( $name ) {
        return "cron_{$name}";
    }

    private static function _queueName( $name ) {
        return "queue_{$name}";
    }

    private static function _getNextCronList() {
        $names = [];

        foreach ( self::getCrons() as $name => $crondata ) {
            $cronexp = CronExpression::factory( $crondata['recurrence'] );
            $prevDate = $cronexp->getPreviousRunDate();

            if ( $prevDate->getTimeStamp() > $crondata['last_run'] ) {
                $names[] = $name;
            }
        }

        return $names;
    }

    private static function _runCron( $name ) {
        self::_currentCron( $name );
        do_action( self::_cronName( $name ) );
        self::_currentCron();

        if ( isset( self::$crons[$name] ) ) {
            self::$crons[$name]['last_run'] = time();
            self::_saveCrons();
        }
    }

    private static function _runNextInQueue() {
        if ( ! count( self::$queue ) || ! empty( self::getCurrentQueue() ) ) {
            return;
        }

        $item = array_shift( self::$queue );
        self::_currentQueue( $item['name'] );
        call_user_func_array( $item['func'], (array) $item['args'] );
        self::_currentQueue();
    }

    public static function run() {
        // Cron
        $crons = self::_getNextCronList();

        if ( count( $crons ) ) {
            foreach ( $crons as $name ) {
                self::_runCron( $name );
            }
        }

        // Queue
        self::_runNextInQueue();
    }
}

CronManager::init();