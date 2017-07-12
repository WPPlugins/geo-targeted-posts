=== Geo Targeted Posts ===
Contributors: karolisg, Mindaugas
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=MWSSDWX6DMP9C
Tags: geo post, geo tag, user location, location, country, countries
Requires at least: 3.5.1
Tested up to: 4.7.1
Stable tag: 0.8.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display posts based on visitor's Geo Location


== Description ==

This plugin adds an option to choose which countries are allowed to see the post.  
Based on Geo Location user will or will not see the post in list pages.  
If restricted post is accessed directly then a 404 error page is returned.

Features:

* Ability to choose multiple countries from dropdown list manualy for each post
* Ability to write/paste in the list of country codes (eg. de,gb,fi,lt)
* Post, page, custom post types support
* CSV import plugins support
* Translation ready, WPML support
* Simulate admin location
* Controll whether to display all posts to logged in users, to admins only or filter posts for logged in users as per default
* Clear the list of set countries for post with one click
* Supports quick and bulk edit boxes in post list

The Plugin uses Maxmind's GeoIP API.

Currently supported countries are:
Andorra, United Arab Emirates, Afghanistan, Antigua and Barbuda, Anguilla, Albania, Armenia, Angola, Asia/Pacific Region, Antarctica, Argentina, American Samoa, Austria, Australia, Aruba, Aland Islands, Azerbaijan, Bosnia and Herzegovina, Barbados, Bangladesh, Belgium, Burkina Faso, Bulgaria, Bahrain, Burundi, Benin, Saint Bartelemey, Bermuda, Brunei Darussalam, Bolivia, Bonaire, Saint Eustatius and Saba, Brazil, Bahamas, Bhutan, Bouvet Island, Botswana, Belarus, Belize, Canada, Cocos (Keeling) Islands, Central African Republic, Congo, Switzerland, Cote d'Ivoire, Cook Islands, Chile, Cameroon, China, Colombia, Costa Rica, Cuba, Cape Verde, Curacao, Christmas Island, Cyprus, Czech Republic, Germany, Djibouti, Denmark, Dominica, Dominican Republic, Algeria, Ecuador, Estonia, Egypt, Western Sahara, Eritrea, Spain, Ethiopia, Europe, Finland, Fiji, Falkland Islands (Malvinas), Micronesia, Federated States of, Faroe Islands, France, Gabon, United Kingdom, Grenada, Georgia, French Guiana, Guernsey, Ghana, Gibraltar, Greenland, Gambia, Guinea, Guadeloupe, Equatorial Guinea, Greece, South Georgia and the South Sandwich Islands, Guatemala, Guam, Guinea-Bissau, Guyana, Hong Kong, Heard Island and McDonald Islands, Honduras, Croatia, Haiti, Hungary, Indonesia, Ireland, Israel, Isle of Man, India, British Indian Ocean Territory, Iraq, Iran, Islamic Republic of, Iceland, Italy, Jersey, Jamaica, Jordan, Japan, Kenya, Kyrgyzstan, Cambodia, Kiribati, Comoros, Saint Kitts and Nevis, Korea, Democratic People's Republic of, Korea, Republic of, Kuwait, Cayman Islands, Kazakhstan, Lao People's Democratic Republic, Lebanon, Saint Lucia, Liechtenstein, Sri Lanka, Liberia, Lesotho, Lithuania, Luxembourg, Latvia, Libyan Arab Jamahiriya, Morocco, Monaco, Moldova, Montenegro, Saint Martin, Madagascar, Marshall Islands, Macedonia, Mali, Myanmar, Mongolia, Macao, Northern Mariana Islands, Martinique, Mauritania, Montserrat, Malta, Mauritius, Maldives, Malawi, Mexico, Malaysia, Mozambique, Namibia, New Caledonia, Niger, Norfolk Island, Nigeria, Nicaragua, Netherlands, Norway, Nepal, Nauru, Niue, New Zealand, Oman, Panama, Peru, French Polynesia, Papua New Guinea, Philippines, Pakistan, Poland, Saint Pierre and Miquelon, Pitcairn, Puerto Rico, Palestinian Territory, Portugal, Palau, Paraguay, Qatar, Reunion, Romania, Serbia, Russian Federation, Rwanda, Saudi Arabia, Solomon Islands, Seychelles, Sudan, Sweden, Singapore, Saint Helena, Slovenia, Svalbard and Jan Mayen, Slovakia, Sierra Leone, San Marino, Senegal, Somalia, Suriname, South Sudan, Sao Tome and Principe, El Salvador, Sint Maarten, Syrian Arab Republic, Swaziland, Turks and Caicos Islands, Chad, French Southern Territories, Togo, Thailand, Tajikistan, Tokelau, Timor-Leste, Turkmenistan, Tunisia, Tonga, Turkey, Trinidad and Tobago, Tuvalu, Taiwan, Tanzania, Ukraine, Uganda, United States Minor Outlying Islands, United States, Uruguay, Uzbekistan, Holy See (Vatican City State), Saint Vincent and the Grenadines, Venezuela, Virgin Islands, British, Virgin Islands, U.S., Vietnam, Vanuatu, Wallis and Futuna, Samoa, Yemen, Mayotte, South Africa, Zambia, Zimbabwe


== Installation ==

1. Upload `geo-targeted-posts` directory to the `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Post and in Publish section you will see New item where you can specified in wich countries post can be visible


== Frequently Asked Questions ==

= Where can I find the option to choose countries? =

An option to choose countries is rendered above Publish button of each post in admin section.

= Which post types are excluded by default? =

By default we decided to exclude the following post types: attachment, revision, nav_menu_item, product_variation, shop_order, shop_order_refund, shop_coupon, shop_webhook

= How can I edit the excluded post types list? =

You can edit the excluded post types list by applying a **gtp_exclude_post_types** filter. For example for some reason you want to remove **shop_coupon** from excluded list you should include the following in your theme's functions.php file:

`
<?php
add_filter('gtp_exclude_post_types', 'alter_excluded_posts_types');
function alter_excluded_posts_types( $post_type_list ) {
	$new_post_type_list = array_diff( $post_type_list, array( 'shop_coupon' ) );
	return $new_post_type_list;
}
?>`

== Changelog ==

= 0.8 =
* [ADDED] Quick and bulk edit support in post list
* [ADDED] Custom Countries column in post list
* [ADDED] Option to choose post types where plugin is active
* [ADDED] Simple plugin on/off button
* [REMOVED] Annoying donate button from post edit screen

= 0.7 =
* New admin panel in Settings -> Geo Targeteed Posts
* Ability to simulate admin location - no more proxies to see how your site looks in different countries!
* Controll whether to display all posts to logged in users, to admins only or filter posts for logged in users as per default
* Button to clear all set countries for post

= 0.6.2 =
* Bug fix

= 0.6 =
* Added support for CSV import plugins
* Translation ready

= 0.5 =
* New plugin author;
* Rewritten core of the plugin for performance;
* OOP is now used;
* Added ability to paste in the countries by it's code.

= 0.4 =
* Updated activation plugin source

= 0.3 =
* Updated code for performance

= 0.2 =
* Fixed bug with pages

= 0.1 =
* Updated Country list