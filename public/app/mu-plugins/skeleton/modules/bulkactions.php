<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class BulkAction {

    private $action = '';
    private $name = '';
    private $hook = '';

    private static $actions = array();

    public function __construct( $action, $name, $hook ) {
        $this->action = $action;
        $this->name = $name;
        $this->hook = $hook;
        self::register( $this );
    }

    public function getAction() {
        return $this->action;
    }

    public function getName() {
        return $this->name;
    }

    public function getHook() {
        return $this->hook;
    }

    public function do_action( $ids ) {
    }
    
	static function init() {
		add_action( 'load-edit.php', 'BulkAction::edit_action' );
		add_action( 'load-users.php', 'BulkAction::user_action' );
		add_action( 'admin_footer-users.php', 'BulkAction::user_js' );
		add_action( 'admin_footer-edit.php', 'BulkAction::edit_js' );
	}

    static function register( BulkAction $bulkaction ) {
        if ( ! isset( self::$actions[ $bulkaction->getHook() ] ) ) {
            self::$actions[ $bulkaction->getHook() ] = array();
        }

        self::$actions[ $bulkaction->getHook() ][ $bulkaction->getAction() ] = $bulkaction;
    }

    static function user_js() {
        self::js( 'user' );
	}

    static function edit_js() {
        global $post_type;
        self::js( $post_type );
	}

	static function js( $hook ) {
        if ( ! isset( self::$actions[ $hook ] ) ) {
            return;
        }
        
		?>
		<script type="text/javascript">
            jQuery(function() {
				jQuery('select[name="action"], select[name="action2"]')
				<?php foreach ( self::$actions[ $hook ] as $bulkaction ) : ?>
					.append('<option value="<?= $bulkaction->getAction() ?>"><?= $bulkaction->getName(); ?></option>')
				<?php endforeach; ?>
				;
            });
		</script>
		<?php
	}

	static function edit_action() {
        if ( isset( $_GET['post_type'] ) ) {
            self::action( 'WP_Posts_List_Table', $_GET['post_type'] );
        }
	}

	static function user_action() {
        self::action( 'WP_Users_List_Table', 'user' );
	}

	static function action( $list_table_class, $hook ) {
        if ( ! isset ( self::$actions[$hook] ) ) {
            return;
        }

		$wp_list_table = _get_list_table( $list_table_class );

        if ($wp_list_table) {
            $action = $wp_list_table->current_action();
            $ids    = self::get_ids( $hook );

            if ( ! count( $ids ) || ! isset( self::$actions[$hook][$action] ) ) {
                return;
            }

            self::$actions[$hook][$action]->do_action( $ids );
        }
	}

    static function get_ids( $hook ) {

        switch ( $hook ) {
            case 'user':
                if ( isset( $_GET['users'] ) ) {
                    return $_GET['users'];
                }
            default:
                if ( isset( $_GET['post'] ) ) {
                    return $_GET['post'];
                }
        }

        return array();

    }
}

BulkAction::init();