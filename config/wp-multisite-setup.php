<?php

/**
 * Bail if not a WP-CLI request
 */
if (!defined('WP_CLI')) {
    return;
}

require __DIR__ . '/wp-multisite-settings.php';

class Setup_Multisite extends \WP_CLI_Command
{
    // use Trait with settings
    use SETTINGS;

    function __construct()
    {
    }

    /**
     * Install the sites from the settings in SETTINGS::$sites
     */
    function install($args)
    {
        $server_data = array(
            'protocol'  => array(
                'regex' => '/^[Hh][Tt][Tt][Pp][Ss]?$/',
                'value' => 'http'
            ),
            'host'      => array(
                'regex' => '/^([a-z0-9][a-z0-9-_]*\.{0,1})+$/',
                'value' => 'localhost'
            ),
            'port'      => array(
                'regex' => '/^\d+$/',
                'value' => '80'
            ),
        );

        foreach ($args as $arg) {
            $server_keys    = array_keys($server_data);
            $i              = 0;
            $done           = false;
            while ($i < count($server_keys) && !$done) {
                $key    =  $server_keys[$i++];
                if (preg_match($server_data[$key]['regex'], $arg) && !isset($server_data[$key]['updated'])) {
                    $server_data[$key]['value']     = $arg;
                    $server_data[$key]['updated']   = $done     = true;
                }
            }
        }

        $host          = $server_data['host']['value'];
        $port          = $server_data['port']['value'];
        $protocol      = $server_data['protocol']['value'];

        $number = 0;

        foreach ($this->sites as $site) {
            $site['domain'] = $host . ($port && 80 !== +$port ? ':' . $port : '');
            $site['url']    = $protocol . '://' . $site['domain'] . '/' . $site['slug'];

            exec('wp site create  --slug="' . $site['slug'] . '" --url="' . $site['url'] . '" --title="' . $site['title'] . '"', $output, $res);
            $blog_id = $number + 2;
            // update site_url and home
            exec('wp db query "UPDATE wp_' . $blog_id . '_options SET option_value=\"' . $site['url'] . '\" WHERE option_id IN (1,2)"');
            // update domain in wp_blogs
            exec('wp db query "UPDATE wp_blogs SET domain=\"' . $site['domain'] . '\" WHERE blog_id = ' . $blog_id . '"');

            echo $site['url'].' created'."\n";
            $number++;
        }

        \WP_CLI::success("$number sites created.");
    }
}

\WP_CLI::add_command('multisite', 'Setup_Multisite');
