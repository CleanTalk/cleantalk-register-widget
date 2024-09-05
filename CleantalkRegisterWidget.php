<?php

/*
  Plugin Name: CleanTalk register widget
  Plugin URI: https://cleantalk.org
  Description: The widget adds the ability to place the register form to the website sidebars.
  Version: 1.5.0
  Author: СleanTalk <welcome@cleantalk.org>
  Author URI: https://cleantalk.org
  Text Domain: cleantalk_register_widget
  Domain Path: /i18n
*/

// If this file is called directly, abort.
if ( !defined('WPINC') ) {
    die;
}

class CleantalkRegisterWidget extends WP_Widget
{
    static $defaults = array(
            'title' => 'Create your CleanTalk account',
            'source' => '',
            'product_name' => 'antispam',
            'subtitle' => '',
    );
    public function __construct()
    {
        if ( ! is_admin() ) {
            wp_enqueue_script(
                'ct_reg_widget_js',
                plugins_url('assets/js', __FILE__) . '/frontend.js',
                ['jquery']
            );
            wp_localize_script('ct_reg_widget_js', 'ctRegWidgetOptions', array(
                'ajaxUrl'   => admin_url('admin-ajax.php'),
            ));
            wp_enqueue_style(
                'ct_reg_widget_css',
                plugins_url('assets/css', __FILE__) . '/styles.css'
            );
        }

        $widget_options = array(
            'classname'   => 'cleantalk_register_widget',
            'description' => esc_html__(
                'CleanTalk register widget adds the ability to place the register form to the website sidebars',
                'cleantalk_register_widget'
            ),
        );
        parent::__construct(
            'cleantalk_register_widget',
            esc_html__('CleanTalk register widget', 'cleantalk_register_widget'),
            $widget_options
        );
    }

    // Вывод виджета в области виджетов на сайте.
    public function widget($args, $instance)
    {
        global $wp;

        $register_form = file_get_contents(__DIR__ . '/view/RegisterForm.php');
        $replaces = array(
            '{{WIDTH}}'        => '',
            '{{PRODUCT}}'        => isset($instance['product_name']) ? esc_html($instance['product_name']) : static::$defaults['product_name'],
            '{{SOURCE}}'        => isset($instance['source']) ? esc_html($instance['source']) : static::$defaults['source'],
            '{{CURRENT_URL}}'  => home_url($wp->request),
            '{{NONCE}}'        => wp_create_nonce('cleantalk_register_widget'),
            '{{TITLE}}'        => apply_filters(
                    'widget_title',
                    isset($instance['title'])
                        ? $instance['title']
                        : static::$defaults['title']
            ),
            '{{SUBTITLE}}'     => isset($instance['subtitle']) ? esc_html($instance['subtitle']) : static::$defaults['subtitle'],
            '{{PUBLIC_OFFER}}' => sprintf(
                esc_html__('By signing up, you agree with %s license%s.', 'cleantalk_register_widget'),
                '<a href="https://cleantalk.org/publicoffer" target="_blank">',
                '</a>'
            ),
            '{{LOGIN_LINK}}'   => sprintf(
                esc_html__('Have an account? %s Log in%s.', 'cleantalk_register_widget'),
                '<a href="https://cleantalk.org/my">',
                '</a>'
            ),
            '{{SUBMIT_BUTTON_TEXT}}' => esc_html__('Start your 7-day free trial', 'cleantalk_register_widget'),
        );

        echo str_replace(array_keys($replaces), array_values($replaces), $register_form);
    }


    public function form($instance)
    {
        $title = ! empty($instance['title']) ? $instance['title'] : static::$defaults['title'];
        $subtitle = ! empty($instance['subtitle']) ? $instance['subtitle'] : static::$defaults['subtitle'];
        $product_name = ! empty($instance['product_name']) ? $instance['product_name'] : static::$defaults['product_name'];
	    $source = ! empty($instance['source']) ? $instance['source'] : static::$defaults['source']; ?>
        <p>
        <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
        <input
                type="text"
                id="<?php echo $this->get_field_id('title'); ?>"
                name="<?php echo $this->get_field_name('title'); ?>"
                value="<?php echo esc_attr($title); ?>"
        />
        <label for="<?php echo $this->get_field_id('subtitle'); ?>">Subtitle:</label>
        <input
                type="text"
                id="<?php echo $this->get_field_id('subtitle'); ?>"
                name="<?php echo $this->get_field_name('subtitle'); ?>"
                value="<?php echo esc_attr($subtitle); ?>"
        />
        <label for="<?php echo $this->get_field_id('source'); ?>">Registration source</label>
        <input
                type="text"
                id="<?php echo $this->get_field_id('source'); ?>"
                name="<?php echo $this->get_field_name('source'); ?>"
                value="<?php echo esc_attr($source); ?>"
        />
        <label for="<?php echo $this->get_field_id('product_name'); ?>">Product name:</label>
        <select
                id="<?php echo $this->get_field_id('product_name'); ?>"
                name="<?php echo $this->get_field_name('product_name'); ?>"
                value="<?php echo esc_attr($product_name); ?>"
        >
            <option value="security">Security</option>
            <option value="antispam">Anti-Spam</option>
        </select>
        </p><?php
    }

