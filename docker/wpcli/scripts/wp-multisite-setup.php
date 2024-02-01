<?php
/**
 * Bail if not a WP-CLI request
 */
if ( ! defined( 'WP_CLI' ) ) {
	return;
}

class Setup_Multisite extends \WP_CLI_Command {

    var $sites;

    function __construct()
    {
        $this->sites  = array(
            array(
                'slug' => $_ENV["WP1_SLUG"] ,
                'title' => $_ENV["WP1_TITLE"] ,
            ),
            array(
                'slug' => $_ENV["WP2_SLUG"] ,
                'title' => $_ENV["WP2_TITLE"] ,
            ),
            array(
                'slug' => $_ENV["WP3_SLUG"] ,
                'title' => $_ENV["WP3_TITLE"] ,
            ),
            array(
                'slug' => $_ENV["WP4_SLUG"] ,
                'title' => $_ENV["WP4_TITLE"] ,
            )
            );
    }

	/**
	 * Install a number of test sites in a multisite environment.
	 */
	function install( $args ) {
        $number = 0;
		foreach ( $this->sites as $site ) {
			\WP_CLI::run_command( array( 'site', 'create' ),
				$site
			);
            $number++;
		}

		\WP_CLI::success( "$number sites created." );
	}

}

\WP_CLI::add_command( 'multisite', 'Setup_Multisite' );