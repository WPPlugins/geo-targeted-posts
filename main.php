<?php  
/* 
    Plugin Name: Geo Targeted Posts
    Description: Show posts only for specified countries. 
    Version: 0.8.3
    Author: Karolis Giedraitis
    Author URI: http://karolis.lt
    Text Domain: gtp
    License: GPL2 or later
*/  

/*  
    Copyright 2014 Karolis Giedraitis  (email: info@karolis.lt)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class GeoTargeted_Posts {
    public $countryList = array();
    public $countryCodesList = array();
    public $post_types = array();
    public $exclude_post_types = array();

    public function __construct() {
        load_plugin_textdomain( 'gtp', false, basename( dirname( __FILE__ ) ) . '/languages' );

        $this->countryList = array(
            'a1' => __( "Anonymous Proxy", 'gtp' ),
            'a2' => __( "Satellite Provider", 'gtp' ),
            'o1' => __( "Other Country", 'gtp' ),
            'ad' => __( "Andorra", 'gtp' ),
            'ae' => __( "United Arab Emirates", 'gtp' ),
            'af' => __( "Afghanistan", 'gtp' ),
            'ag' => __( "Antigua and Barbuda", 'gtp' ),
            'ai' => __( "Anguilla", 'gtp' ),
            'al' => __( "Albania", 'gtp' ),
            'am' => __( "Armenia", 'gtp' ),
            'ao' => __( "Angola", 'gtp' ),
            'ap' => __( "Asia/Pacific Region", 'gtp' ),
            'aq' => __( "Antarctica", 'gtp' ),
            'ar' => __( "Argentina", 'gtp' ),
            'as' => __( "American Samoa", 'gtp' ),
            'at' => __( "Austria", 'gtp' ),
            'au' => __( "Australia", 'gtp' ),
            'aw' => __( "Aruba", 'gtp' ),
            'ax' => __( "Aland Islands", 'gtp' ),
            'az' => __( "Azerbaijan", 'gtp' ),
            'ba' => __( "Bosnia and Herzegovina", 'gtp' ),
            'bb' => __( "Barbados", 'gtp' ),
            'bd' => __( "Bangladesh", 'gtp' ),
            'be' => __( "Belgium", 'gtp' ),
            'bf' => __( "Burkina Faso", 'gtp' ),
            'bg' => __( "Bulgaria", 'gtp' ),
            'bh' => __( "Bahrain", 'gtp' ),
            'bi' => __( "Burundi", 'gtp' ),
            'bj' => __( "Benin", 'gtp' ),
            'bl' => __( "Saint Bartelemey", 'gtp' ),
            'bm' => __( "Bermuda", 'gtp' ),
            'bn' => __( "Brunei Darussalam", 'gtp' ),
            'bo' => __( "Bolivia", 'gtp' ),
            'bq' => __( "Bonaire, Saint Eustatius and Saba", 'gtp' ),
            'br' => __( "Brazil", 'gtp' ),
            'bs' => __( "Bahamas", 'gtp' ),
            'bt' => __( "Bhutan", 'gtp' ),
            'bv' => __( "Bouvet Island", 'gtp' ),
            'bw' => __( "Botswana", 'gtp' ),
            'by' => __( "Belarus", 'gtp' ),
            'bz' => __( "Belize", 'gtp' ),
            'ca' => __( "Canada", 'gtp' ),
            'cc' => __( "Cocos (Keeling) Islands", 'gtp' ),
            'cd' => __( "Congo, The Democratic Republic of the", 'gtp' ),
            'cf' => __( "Central African Republic", 'gtp' ),
            'cg' => __( "Congo", 'gtp' ),
            'ch' => __( "Switzerland", 'gtp' ),
            'ci' => __( "Cote d'Ivoire", 'gtp' ),
            'ck' => __( "Cook Islands", 'gtp' ),
            'cl' => __( "Chile", 'gtp' ),
            'cm' => __( "Cameroon", 'gtp' ),
            'cn' => __( "China", 'gtp' ),
            'co' => __( "Colombia", 'gtp' ),
            'cr' => __( "Costa Rica", 'gtp' ),
            'cu' => __( "Cuba", 'gtp' ),
            'cv' => __( "Cape Verde", 'gtp' ),
            'cw' => __( "Curacao", 'gtp' ),
            'cx' => __( "Christmas Island", 'gtp' ),
            'cy' => __( "Cyprus", 'gtp' ),
            'cz' => __( "Czech Republic", 'gtp' ),
            'de' => __( "Germany", 'gtp' ),
            'dj' => __( "Djibouti", 'gtp' ),
            'dk' => __( "Denmark", 'gtp' ),
            'dm' => __( "Dominica", 'gtp' ),
            'do' => __( "Dominican Republic", 'gtp' ),
            'dz' => __( "Algeria", 'gtp' ),
            'ec' => __( "Ecuador", 'gtp' ),
            'ee' => __( "Estonia", 'gtp' ),
            'eg' => __( "Egypt", 'gtp' ),
            'eh' => __( "Western Sahara", 'gtp' ),
            'er' => __( "Eritrea", 'gtp' ),
            'es' => __( "Spain", 'gtp' ),
            'et' => __( "Ethiopia", 'gtp' ),
            'eu' => __( "Europe", 'gtp' ),
            'fi' => __( "Finland", 'gtp' ),
            'fj' => __( "Fiji", 'gtp' ),
            'fk' => __( "Falkland Islands (Malvinas)", 'gtp' ),
            'fm' => __( "Micronesia, Federated States of", 'gtp' ),
            'fo' => __( "Faroe Islands", 'gtp' ),
            'fr' => __( "France", 'gtp' ),
            'ga' => __( "Gabon", 'gtp' ),
            'gb' => __( "United Kingdom", 'gtp' ),
            'gd' => __( "Grenada", 'gtp' ),
            'ge' => __( "Georgia", 'gtp' ),
            'gf' => __( "French Guiana", 'gtp' ),
            'gg' => __( "Guernsey", 'gtp' ),
            'gh' => __( "Ghana", 'gtp' ),
            'gi' => __( "Gibraltar", 'gtp' ),
            'gl' => __( "Greenland", 'gtp' ),
            'gm' => __( "Gambia", 'gtp' ),
            'gn' => __( "Guinea", 'gtp' ),
            'gp' => __( "Guadeloupe", 'gtp' ),
            'gq' => __( "Equatorial Guinea", 'gtp' ),
            'gr' => __( "Greece", 'gtp' ),
            'gs' => __( "South Georgia and the South Sandwich Islands", 'gtp' ),
            'gt' => __( "Guatemala", 'gtp' ),
            'gu' => __( "Guam", 'gtp' ),
            'gw' => __( "Guinea-Bissau", 'gtp' ),
            'gy' => __( "Guyana", 'gtp' ),
            'hk' => __( "Hong Kong", 'gtp' ),
            'hm' => __( "Heard Island and McDonald Islands", 'gtp' ),
            'hn' => __( "Honduras", 'gtp' ),
            'hr' => __( "Croatia", 'gtp' ),
            'ht' => __( "Haiti", 'gtp' ),
            'hu' => __( "Hungary", 'gtp' ),
            'id' => __( "Indonesia", 'gtp' ),
            'ie' => __( "Ireland", 'gtp' ),
            'il' => __( "Israel", 'gtp' ),
            'im' => __( "Isle of Man", 'gtp' ),
            'in' => __( "India", 'gtp' ),
            'io' => __( "British Indian Ocean Territory", 'gtp' ),
            'iq' => __( "Iraq", 'gtp' ),
            'ir' => __( "Iran, Islamic Republic of", 'gtp' ),
            'is' => __( "Iceland", 'gtp' ),
            'it' => __( "Italy", 'gtp' ),
            'je' => __( "Jersey", 'gtp' ),
            'jm' => __( "Jamaica", 'gtp' ),
            'jo' => __( "Jordan", 'gtp' ),
            'jp' => __( "Japan", 'gtp' ),
            'ke' => __( "Kenya", 'gtp' ),
            'kg' => __( "Kyrgyzstan", 'gtp' ),
            'kh' => __( "Cambodia", 'gtp' ),
            'ki' => __( "Kiribati", 'gtp' ),
            'km' => __( "Comoros", 'gtp' ),
            'kn' => __( "Saint Kitts and Nevis", 'gtp' ),
            'kp' => __( "Korea, Democratic People's Republic of", 'gtp' ),
            'kr' => __( "Korea, Republic of", 'gtp' ),
            'kw' => __( "Kuwait", 'gtp' ),
            'ky' => __( "Cayman Islands", 'gtp' ),
            'kz' => __( "Kazakhstan", 'gtp' ),
            'la' => __( "Lao People's Democratic Republic", 'gtp' ),
            'lb' => __( "Lebanon", 'gtp' ),
            'lc' => __( "Saint Lucia", 'gtp' ),
            'li' => __( "Liechtenstein", 'gtp' ),
            'lk' => __( "Sri Lanka", 'gtp' ),
            'lr' => __( "Liberia", 'gtp' ),
            'ls' => __( "Lesotho", 'gtp' ),
            'lt' => __( "Lithuania", 'gtp' ),
            'lu' => __( "Luxembourg", 'gtp' ),
            'lv' => __( "Latvia", 'gtp' ),
            'ly' => __( "Libyan Arab Jamahiriya", 'gtp' ),
            'ma' => __( "Morocco", 'gtp' ),
            'mc' => __( "Monaco", 'gtp' ),
            'md' => __( "Moldova", 'gtp' ),
            'me' => __( "Montenegro", 'gtp' ),
            'mf' => __( "Saint Martin", 'gtp' ),
            'mg' => __( "Madagascar", 'gtp' ),
            'mh' => __( "Marshall Islands", 'gtp' ),
            'mk' => __( "Macedonia", 'gtp' ),
            'ml' => __( "Mali", 'gtp' ),
            'mm' => __( "Myanmar", 'gtp' ),
            'mn' => __( "Mongolia", 'gtp' ),
            'mo' => __( "Macao", 'gtp' ),
            'mp' => __( "Northern Mariana Islands", 'gtp' ),
            'mq' => __( "Martinique", 'gtp' ),
            'mr' => __( "Mauritania", 'gtp' ),
            'ms' => __( "Montserrat", 'gtp' ),
            'mt' => __( "Malta", 'gtp' ),
            'mu' => __( "Mauritius", 'gtp' ),
            'mv' => __( "Maldives", 'gtp' ),
            'mw' => __( "Malawi", 'gtp' ),
            'mx' => __( "Mexico", 'gtp' ),
            'my' => __( "Malaysia", 'gtp' ),
            'mz' => __( "Mozambique", 'gtp' ),
            'na' => __( "Namibia", 'gtp' ),
            'nc' => __( "New Caledonia", 'gtp' ),
            'ne' => __( "Niger", 'gtp' ),
            'nf' => __( "Norfolk Island", 'gtp' ),
            'ng' => __( "Nigeria", 'gtp' ),
            'ni' => __( "Nicaragua", 'gtp' ),
            'nl' => __( "Netherlands", 'gtp' ),
            'no' => __( "Norway", 'gtp' ),
            'np' => __( "Nepal", 'gtp' ),
            'nr' => __( "Nauru", 'gtp' ),
            'nu' => __( "Niue", 'gtp' ),
            'nz' => __( "New Zealand", 'gtp' ),
            'om' => __( "Oman", 'gtp' ),
            'pa' => __( "Panama", 'gtp' ),
            'pe' => __( "Peru", 'gtp' ),
            'pf' => __( "French Polynesia", 'gtp' ),
            'pg' => __( "Papua New Guinea", 'gtp' ),
            'ph' => __( "Philippines", 'gtp' ),
            'pk' => __( "Pakistan", 'gtp' ),
            'pl' => __( "Poland", 'gtp' ),
            'pm' => __( "Saint Pierre and Miquelon", 'gtp' ),
            'pn' => __( "Pitcairn", 'gtp' ),
            'pr' => __( "Puerto Rico", 'gtp' ),
            'ps' => __( "Palestinian Territory", 'gtp' ),
            'pt' => __( "Portugal", 'gtp' ),
            'pw' => __( "Palau", 'gtp' ),
            'py' => __( "Paraguay", 'gtp' ),
            'qa' => __( "Qatar", 'gtp' ),
            're' => __( "Reunion", 'gtp' ),
            'ro' => __( "Romania", 'gtp' ),
            'rs' => __( "Serbia", 'gtp' ),
            'ru' => __( "Russian Federation", 'gtp' ),
            'rw' => __( "Rwanda", 'gtp' ),
            'sa' => __( "Saudi Arabia", 'gtp' ),
            'sb' => __( "Solomon Islands", 'gtp' ),
            'sc' => __( "Seychelles", 'gtp' ),
            'sd' => __( "Sudan", 'gtp' ),
            'se' => __( "Sweden", 'gtp' ),
            'sg' => __( "Singapore", 'gtp' ),
            'sh' => __( "Saint Helena", 'gtp' ),
            'si' => __( "Slovenia", 'gtp' ),
            'sj' => __( "Svalbard and Jan Mayen", 'gtp' ),
            'sk' => __( "Slovakia", 'gtp' ),
            'sl' => __( "Sierra Leone", 'gtp' ),
            'sm' => __( "San Marino", 'gtp' ),
            'sn' => __( "Senegal", 'gtp' ),
            'so' => __( "Somalia", 'gtp' ),
            'sr' => __( "Suriname", 'gtp' ),
            'ss' => __( "South Sudan", 'gtp' ),
            'st' => __( "Sao Tome and Principe", 'gtp' ),
            'sv' => __( "El Salvador", 'gtp' ),
            'sx' => __( "Sint Maarten", 'gtp' ),
            'sy' => __( "Syrian Arab Republic", 'gtp' ),
            'sz' => __( "Swaziland", 'gtp' ),
            'tc' => __( "Turks and Caicos Islands", 'gtp' ),
            'td' => __( "Chad", 'gtp' ),
            'tf' => __( "French Southern Territories", 'gtp' ),
            'tg' => __( "Togo", 'gtp' ),
            'th' => __( "Thailand", 'gtp' ),
            'tj' => __( "Tajikistan", 'gtp' ),
            'tk' => __( "Tokelau", 'gtp' ),
            'tl' => __( "Timor-Leste", 'gtp' ),
            'tm' => __( "Turkmenistan", 'gtp' ),
            'tn' => __( "Tunisia", 'gtp' ),
            'to' => __( "Tonga", 'gtp' ),
            'tr' => __( "Turkey", 'gtp' ),
            'tt' => __( "Trinidad and Tobago", 'gtp' ),
            'tv' => __( "Tuvalu", 'gtp' ),
            'tw' => __( "Taiwan", 'gtp' ),
            'tz' => __( "Tanzania", 'gtp' ),
            'ua' => __( "Ukraine", 'gtp' ),
            'ug' => __( "Uganda", 'gtp' ),
            'um' => __( "United States Minor Outlying Islands", 'gtp' ),
            'us' => __( "United States", 'gtp' ),
            'uy' => __( "Uruguay", 'gtp' ),
            'uz' => __( "Uzbekistan", 'gtp' ),
            'va' => __( "Holy See (Vatican City State)", 'gtp' ),
            'vc' => __( "Saint Vincent and the Grenadines", 'gtp' ),
            've' => __( "Venezuela", 'gtp' ),
            'vg' => __( "Virgin Islands, British", 'gtp' ),
            'vi' => __( "Virgin Islands, U.S.", 'gtp' ),
            'vn' => __( "Vietnam", 'gtp' ),
            'vu' => __( "Vanuatu", 'gtp' ),
            'wf' => __( "Wallis and Futuna", 'gtp' ),
            'ws' => __( "Samoa", 'gtp' ),
            'ye' => __( "Yemen", 'gtp' ),
            'yt' => __( "Mayotte", 'gtp' ),
            'za' => __( "South Africa", 'gtp' ),
            'zm' => __( "Zambia", 'gtp' ),
            'zw' => __( "Zimbabwe", 'gtp' )
        );
        $this->countryCodesList = array_keys( $this->countryList );

        // actions        
        add_action( 'admin_head', array( $this, 'gtp_admin_header' ) );        
        add_action( 'init', array( $this, 'gtp_assign_post_types' ), 20 );
        add_action( 'admin_init', array( $this, 'register_gtp_settings' ) );
        add_action( 'admin_init', array( $this, 'gtp_post_list_columns' ) );
        add_action( 'admin_menu', array( $this, 'register_gtp_submenu_page' ) );
        add_action( 'post_submitbox_misc_actions', array( $this, 'gtp_post' ) );
        add_action( 'save_post', array( $this, 'gtp_save_countries' ), 10, 2 );
        add_action( 'pre_get_posts', array( $this, 'gtp_column_orderby' ) );
        add_action( 'bulk_edit_custom_box', array( $this, 'gtp_quick_edit_custom_box' ), 10, 2 );
        add_action( 'quick_edit_custom_box', array( $this, 'gtp_quick_edit_custom_box' ), 10, 2 );
        add_action( 'wp_ajax_gtp_save_bulk_edit', array( $this, 'gtp_save_bulk_edit' ) );

        // filters
        add_filter( 'posts_clauses', array( $this, 'gtp_filter_posts' ), 10, 2 );
    }

    /**
     * Actions functions
     */
    public function gtp_admin_header() {
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'select2.js', plugins_url( '/assets/js/select2.min.js', __FILE__ ) );
        wp_register_script( 'gtp.js', plugins_url( '/assets/js/gtp.main.js', __FILE__ ) );
        wp_localize_script( 'gtp.js', 'available_countries', $this->countryList );
        wp_enqueue_script( 'gtp.js' );

        wp_enqueue_script( 'gtp-quick-edit', plugins_url( '/assets/js/quick_edit.js', __FILE__ ), array( 'jquery', 'inline-edit-post' ), '', true );

        wp_enqueue_style( 'select2.css', plugins_url( '/assets/css/select2.css', __FILE__ ) );
        wp_enqueue_style( 'gtp.css', plugins_url( '/assets/css/style.css', __FILE__ ) );
    }

    public function gtp_assign_post_types() {
        $this->exclude_post_types = apply_filters( 'gtp_exclude_post_types', array( 'attachment', 'revision', 'nav_menu_item', 'product_variation', 'shop_order', 'shop_order_refund', 'shop_coupon', 'shop_webhook' ) );
        $this->post_types = array_diff( get_post_types( '', 'names' ), $this->exclude_post_types );
    }

    public function gtp_post_list_columns() {
        $post_types = $this->gtp_get_active_post_types();       

        if ( !empty( $post_types ) ) {
            foreach ( $post_types as $post_type ) {
                add_filter( 'manage_' . $post_type . '_posts_columns', array( $this, 'gtp_custom_column_head' ), 10, 1 );
                add_filter( 'manage_edit-' . $post_type . '_sortable_columns', array( $this, 'gtp_sortable_column' ) );
                add_action( 'manage_' . $post_type . '_posts_custom_column' , array( $this, 'gtp_custom_columns' ), 10, 2 );
            }
        }
    }

    public function gtp_get_active_post_types( $all = false ) {
        switch ( get_option( 'gtp_post_list' ) ) {
            case 'show':
                $post_types = $this->post_types;
                break;
            case 'show_sel':
                $post_types = get_option( 'gtp_post_list_posttypes' );
                break;
            case 'hide_sel':
                $post_types = array_diff( $this->post_types, get_option( 'gtp_post_list_posttypes' ) );
                break;
            default:
                $post_types = get_post_types( '', 'names' );
                break;
        }

        return $post_types;
    }

    public function gtp_is_post_type_active( $post_type = '' ) {
        if ( $post_type == '' ) {
            $post_type = get_post_type();
        }

        return in_array( $post_type, $this->gtp_get_active_post_types() );
    }

    public function register_gtp_settings() {
        register_setting( 'gtp-settings-group', 'gtp_frontpage_posts' );
        register_setting( 'gtp-settings-group', 'gtp_simulate_location' );
        register_setting( 'gtp-settings-group', 'gtp_post_list' );
        register_setting( 'gtp-settings-group', 'gtp_post_list_posttypes' );
        register_setting( 'gtp-settings-group', 'gtp_plugin_active' );
    }

    public function register_gtp_submenu_page() {
        add_submenu_page( 'options-general.php', 'Geo Targeted Posts', 'Geo Targeted Posts', 'manage_options', 'gtp-settings', array( $this, 'gtp_submenu_page_callback' ) ); 
    }

    public function gtp_submenu_page_callback() {
        $gtp_frontpage_posts = esc_attr( get_option( 'gtp_frontpage_posts' ) );
        $gtp_simulate_location = esc_attr( get_option( 'gtp_simulate_location' ) );
        $gtp_post_list = esc_attr( get_option( 'gtp_post_list' ) );
        $gtp_post_list_posttypes = get_option( 'gtp_post_list_posttypes' );
        $gtp_plugin_active = esc_attr( get_option( 'gtp_plugin_active' ) );
        $gtp_frontpage_posts = ! empty( $gtp_frontpage_posts ) ? $gtp_frontpage_posts : 'none';
        $gtp_simulate_location = ! empty( $gtp_simulate_location ) ? $gtp_simulate_location : 'no-simulation';
        $gtp_post_list = ! empty( $gtp_post_list ) ? $gtp_post_list : 'show';
        $gtp_post_list_posttypes = ! empty( $gtp_post_list_posttypes ) ? $gtp_post_list_posttypes : array();
        $gtp_plugin_active = ! empty( $gtp_plugin_active ) ? $gtp_plugin_active : 'yes';
        ?>
        <div class="wrap">
            <h2><?php _e( 'Geo Targeted Posts Settings', 'gtp' ); ?></h2>
            <form method="post" action="options.php">
                <?php settings_fields( 'gtp-settings-group' ); ?>
                <?php do_settings_sections( 'gtp-settings-group' ); ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><?php _e( 'Geo Targeted filtering is', 'gtp' ); ?></th>
                        <td>
                            <p>
                                <input type="radio" name="gtp_plugin_active" value="yes" id="plugin-active-yes"<?php echo ( $gtp_plugin_active == 'yes') ? ' checked' : ''; ?>> <label for="plugin-active-yes">On</label>
                                <input type="radio" name="gtp_plugin_active" value="no" id="plugin-active-no"<?php echo ( $gtp_plugin_active == 'no') ? ' checked' : ''; ?>> <label for="plugin-active-no">Off</label>
                            </p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e( 'Active on', 'gtp' ); ?></th>
                        <td>
                            <p>
                                <select class="gtp-select" name="gtp_post_list" id="gtp-post-list">
                                    <optgroup label="Sitewide">
                                        <option value="show"<?php echo $gtp_post_list == 'show' ? ' selected="selected"' : ''; ?>><?php _e( 'Sitewide', 'gtp' ); ?></option>
                                    </optgroup>
                                    <optgroup label="Specific post type">
                                        <option value="show_sel"<?php echo $gtp_post_list == 'show_sel' ? ' selected="selected"' : ''; ?>><?php _e( 'Post type in list', 'gtp' ); ?></option>
                                        <option value="hide_sel"<?php echo $gtp_post_list == 'hide_sel' ? ' selected="selected"' : ''; ?>><?php _e( 'Post type not in list', 'gtp' ); ?></option>
                                    </optgroup>
                                </select>
                            </p>
                            <p class="note hidden gtp-post-list-note" id="gtp-post-list-show-note">Plugin is active on all available post types.</p>
                            <p class="note hidden gtp-post-list-note" id="gtp-post-list-show_sel-note">Plugin is active on following post types:</p>
                            <p class="note hidden gtp-post-list-note" id="gtp-post-list-hide_sel-note">Plugin is <strong>NOT</strong> active on following post types:</p>
                            <p class="hidden gtp-post-list-posttypes-cont">
                                <select class="gtp-select" multiple="multiple" name="gtp_post_list_posttypes[]" id="gtp-post-list-posttypes">
                                    <?php 
                                        foreach( $this->post_types as $post_type ):
                                            $obj = get_post_type_object( $post_type ); ?>
                                        <option value="<?php echo $post_type; ?>"<?php echo in_array( $post_type, $gtp_post_list_posttypes ) ? ' selected="selected"' : ''; ?>><?php echo $obj->labels->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </p>                            
                            <p class="note">There are some default exclusions where we find this plugin to be useless. Check the list of excluded post types <a href="https://wordpress.org/plugins/geo-targeted-posts/faq/">here</a>.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e( 'Front end posts', 'gtp' ); ?></th>
                        <td>
                            <p>
                                <input type="radio" name="gtp_frontpage_posts" id="gtp-posts-none" value="none" <?php echo $gtp_frontpage_posts == 'none' ? 'checked' : ''; ?>> 
                                <label for="gtp-posts-none"><?php _e( 'Posts filtered for all users', 'gtp' ); ?></label>
                            </p>
                            <p>
                                <input type="radio" name="gtp_frontpage_posts" id="gtp-posts-admins" value="admins" <?php echo $gtp_frontpage_posts == 'admins' ? 'checked' : ''; ?>> 
                                <label for="gtp-posts-admins"><?php _e( 'All posts displayed on front end for logged in admins only', 'gtp' ); ?></label>
                            </p>
                            <p>
                                <input type="radio" name="gtp_frontpage_posts" id="gtp-posts-users" value="users" <?php echo $gtp_frontpage_posts == 'users' ? 'checked' : ''; ?>> 
                                <label for="gtp-posts-users"><?php _e( 'All posts displayed on front end for all logged in users', 'gtp' ); ?></label>
                            </p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"><?php _e( 'Simulate location', 'gtp' ); ?></th>
                        <td>
                            <p>
                                <select class="gtp-select" name="gtp_simulate_location" id="gtp-countries-simulation">
                                    <option value="no-simulation"<?php echo $gtp_simulate_location == 'no-simulation' ? ' selected="selected"' : ''; ?>><?php _e( 'My Current Location (no simulation)', 'gtp' ); ?></option>
                                <?php 
                                    $countries = $this->countryList;
                                    unset( $countries['a1'], $countries['a2'], $countries['o1'] );
                                    foreach ( $countries as $key => $country ):
                                ?>
                                    <option value="<?php echo $key; ?>"<?php echo $gtp_simulate_location == $key ? ' selected="selected"' : ''; ?>><?php echo $country; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </p>
                            <p><span class="note"><?php _e( 'Location simutalion works when <strong>Front end posts</strong> is set to <em>Posts filtered for all users</em> and currenct user is admin.', 'gtp' ); ?></span></p>
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
    <?php
    }

    public function gtp_post() {
        if ( ! $this->gtp_is_post_type_active() ) {
            return;
        }

        $gtp_countries = explode( ',', strtolower( get_post_meta( get_the_ID(), 'gtp_countries', true ) ) );
        $gtp_meta_countries = '';        
        $all = '<span id="gtp-country-all">' . __( 'All', 'gtp' ) . '</span>';

        if ( $gtp_countries && is_array( $gtp_countries ) ) {
            $gtp_countries = array_map( 'trim', $gtp_countries );
            foreach ( $gtp_countries as $gtp_country ) {
                if ( in_array($gtp_country, $this->countryCodesList ) ) {
                    $gtp_meta_countries .= '<span id="gtp-country-' . $gtp_country . '">' . $this->countryList[ $gtp_country ] . '</span>';
                }
            }
        }
        
        $gtp_meta_spans = ! empty( $gtp_meta_countries ) ? $gtp_meta_countries : $all; 
    ?>
        <div id="gtp-country" class="misc-pub-section">
            <?php _e( 'Post displayed in countries', 'gtp' ); ?>: <a class="edit-visibility hide-if-no-js" id="gtp-edit" href="#gtp-edit" style="display: inline;"><?php _e( 'Edit', 'gtp' ); ?></a>
            <div class="gtp-space"></div>
            <span id="gtp-country-display">
                <?php echo $gtp_meta_spans; ?>
            </span>
            <div class="hide-if-js" id="gtp-country-select" style="display: none;">
                <select class="gtp-select" multiple="multiple" name="gtp_countries[]" style="width: 100%;" id="gtp-countries">
                    <?php foreach ( $this->countryList as $key => $country ): ?>
                    <option value="<?php echo $key; ?>" <?php echo is_array( $gtp_countries ) && in_array( $key, $gtp_countries ) ? 'selected="selected"' : ''; ?>><?php echo $country; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="gtp-space"></div>
                <a id="save-countries-list" class="hide-if-no-js button button-primary" href="#"><?php _e( 'Done', 'gtp' ); ?></a>
                <a id="clear-countries-list" class="hide-if-no-js button" href="#"><?php _e( 'Clear list', 'gtp' ); ?></a>
            </div>
        </div>
    <?php
    }

    public function gtp_save_countries( $post_id, $post ) {
        if ( empty( $_POST ) ) {
            return $post_id;
        }

        if ( isset( $_POST['_inline_edit'] ) && ! wp_verify_nonce( $_POST['_inline_edit'], 'inlineeditnonce' ) ) {
            return $post_id;
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }

        if ( isset( $post->post_type ) && 'revision' == $post->post_type ) {
            return $post_id;
        }
     
        if ( ! current_user_can( 'edit_posts', $post_id ) || ! current_user_can( 'edit_pages', $post_id ) ) {
            return $post_id;
        }

        if ( ! $this->gtp_is_post_type_active( $post->post_type ) ) {
            return $post_id;
        }

        if ( isset( $_POST['gtp_countries'] ) && ! empty( $_POST['gtp_countries'] ) ) {
            ksort( $_POST['gtp_countries'] );
            update_post_meta( $post_id, 'gtp_countries', strtolower( implode( ',', $_POST['gtp_countries'] ) ) );
        } else {
            delete_post_meta( $post_id, 'gtp_countries' );
        }
    }

    /**
     * Filters functions
     */
    public function gtp_filter_posts( $pieces, $query ) {
        global $wpdb;

        if ( is_admin() ) {
            return $pieces;
        }

        if ( get_option( 'gtp_plugin_active' ) == 'no' ) {
            return $pieces;
        }

        $post_type = preg_match('/post_type = \'(.*?)\'/', $pieces['where'], $matches);
        $post_type = $matches[1];

        if ( ! $this->gtp_is_post_type_active( $post_type ) ) {
            return $pieces;
        }

        $gtp_frontpage_posts = esc_attr( get_option( 'gtp_frontpage_posts' ) );
        $gtp_simulate_location = esc_attr( get_option( 'gtp_simulate_location' ) );

        if ( $gtp_frontpage_posts == 'admins' ) {
            $condition = current_user_can( 'manage_options' );
        } else if ( $gtp_frontpage_posts == 'users' ) {
            $condition = is_user_logged_in();
        } else {
            $condition = false;
        }

        if ( ! $condition ) {
            if ( $gtp_simulate_location != 'no-simulation' && current_user_can( 'manage_options' ) ) {
                $country = $gtp_simulate_location;
            } else {
                if ( ! class_exists( 'GeoIP' ) ) {
                    include( 'geoip.inc' );
                }

                $gi = geoip_open( plugin_dir_path( __FILE__ ) . 'GeoIP.dat', GEOIP_STANDARD );
                $country = strtolower( geoip_country_code_by_addr( $gi, $_SERVER['REMOTE_ADDR'] ) );
                geoip_close( $gi );
            }

            if ( ! empty( $country ) && $country !== '--' ) {
                $pieces['join'] .= " LEFT JOIN  $wpdb->postmeta as hidden_meta ON ( $wpdb->posts.ID = hidden_meta.post_id AND hidden_meta.meta_key = 'gtp_countries' )";
                $pieces['where'] .= " AND ( hidden_meta.post_id IS NULL OR CAST(hidden_meta.meta_value AS CHAR) LIKE '%$country%' )";
            }
        }        

        return $pieces;
    }

    public function gtp_custom_column_head( $columns ) {
        $columns['gtp_countries'] = __( 'Countries', 'gtp' );

        return $columns;
    }

    public function gtp_custom_columns( $column, $post_id ) {
        switch ( $column ) {
            case 'gtp_countries' :
                $countries = get_post_meta( $post_id , 'gtp_countries' , true );
                if ( $countries ) {
                    echo '<div id="gtp_countries-' . $post_id . '">' . strtoupper( $countries ) . '</div>'; 
                } else {
                    _e( 'All', 'gtp' );
                }

                break;
        }
    }

    public function gtp_sortable_column( $columns ) {
        $columns['gtp_countries'] = 'gtp_countries';

        return $columns;
    }

    public function gtp_column_orderby( $query ) {
        if ( ! is_admin() ) {
            return;
        }
     
        $orderby = $query->get( 'orderby' );
     
        if( 'gtp_countries' == $orderby ) {
            $meta_query = array(
                'relation' => 'OR',
                array(
                    'key'       => 'gtp_countries',
                    'value'     => 'value',
                    'compare'   => 'NOT EXISTS'
                )
            );
            $query->set( 'meta_query', $meta_query );
            $query->set( 'meta_key', 'gtp_countries' );        
            $query->set( 'orderby', 'meta_value' );
        }
    }

    public function gtp_quick_edit_custom_box( $column_name, $post_type ) {
        if ( ! $this->gtp_is_post_type_active( $post_type ) ) {
            return;
        }

        switch( $column_name ) {
            case 'gtp_countries':
            ?>
                <fieldset class="inline-edit-col-left">
                    <div class="inline-edit-col">
                        <span class="title inline-edit-countries-label"><?php _e( 'Countries', 'gtp' ); ?></span>
                        <ul class="cat-checklist">
                            <?php foreach ( $this->countryList as $key => $country ): ?>
                            <li id="gtp-country-<?php echo $key; ?>"><label class="selectit"><input value="<?php echo $key; ?>" type="checkbox" name="gtp_countries[]"> <?php echo $country; ?></label></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
               </fieldset><?php
               break;
        }
    }

    public function gtp_save_bulk_edit() {
        $post_ids = ( isset( $_POST['post_ids'] ) && !empty( $_POST['post_ids'] ) ) ? $_POST['post_ids'] : array();
        $gtp_countries = ( isset( $_POST['gtp_countries'] ) && !empty( $_POST['gtp_countries'] ) ) ? $_POST['gtp_countries'] : NULL;
   
        if ( !empty( $post_ids ) && is_array( $post_ids ) && !empty( $gtp_countries ) ) {
            foreach( $post_ids as $post_id ) {
                update_post_meta( $post_id, 'gtp_countries', strtolower( implode( ',', $gtp_countries ) ) );
            }
        }

        die();
    }
}

$geotargeted_posts = new GeoTargeted_Posts();
?>