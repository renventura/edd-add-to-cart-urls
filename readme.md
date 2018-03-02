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

![Single Price Downloads - Add-to-Cart URL](https://lh3.googleusercontent.com/O7L8-pgovMxgtPn_FKZbo0JbXD76tItjKqCtZ6UXxg0it82VCNjggWqrR1FloXeMXjenoIfbYDdb5Gh-M1mswLKj142aG1DraEfQYcatTjFCgDOi-qacix8qpunZTOV9hCbvACEsFB5E7TZm6a6E6vNYrspGCHlKCnSL7eC_Cnux8rFBKaFrAw1Xfk1Fxjie1G7wzlTdm2QGaT50PPk9gW3m85AFPVzUjlRYIKYPTZcIepHRCOIEzcMfEP38LO-t19IG6F-ODlz_myibevhZLoQAfwM1R0VinDQWQ2mPv5dvuQH7zAvyRFSvBVbENp0GyfdeLqGr_ISNpdSOcYhdbJJfaNExJ3bC8tdrrei-VNXuq95SjuqG92_8_2_j8Z5zmrhOx_u5lZGg-atnGv5MnLFs2I1FNUIQBONw0Ag5NnoNNPwPkx1KpsWhgthil7ZU8iQ164VhDq-5qpO7tx8pOP19ovYrDW5QfOY1AyDkZcq8OreXphBfaAfeAa5Kocqd3YCnCYNXa9iAFhK61TCiB96Mb5Sewra1PaeNlDmkFxoGCpzcTsQkbfCa5PS5BKp49tKzPKxSi-M0_vV0D5nO5Ht7RS4oqSrLx-QPiQM=w1644-h610-no)

For variably priced Downloads, the add-to-cart URL is found under the "advanced" price settings (_Download Prices_ meta box). You can display it by clicking "Show advanced settings" toggle for the corresponding price option.

![Variable Price Downloads - Show Advanced Settings](https://lh3.googleusercontent.com/GBD4Ydiw7FXi2Mm3o5TIcqW-NEnsGUojtzrUjB9378fchaSZTUgJBXxESJU4soGrW_jlMPWIWC5rFuzAdgFjuoDxOuPON-EY2LQVH3xwG7_M88oUEn0xxPr-ee8RGixu8jjzVIC2d0BPoKF35v47nanAmy6tkVCfknziIBX-y_Lkg_sP8t3MhuhxCWVOgCARbPeOeAT8bjntIGOZ-l0i4akJE8qTVZN68BpVoUya_O_HvAfTjUB5-Va6tVUS_in-QcDNjOxwub9tR75DNE0bmV83WpehB-i6r61M4g353X0SGj-6EXIKSoeTcOAUJaXDFNkwFtVTrE0AHUmiavqM0otTAwYsVbRdm3c_y7Oy5cYLGxf-78QZyhMjOA0M7dqYgxg1afxVJi1uWyKzKXl7B-YGhBHkdeIsTrLOav-Eu5rIMbLA3xXjbxcl834yrIlDCG8RTQikocw-WuvwRAT6bECZ3PD43a7r28Vw-epJ3RnKDVBagynbL17Q1dWqK4zZ4F_kl0398Jr-o32DAYByHkEOzupIv_EiVcxqfJoCIgN5DtcEp3CEVuejX-hWIDEsudVjYYPR8uEHRXYYyqs88zam957DkWA3JpmU_n4=w1646-h1126-no)

![Variable Price Downloads - Add-to-Cart URL](https://lh3.googleusercontent.com/w96SZAZ9CiIYCuDJJoqB9MRpMWXpidxPPLOHs0wgo5SQtZNjwAHpbufQ7Zz7fZ7io-8BtrRvJ9ath5w9J0j6WKtHOPxikfN3ztgYx5aXtPOdbiqo4aU2a9Q_YRDNmjWeyXv07hRQOzQkjyuIhfKN6fLlbrdfPTuXCm9Gks4HXUrXkzM_TuiVkwI-EW9CJZoI2WVoFMCS8e7EirYo2j2GD7C9nXWOfBTTcTT05_YWiUMAFx8qdzklYVCPsC8KR5g56FMIRx4kdEKsjJjK5JBx-i6k9s3GOrL1ZbB24fN5UCLs_Yh45mZBDTIuWRzEYj_GSnO_2-qoSseBKOgXaLDXSEetyfg94u_B87cvzwx32njUz_26bAlrQGxH77qG5YfpuJp_iZLwRjDB6I_2G_hhuIYz80n25XG0zVqaIX2tb1g_kzfQ7DQ39BIP7Di_dsH1NOC_Fm752R7XabcybXhZUUGVkPsZ2BLCqAGQLmvouQe3uF-vhITPb7S7J_aOXH2SLx7P7MTXbqTPO9_sXU281gF40upI8Kz66k3A-dELKqu6GJ2bOrk6H9TOxU4WHimpAzybj6sLUpu6WcBIVnJVdAY1nZHkJ-DKuMaHYZ0=w1548-h792-no)

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