    /**
     * Save the widget settings
     *
     * @param $new_instance
     * @param $old_instance
     *
     * @return array
     */
    public function update($new_instance, $old_instance)
    {
        $instance          = [];
        $instance['title'] = ! empty($new_instance['title'])
            ? strip_tags($new_instance['title'])
            : esc_html__(static::$defaults['title']);
        $instance['subtitle'] = ! empty($new_instance['subtitle'])
            ? strip_tags($new_instance['subtitle'])
            : static::$defaults['subtitle'];
        $instance['product_name'] = ! empty($new_instance['product_name'])
            ? strip_tags($new_instance['product_name'])
            : static::$defaults['product_name'];
	    $instance['source'] = ! empty($new_instance['source'])
		    ? strip_tags($new_instance['source'])
		    : static::$defaults['source'];
        return $instance;
    }
}

/**
 * Register the widget
 * @return void
 */
function cleantalk_register_widget()
{
    register_widget('CleantalkRegisterWidget');
}
add_action('widgets_init', 'cleantalk_register_widget');

/**
 * Register the shortcode
 * @param $atts
 *
 * @return string
 */
function CleantalkRegisterFormShortcodeHandler($atts){
    global $wp;

    $register_form = file_get_contents(__DIR__ . '/view/RegisterForm.php');
    $replaces = array(
        '{{WIDTH}}'        => isset($atts['width']) ? 'style="width:' . esc_attr($atts['width']) . '"' : '',
        '{{CURRENT_URL}}'  => home_url($wp->request),
        '{{NONCE}}'        => wp_create_nonce('cleantalk_register_widget'),
        '{{TITLE}}'        => isset($atts['title']) ? esc_html($atts['title']) : '',
        '{{SUBTITLE}}'     => isset($atts['subtitle']) ? esc_html($atts['subtitle']) : '',
        '{{PRODUCT}}'     => isset($atts['product_name']) ? esc_html($atts['product_name']) : '',
        '{{SOURCE}}'     => isset($atts['source']) ? esc_html($atts['source']) : '',
        '{{PUBLIC_OFFER}}' => sprintf(
            esc_html__('By signing up, you agree with %s license%s.', 'cleantalk_register_widget'),
            '<a href="https://cleantalk.org/publicoffer" target="_blank">',
            '</a>'
        ),
        '{{LOGIN_LINK}}'   => sprintf(
            esc_html__('Have an account? %s Log in%s.', 'cleantalk_register_widget'),
            '<a href="https://cleantalk.org/my">',
            '</a>'
        ),
        '{{SUBMIT_BUTTON_TEXT}}' => esc_html__('Start your 7-day free trial', 'cleantalk_register_widget'),
    );

    return str_replace(array_keys($replaces), array_values($replaces), $register_form);
}
add_shortcode('CleantalkRegisterFormShortcode', 'CleantalkRegisterFormShortcodeHandler');

/**
 * Ajax handler to get key
 * @return void
 */
function cleantalk_register_widget__get_api_key()
{
    check_ajax_referer('cleantalk_register_widget');

    $url = 'https://api.cleantalk.org';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $website = isset($_POST['website']) ? sanitize_url($_POST['website']) : '';
    $product_name = isset($_POST['product_name']) ? esc_html($_POST['product_name']) : '';
    $source = isset($_POST['source']) ? esc_html($_POST['source']) : '';
    $prepared_post = array(
        'body' => [
            'method_name' => 'get_api_key',
            'product_name' => $product_name,
            'email' => $email,
            'website' => $website,
            'lead_source' => $source,
        ],
    );

    $server_response = wp_remote_post(
	    $url, $prepared_post
    );

    if ( isset($server_response['body']) ) {
        $message = json_decode($server_response['body'], ARRAY_A);
        if ( isset($message['error_message']) ) {
            wp_send_json_error($message['error_message']);
        } else {
            wp_send_json_success(esc_html('Thank you for registering! Check your email to access the Dashboard.', 'cleantalk_register_widget'));
        }
    }

    wp_send_json_error('unknown response');

}
add_action('wp_ajax_nopriv_cleantalk_register_widget__get_api_key', 'cleantalk_register_widget__get_api_key');
add_action('wp_ajax_cleantalk_register_widget__get_api_key', 'cleantalk_register_widget__get_api_key');
