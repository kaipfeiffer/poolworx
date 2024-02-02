<?php

/**
 * Bail if not a WP-CLI request
 */
if (!defined('WP_CLI')) {
    return;
}

class Setup_Multisite extends \WP_CLI_Command
{

    var $sites;

    function __construct()
    {
        $this->sites  = array(
            array(
                'slug' => $_ENV["WP1_SLUG"],
                'title' => $_ENV["WP1_TITLE"],
                'url'   => $_ENV["WP_SCHEME"] . '://'.$_ENV["WP_IP"].':' . $_ENV["WP_PORT"].'/'.$_ENV["WP1_SLUG"]
            ),
            array(
                'slug' => $_ENV["WP2_SLUG"],
                'title' => $_ENV["WP2_TITLE"],
                'url'   => $_ENV["WP_SCHEME"] . '://'.$_ENV["WP_IP"].':' . $_ENV["WP_PORT"].'/'.$_ENV["WP2_SLUG"]
            ),
            array(
                'slug' => $_ENV["WP3_SLUG"],
                'title' => $_ENV["WP3_TITLE"],
                'url'   => $_ENV["WP_SCHEME"] . '://'.$_ENV["WP_IP"].':' . $_ENV["WP_PORT"].'/'.$_ENV["WP3_SLUG"]
            ),
            array(
                'slug' => $_ENV["WP4_SLUG"],
                'title' => $_ENV["WP4_TITLE"],
                'url'   => $_ENV["WP_SCHEME"] . '://'.$_ENV["WP_IP"].':' . $_ENV["WP_PORT"].'/'.$_ENV["WP4_SLUG"]
            )
        );
    }

    /**
     * Install a number of test sites in a multisite environment.
     */
    function install($args)
    {
        $number = 0;
        foreach ($this->sites as $site) {
            echo print_r($site,1);
            // \WP_CLI::run_command(
            //     array('site', 'create'),$site
            // );
            exec('wp site create  --slug="'.$site['slug'].'" --url="'.$site['url'].'" --title="'.$site['title'].'"',$output, $res);
            
            echo 'Done... '.$res.'->'.print_r($output,1);
            echo 'Done...';
            $number++;
        }

        \WP_CLI::success("$number sites created.");
    }
}

\WP_CLI::add_command('multisite', 'Setup_Multisite');
