<?php

// class CronManager {
    
//     public function init() {

//     }

//     public function convert_cron_expression( $expression ) {
//         if ( ! is_array( $expression ) ) {
//             $expression = explode( ' ', $expression );
//         }

//         if ( count( $expression ) !== 5 ) {
//             return;
//         }


//         '*'
//         '*/n'
//         'n'
//     }

//     public function run() {

//     }

// }

// add_action( 'init', 'CronManager::init' );

// array(
//     'day' => 'every', //1 = first day, last = last day
//     'month' => 'every',
//     'year' => 'every',
//     'hour' => 'every',
//     'minute' => 'every',
//     'second' => 'every',
// )

// abstract class Cron {

//     private $name;
//     private $timestamp;
//     private $recurrence;

//     public function __construct( $name, $timestamp, $recurrence ) {
//         $this->name       = $name;
//         $this->timestamp  = $timestamp;
//         $this->recurrence = $recurrence;
//     }

//     abstract function run();
// }

// class MyCron extends Cron {

//     public function __construct() {
//         parent::__construct( 'MyCron', '*/*/* *:*' );
//         $this->name       = $name;
//         $this->recurrence = $recurrence;
//     }

//     public function run() {

//     }

// }

// add_filter( 'cron_schedules', 'filter_cron_schedules' );
// function filter_cron_schedules( $schedules ) {
//     $schedules['hourly']     = array( 'interval' => HOUR_IN_SECONDS,      'display' => __( 'Once Hourly' ) );
//     $schedules['twicedaily'] = array( 'interval' => 12 * HOUR_IN_SECONDS, 'display' => __( 'Twice Daily' ) );
//     $schedules['daily']      = array( 'interval' => DAY_IN_SECONDS,       'display' => __( 'Once Daily' ) );
//     return $schedules;
// }