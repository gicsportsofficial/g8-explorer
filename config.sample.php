<?php

require_once __DIR__ . '/include/w8_error_handler.php';
require_once __DIR__ . '/vendor/autoload.php';
use deemru\WavesKit;

date_default_timezone_set( 'UTC' );

function wk( $full = true ) : WavesKit
{
    static $wk;

    if( !isset( $wk ) )
    {
        $wk = new WavesKit( W8IO_NETWORK, [ 'g', 'e', 'i', 's' ] );
        if( $full )
        {
            $nodes = explode( '|', W8IO_NODES );
            define( 'WK_CURL_SETBESTONERROR', true );
            $wk->setNodeAddress( $nodes, 0 );
            $wk->setCryptash( 'SECRET_STRING_SET_YOURS_HERE' );
        }
    }

    return $wk;
}

function w8_err( $message = '(no message)' )
{
    if( isset( $_SERVER['REQUEST_URI'] ) )
        $message .= ' (' . $_SERVER['REQUEST_URI'] . ')';
    trigger_error( $message, E_USER_ERROR );
}

define( 'W8IO_DB_DIR', __DIR__ . '/var/db/' );
define( 'W8IO_DB_PATH', W8IO_DB_DIR . 'blockchain.sqlite3' );
define( 'W8DB', 'sqlite:' . W8IO_DB_PATH );

define( 'W8IO_NODES', 'http://127.0.0.1:6869|https://nodes.gscscan.com' );
define( 'W8IO_MATCHER', 'https://matcher.futfinance.com' );
define( 'W8IO_NETWORK', 'G' ); // 'W' -- mainnet, 'T' -- testnet
define( 'W8IO_ROOT', '/' );
define( 'W8IO_MAX_UPDATE_BATCH', 1 ); // set more on when on a local node
define( 'W8IO_UPDATE_DELAY', 1 );
define( 'W8IO_UPDATE_PROCS', 1 );
define( 'WK_CURL_TIMEOUT', 15 );
define( 'W8IO_MAX_MEMORY', 1024 * 1024 * 1024 );
