# EDD Add-to-Cart URLs
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds the appropriate add-to-cart URL for your downloads so they can be easily copied and pasted whenever you need them.

## Description

This plugin adds add-to-cart URLs for your Downloads using Easy Digital Downloads. The URLs can be copied directly from a Download's admin screen.

You'll find this plugin useful if you ever find yourself needing to send a potential customer a purchase link for a specific Download (or price option).

## Installation

1. Download the zip file and upload `edd-add-to-cart-urls` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

## Usage

After activating the plugin, you can navigate to the edit screen for any of your Downloads.

For Downloads with only one price, the add-to-cart URL is found at the bottom of the _Download Prices_ meta box.

For variably priced Downloads, the add-to-cart URL is found under the "advanced" price settings (_Download Prices_ meta box). You can display it by clicking "Show advanced settings" toggle for the corresponding price option.

By default, the redirect URI is the Checkout page (set under the EDD settings). This means that customers will be redirected to the checkout page when using the link provided by this plugin. To change the redirect URI, you can use the following filter:

```php
/**
 * Filter the redirect URI for the add-to-cart URL
 *
 * @param (string) $uri - The URI
 * @param (int) $download_id - Download ID
 *
 * @return (string) $uri
 */
function rv_filter_edd_a2curl_redirect_uri( $uri, $download_id ) {
	// Generate some other URI
	return $uri;
}
add_filter( 'edd_a2curl_redirect_uri', 'rv_filter_edd_a2curl_redirect_uri', 10, 2 );
```

## Bugs

If you find an issue, let me know!

## Changelog

__1.0.0__
* Initial commit