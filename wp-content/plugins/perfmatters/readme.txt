=== Perfmatters ===
Contributors:
Donate link: https://perfmatters.io
Tags: perfmatters
Requires at least: 5.5
Requires PHP: 7.0
Tested up to: 6.3.2
Stable tag: 2.1.8
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Perfmatters is a lightweight performance plugin developed to speed up your WordPress site.

== Description ==

[Perfmatters](https://perfmatters.io/) is a lightweight web performance plugin designed to help increase Google Core Web Vitals scores and fine-tune how assets load on your site.

= Features =

* Easy quick toggle options to turn off resources that shouldn't be loading. 
* Disable scripts and plugins on a per post/page or sitewide basis with the Script Manager. 
* Defer and delay JavaScript, including third-party scripts.
* Automatically remove unused CSS.
* Preload resources, critical images, and prefetch links for quicker load times.
* Lazy load images and enable click-to-play thumbnails on videos.
* Host Google Analytics and Google Fonts locally.
* Change your WordPress login URL. 
* Disable and limit WordPress revisions.
* Add code to your header, body, and footer.
* Optimize your database.

= Documentation =

Check out our [documentation](https://perfmatters.io/docs/) for more information on how to use Perfmatters.

== Changelog ==

= 2.1.8 - 10.13.2023 = 
* Fixed a compatibility issue with local fonts and WordPress 6.3.2 that was causing an error when new font files were requested.

= 2.1.7 - 09.29.2023 =
* Added Delay JS quick exclusion for WP Forms.
* Script Manager style updates to match some recent changes to the main settings UI.
* Script Manager security updates to form submission handling.
* Added logic to strip whitespace from input row text fields used for preloads, preconnects, and fetch priority options.
* Adjusted CDN Regex slightly to account for certain subdirectory formats.
* Added specification to lazyload exclusion to only skip the fetchpriority attribute when set to high.
* Added Cornerstone request parameter to excluded page builders array.
* Updated certain AJAX action names to be specific to Perfmatters to prevent conflicts.
* Updated missing image dimension function to better handle images that have been prepped by lazy loaders outside of Perfmatters.
* Added Novashare discount link to plugin settings UI for Perfmatters customers.
* Fixed an issue where the database optimization process would not run correctly if selected toggles were not saved first.
* Fixed an issue in MU Mode where core cookie constants were not set in a specific instance when checking for the current post ID.
* Translation updates.

= 2.1.6 - 08.31.2023 =
* Fixed an issue that was preventing CodeMirror input fields from saving correctly.

= 2.1.5 - 08.30.2023 =
* Reworked the majority of the UI to use WordPress AJAX to save data and perform plugin actions.
* Renamed Bricks Delay JS quick exclusion, as it can be used to target more than just their slider.
* Adjusted clean_html utility function regex to better handle large inline data scripts.
* Added skip-lazy class to built-in lazy loading exclusions.
* Added right-to-left admin styles for better usability on RTL sites.
* Fixed an issue where certain HTML characters would not print correctly when saved in a fetch priority selector input field.
* Fixed an issue where fetch priority selectors would sometimes not get the correct priority applied when set to low.
* Fixed a typo in the fetch priority tooltip.
* Updated background processing library to version 1.1.1.
* Translation updates.

= 2.1.4 - 08.08.2023 =
* Added new preload option to add the Fetch Priority attribute to different resources on the site to help improve LCP.
* Added built-in lazy loading exclusion for fetchpriority attribute.
* Added Delay JS quick exclusion for Termageddon + Usercentrics.
* Switched individual JS delay to use the same inline script as delay all to take advantage of delayed triggering of event listeners.
* Fixed an issue where an empty notice was appearing when a database optimization process completed.
* Fixed an issue with critical image preloads where an image with an empty src attribute would prevent other similar ones from being added on the same URL.
* UI improvements to input row sections.

= 2.1.3 - 07.02.2023 =
* Fixed an issue that was preventing existing Script Manager settings from showing up in certain instances.
* Translation updates.

= 2.1.2 - 06.29.2023 =
* Added new lazy loading advanced option to Exclude Images by Parent Selector.
* Added built-in exclusion to Delay JS for jqueryParams inline script to prevent load order issues.
* Added additional built-in exclusions to Remove Unused CSS for better compatibility with Elementor.
* Added HTTPS check to PERFMATTERS_CACHE_URL definition.
* Updated Script Manager UI to sort plugins alphabetically by plugin name as well as assets inside each individual section alphabetically by script handle.
* Fixed an issue where plugins without any enqueued scripts would not always show up in the Script Manager (MU Mode) after visiting the global view. 
* Updated background processing library to version 1.1.0.
* Translation updates.

= 2.1.1 - 05.31.2023 =
* Added WP-CLI support for managing plugin license key activation.
* Changed behavior of Disable Cart Fragments toggle to only load cart fragmentation script when there are items in the cart.
* Added default array for critical image preload exclusions that are always needed.
* Added additional Delay JS quick exclusions for Bricks Slider and WP Armour.
* Added additional built-in exclusions for Remove Unused CSS for better compatibility with Elementor and Google Reviews Widget.
* Updated lazy loading fade-in effect to use CSS animation property instead of transition for better compatibility with existing element transitions.
* Added requirement for advanced options to be turned on to be able to defer jQuery.
* Added WP-CLI request exclusion to MU plugin functions.
* Fixed a PHP warning that could sometimes be generated if an image was not able to be parsed for missing dimensions.
* Updated instant.page library to version 5.2.0.
* Translation updates.

= 2.1.0 - 05.01.2023 =
* Added new delay JS option for Quick Exclusions that will show up when certain popular plugins and themes are activated.
* Made some updates to the Script Manager UI to match recent changes to the main plugin settings.
* Cleared out some code for the previous settings admin header that was no longer needed.
* Made an adjustment to CDN URL function to work even if a trailing slash was entered.
* Rearranged our local and Google font options to give frequently used options more priority.
* Fixed a bug where multiple settings sections were displaying at the same time after saving from the database tab.
* Fixed an issue where accessibility mode tooltips were not getting styled properly in the plugin UI.
* Fixed a styling issue where link and button colors were getting applied outside of the main Perfmatters admin container.
* Fixed an issue in MU Mode where the global filtered plugin list would not always return correctly.
* Translation updates.

= 2.0.9 - 03.30.2023 =
* Updated Request library functions used to download local font files to fix a compatibility issue with WordPress 6.2.
* Added new perfmatters_preloads_ready filter.
* Fixed a styling issue in Safari where the settings UI logo was getting clipped.

= 2.0.8 - 03.29.2023 =
* Updated plugin settings UI. Completely overhauled admin header and navigation. Made additional improvements to various elements (icons, buttons, toggles, etc.).
* Added additional checks to allow PERFMATTERS_CACHE_DIR and PERFMATTERS_CACHE_URL to be manually set in wp-config.php.
* Updated user agent for local font remote request.
* Fixed an issue where multiple preload tags for the same resource could be printed if the resource was matched more than once in the DOM.
* Fixed an issue where an individually delayed script would fail to load if it matched more than one delayed script entry.
* Fixed an issue where FastClick script could still load even if Delay JS was turned off.
* Translation updates.

= 2.0.7 - 03.10.2023 =
* Fixed an issue that was introduced in the last update that was causing certain images that had their HTML modified by another tool not to lazy load correctly.
* Translation updates.

= 2.0.6 - 03.02.2023 =
* Added new Minimal v4 script type option in local analytics.
* Added support for ::after pseudo element when lazy loading CSS background images.
* Added support for AVIF images in a source tag to preload critical images feature.
* Added new perfmatters_preload_critical_images filter.
* Added new perfmatters_image_dimensions_exclusions filter.
* Added notice to plugin update row if there is not an active license key.
* Added async attribute to Instant Page script tag.
* Added async attribute to all relevant local analytics script tags.
* Reworked preload class to allow managing preloads entirely with perfmatters_preloads filter if needed.
* Fixed an issue in MU Mode where plugins would not always disable correctly when helper plugins with similar directories were also active.
* Fixed a couple of PHP warnings in MU plugin that would show up when certain variables were not declared.
* Fixed an issue where our lazy loading script was attempting to load in images that had been prepped by another active lazy loader.
* Fixed an issue where base64 encoded images were being picked up by missing image dimensions feature.
* Removed BETA tag from preload critical images option.

= 2.0.5 - 02.02.2023 =
* Added new perfmatters_exclude_leading_images filter.
* Fixed an issue that was affecting lazy loaded inline background images in certain formats.
* Fixed a PHP warning related to Fastclick and the built-in exclusion for WooCommerce pages.
* Updated license key field to prevent it from getting auto-filled by browser extensions.

= 2.0.4 - 01.27.2023 =
* Fixed an issue that was causing the Perfmatters admin bar menu and meta options to not show up in the admin.
* Added additional nopin attribute for Pinterest to YouTube preview thumbnails.
* Translation updates.

= 2.0.3 - 01.26.2023 =
* Added new local Google fonts advanced option to Load Asynchronously.
* Added user agent check before running output buffer with initial exclusion for Usercentrics scanner.
* Added support for CSS variables when they are being used for lazy loaded inline background images.
* Added new perfmatters_lazyload_youtube_autoplay filter.
* Improved delay all script handling of jQuery load event.
* Changed all WooCommerce checks to use class_exists for better compatibility.
* Adjusted the order of preloads in the buffer to make sure they print above used CSS.
* Moved buffer class initialization to wp action hook to improve filtering possibilities.
* Moved WooCommerce built-in exclusions to apply to select individual features instead of the entire buffer.
* Slight modification to previous MU Mode addition to fix an issue.
* Fixed an issue where custom heartbeat interval was not being applied correctly when editing certain custom post types.
* Fixed an issue with the local stylesheet CDN URL when advanced options were turned on but no URL was set.
* Fixed an issue where delay script was printing out more than once if multiple closing body tags were present in the DOM.

= 2.0.2 - 12.15.2022 =
* Fixed an issue that was preventing Removed Unused CSS from running correctly in certain cases when Advanced Options were toggled on.
* Translation updates.

= 2.0.1 - 12.14.2022 =
* Added new toggle to Show Advanced Options in the Perfmatters UI.
* Added new advanced option to Disable Click Delay in JavaScript section.
* Added new advanced option to Enable FastClick in JavaScript section.
* Added new advanced option to specify a CDN URL in CSS section.
* Added new Local Redirect option to existing login URL disabled behavior selection.
* Added new perfmatters_buffer_excluded_extensions filter.
* Added new perfmatters_rucss_excluded_stylesheets filter.
* Added additional built-in exclusions for Remove Unused CSS for better compatibility with Elementor, Divi, Slider Revolution, OptimizePress, and WordPress core.
* Added additional logic in MU Mode to more reliably retrieve the ID for certain custom post types.
* Moved lazyload functions to new class structure to be more inline with current codebase.
* Modified regex for lazy loading inline background images to support additional formats.
* Integrated lazyload functions into the main output buffer to allow interaction with other existing features.
* Fixed an issue where dynamic preloads were not recognizing existing query strings in some cases.
* Fixed a PHP warning that would show up in some cases by adding additional string check when looping through rewrite array.
* Fixed an issue with MU Mode where sometimes the wrong plugin would get disabled if there were multiple plugins using similar directory paths.
* Fixed an issue where images inside script tags were being picked up by the Preload Critical Images function.
* Translation updates.

= 2.0.0 - 10.18.2022 =
* Added new system for query string timestamps for Used CSS file method to help see changes quicker in environments with caching.
* Added support for ?perfmattersoff query string which gives the ability to quickly prevent the majority of Perfmatters features from running on the front end for testing purposes.
* Added additional support for updating the plugin via WP-CLI.
* Made some changes to admin bar menu item. There is now a Perfmatters top-level admin bar menu item that links to our plugin settings page. The Script Manager and Clear Used CSS function can be accessed by hovering over that main menu item if those features are enabled.
* Added new toggle in tools to Hide Admin Bar Menu.
* Disabled certain features from running on WooCommerce cart, checkout, and account pages for better compatibility.
* Increased site limit in dropdowns on Multisite network settings page.
* Added additional compatibility styles to the Script Manager.
* Added additional built-in exclusions for Remove Unused CSS for better compatibility with Elementor, Astra, Kadence, and GenerateBlocks.
* Added new perfmatters_login_url filter.
* Added new perfmatters_lazyload_noscript filter.
* Fixed an issue where YouTube preview thumbnails were generating a preload warning in certain instances.
* Fixed an issue that was causing analytics.js not to be served over HTTPS in instances where an SSL migration had been done previously on the site.
* Fixed an issue where delayed style attribute was applied to preloaded stylesheets that already existed in the DOM.
* Fixed an issue where some features were being allowed to run on XML sitemap URLs in certain cases.
* Fixed an issue where theme and plugin files were not falling back to a WordPress version query string when present in a dynamic preload.

= 1.9.9 - 09.05.2022 =
* Added additional autosave interval options.
* Added WPBakery query string parameter to excluded page builders array.
* Changed certain lazy loading classes to be more specific to prevent conflicts.
* Adjusted lazy loading image attribute filter to not run unless images specifically are meant to be lazy loaded by Perfmatters.
* Added an additional function_exists check in the JS class to prevent an error from being thrown in some cases.

= 1.9.8 - 08.31.2022 =
* Made adjustments to the CSS Background Image styles to work with some changes in the latest version of our lazy loading library.
* Fixed an issue that was preventing quotations from being stripped from background image URLs when prepping an inline background image for lazy loading.
* Fixed an issue where delayed CSS was not loading properly when using individual JS delay.
* Fixed an error that was being logged in some cases when checking for an active plugin in the JS class.

= 1.9.7 - 08.30.2022 =
* Made an adjustment to how inline background images are prepped to work with some changes in the latest version of our lazy loading library.

= 1.9.6 - 08.30.2022 =
* Added new perfmatters_delay_js_delay_click filter.
* Added new perfmatters_local_stylesheet_url filter.
* Made some performance improvements to the way the lazy loading script and inline code are loaded.
* Added additional compatibility for Elementor animations when using Delay JS.
* Added additional details in the Script Manager global view for individual stored settings.
* Added the ability to identify and clear outdated post IDs set in the Script Manager options from the global view.
* Script Manager global view organization and style improvements.
* Updated lazy loading library to version 17.8.
* Updated instant.page library to version 5.1.1.
* Added Bricks query string parameter to excluded page builders array.
* Fixed an issue that was causing the cache directory to not create unique subsite paths for specific multisite setups.
* Fixed an issue where delayed stylesheets were not being loaded if Delay JS was toggled off in the post meta options.

= 1.9.5 - 07.17.2022 =
* Added additional logic to Delay JS script to make sure the initial interaction is processed.
* Added additional styles to CSS Background Image feature to work with background images set on ::before selectors.
* Added additional logic on custom login URL admin_url filter to fix certain scenarios where login URL was not being replaced correctly.
* Added additional default tags to various dropdowns in plugin settings for better clarification.
* Added default arrays for stylesheet and selector exclusions that are always needed.
* Adjusted perfmatters_cdn filter location for compatibility.
* Made some adjustments to CDN Rewrite Regex to fix some issues where unwanted strings were getting picked up as URLs in some cases.
* Translation updates.

= 1.9.4 - 06.21.2022 =
* Updated EDD plugin updater class to version 1.9.2.
* Added default exclusion to REST API option for compatibility.

= 1.9.3 - 06.17.2022 =
* Remove Used CSS filter adjustment to fix an issue where certain WordPress post functions wouldn't be available when trying to selectively disable the feature.
* Rolled back minor plugin UI JavaScript addition, as it was interfering with entering data on multiple lines in certain input fields.

= 1.9.2 - 06.16.2022 =
* Added new perfmatters_used_css filter.
* Added new perfmatters_allow_buffer filter.
* Added a notice in the Script Manager when Testing Mode is enabled.
* Improved reliability of CSS Background Image function when child elements with additional background images are present.
* Script Manager style compatibility fixes.
* Fixed an issue where some post specific meta options were not being respected when determining if a feature should run.
* Fixed an issue where pressing enter on the main plugin settings page would trigger a specific form action instead of save settings.
* Changed CSS class initialization hook to be in the correct order with other output buffer functions.
* Made an adjustment to how we generate the local used stylesheet URL for better compatibility.
* Fixed an issue where loading attribute was still getting applied to images that were excluded from lazy loading.
* Fixed an issue where images inside an excluded picture element were not also getting excluded.
* Fixed an issue in the Script Manager where archives were not being grouped together with their respective post type.
* Additions to plugin UI JavaScript to allow for disabled sections to be hidden even when nested controllers are present.
* Moved background process library to composer autoloader.
* Removed BETA tag from Remove Unused CSS option.

= 1.9.1 - 05.23.2022 =
* Added new option to lazy load CSS Background Images.
* Added new option for Dual Tracking when using gtag.js in local analytics.
* Added new perfmatters_rest_api_exceptions filter.
* Fixed an issue where individually delayed local scripts would not get correctly rewritten to load from the CDN.
* Fixed an issue where lazy loading would run into an error if no px or % was specified with the threshold value.
* Fixed an issue with buffer validation that was conflicting with certain caching setups.
* Fixed an issue where existing font preconnect and prefetch tags were not being detected properly when using Local Fonts.
* Fixed an error related to cookie constants when running MU Mode in certain environments.
* Fixed multiple AMP validation errors and added additional checks to prevent certain functions from running on AMP URLs.
* Minor adjustment to CDN rewrite regex pattern to work with encoded quotation characters.
* Changed toggle CSS selectors to be more specific to prevent conflicts.
* Moved plugin settings header output to in_admin_header action hook for compatibility.
* Moved JS optimization functions to new class structure to be more inline with current codebase.
* Improvements to critical image preloading allowed for a move to a singular output buffer.

= 1.9.0 - 04.15.2022 =
* Fixed an issue that was causing excluded selectors to not be recognized properly after Used CSS was cleared.
* Minor adjustments to the new plugin UI.

= 1.8.9 - 04.13.2022 =
* Updated plugin settings UI.
* Added new post meta option to Clear Used CSS for an individual page or post type.
* Added new perfmatters_rucss_excluded_selectors filter.
* Fixed a lazy loading issue that was preventing some images from loading properly in Safari.
* Migrated Delay JS Timeout dropdown to a simpler on/off toggle that will default to 10 seconds. Our filter is also still available to set a custom timeout value.
* Fixed an issue with MU plugin that was interfering with rewrite rules in some instances.
* Added additional excluded page builder parameter for Flatsome UX.
* Moved restore default functionality to a separate option on the tools page.
* Code refactoring.
* Translation updates.

= 1.8.8 - 03.23.2022 =
* Changed default setting for Used CSS Method from file to inline, as we think this will be the more compatible solution for most users going forward. If you were previously using the file method, you may need to save that option again.
* Added width and height parameters to placeholder SVGs to prevent warnings for a ratio mismatch that would happen for some images.
* Fixed an issue where the noscript tags were getting malformed for some images inside picture tags after lazy loading.
* Removed placeholder SVGs on source tags since the image tag will already have one.
* Changed settings export file name date format to be easier to organize when managing multiples.
* Updated tooltip for Blank Favicon option to be more clear.


= 1.8.7 - 03.14.2022 =
* Added new Used CSS Method option to choose whether to load used CSS from a file or inline.
* Added new perfmatters_cache_path filter.
* Updated metabox functions to restrict metabox display to administrators only.
* Made some adjustments to custom login URL function to better support 3rd party tools using WP CLI.
* Added Fusion Builder query string parameters to excluded page builders array.
* Adjusted Unused CSS regex to be more consistent when stylesheets are placed in between other link tags.
* Changes to instances where ABSPATH was used to determine a directory location for better compatibility with certain hosts.
* Fixed an issue with Remove Global Styles option where duotone SVGs were not being removed on WordPress 5.9.2.
* Fixed an issue where WooCommerce block stylesheets were not getting correctly dequeued when Disable Scripts option was set.
* Fixed an issue that was causing the CSS Parser library not to get included correctly in certain cases.
* Translation updates.

= 1.8.6 - 02.10.2022 =
* Added new option to Remove Global Styles related to duotone filters.
* Added new perfmatters_script_manager_locale filter.
* Added new perfmatters_disable_woocommerce_scripts filter.
* Added new perfmatters_page_builders filter.
* Added new perfmatters_delay_js_behavior filter.
* Fixed an issue with the unused CSS parser that was incorrectly rewriting relative URLs if there was no query string present on the original stylesheet src.
* Added additional parameter to page builders array for compatibility.
* Fixed an issue that was causing the login URL disabled 404 behavior to result in an error if a 404 template was not found.
* Added some additional checks before creating cache directories for local fonts and used CSS.
* Fixed an issue that was causing the fade-in effect to conflict with child images inside a lazy loaded container.
* Fixed an undefined index warning coming from unused CSS settings update function.
* Added a default delay JS exclusion for admin only inline customize-support script.
* Refactored entire meta.php code to be more efficient (38% smaller) and in line with current structure.
* Translation updates.

= 1.8.5 - 01.19.2022 =
* Added new feature to Remove Unused CSS (BETA).
* Added new perfmatters_remove_unused_css filter.
* Adjusted CDN Rewrite buffer priority for better compatibility with other features.
* Made an improvement to the Disable XML-RPC function to return a 403 error when xmlrpc.php is accessed directly.
* Script Manager stylesheet updates for better compatibility.
* Fixed an issue in the Script Manager where the input controls were sometimes not displaying after toggling a script off.
* Added additional style for YouTube preview thumbnail play button to fix an alignment issue with certain setups.
* Buffer adjustments for compatibility.

= 1.8.4 - 12.19.2021 =
* Fixed an issue that was interfering with sitemap display in certain configurations.
* Added <a> element support for lazy loading inline background images.

= 1.8.3 - 12.13.2021 =
* Added new perfmatters_fade_in_speed filter.
* Fixed an issue that was preventing lazy loading fade in from working correctly with certain background images.
* Fixed an issue that was interfering with the display of certain inline SVG elements.
* Adjusted local analytics hook priority for better compatibility.
* Script Manager style updates for better compatibility.
* Translation updates.

= 1.8.2 - 12.08.2021 =
* New Lazy Loading option to Exclude Leading Images.
* New Lazy Loading option to add a Fade In effect.
* New option to Preload Critical Images (BETA).
* Expanded Disable XML-RPC function to also remove pingback link tag if it is present in the document.
* Added new Delay JavaScript checkbox to meta options in the post editor.
* Added additional integration with perfmatters_delay_js filter.
* Moved YouTube autoplay parameter placement on lazy loaded iframes for better compatibility with existing query strings.
* Optimizations to lazy loading inline CSS functions.
* Various optimizations and improvements to the output buffer.
* Migrated manual preload functionality to use the output buffer which will allow for easier integration with new features.
* Made some adjustments to MU plugin functions to more reliably detect post IDs when using specific permalink setups.
* Fixed an issue where some Current URL links in the Script Manager's Global View were not pointing to the right posts.
* Fixed an issue with a certain endpoint that was redirecting to the custom login URL.
* Fixed a PHP notice that was sometimes appearing when refreshing local fonts.
* Removed BETA tag from Delay All JS option.

= 1.8.1 - 10.26.2021 =
* Updated Local Google Font function to more effectively remove existing font preconnect and prefetch tags.
* Updated Local Google Font function for better compatibility with sites that still have remnants from a previous http to https migration.
* Fixed an issue in the Script Manager where the home page was being treated as a post if set to display the blog feed.

= 1.8.0 - 10.22.2021 =
* Fixed an issue with Delay All JS that was preventing certain async scripts from fully loading.

= 1.7.9 - 10.19.2021 =
* Added new options to the Script Manager to disable assets directly by post type, archive, user status, and device type.
* Added support for dynamic preloading by handle for enqueued scripts and styles.
* Added new perfmatters_lazyload filter.
* Added new perfmatters_cdn filter.
* Added new perfmatters_delay_js_timeout filter.
* Fix to Delay All JS script for better compatibility with certain page builder animations.
* Updated class initialization for better compatibility.
* Fixed an issue where the Script Manager was interpreting certain array keys as shortcodes if they were identical.
* Added an additional check to prevent the Script Manager from being able to load on top of a page builder.
* Fixed a PHP notice coming from the MU plugin.
* Made some changes to our plugin updater function that should help with auto-updates in a multisite environment.
* Translation updates.

= 1.7.8 - 09.16.2021 =
* Added new option to Add Missing Image Dimensions.
* Added the ability to delete individual Script Manager options from the Global View.
* Added new perfmatters_delay_js filter.
* Updated EDD plugin updater class to version 1.9.0.
* Translation updates.

= 1.7.7 - 08.25.2021 =
* Fixed a PHP warning related to JavaScript deferral for specific configurations.
* Fixed an issue with lazy loading exclusions not being loaded correctly in some cases.

= 1.7.6 - 08.24.2021 =
* Added new Delay Behavior dropdown with a new option to Delay All Scripts.
* Added new Lazy Loading Threshold option and adjusted the default value if not set to improve performance.
* Added confirmation message when manually running the database optimization tool.
* Updated disable emoji function to get rid of a PHP notice.
* Added additional check to MU Mode to only filter GET requests.
* Added new perfmatters_defer_js filter.
* Fixed an issue where Instant Page was attempting to run on the new widgets screen in WordPress 5.8.
* Fixed an issue with Local Google Fonts where certain invalid font URLs would still attempt to be downloaded and served.
* Removed BETA tag from fonts section.
* Delay JavaScript compatibility improvements.
* Added additional input validation functionality to plugin settings page.
* Translation updates.

= 1.7.5 - 07.13.2021 =
* Added new custom login URL options to change the Disabled Behavior and set a custom Message.
* Migrated CDN, Analytics, and Extras tab data to separate sections in the Options tab for better organization and easier access.
* CDN rewrite improvements to better handle sites with multiple domain URLs.
* Regex adjustments to Local Fonts function for better reliability.
* Added exclusion checks to individual <source> tags when using WebP images.
* Added function to disable capital_P_dangit filter.
* Fixed a lazy loading warning that was showing in Microsoft Edge.
* Removed loading attribute that was getting applied to <picture> tags in some cases when using WebP images.
* Plugin UI navigation performance improvements.
* Plugin UI style fixes.
* Added a conditional check to only show WooCommerce options when WooCommerce is installed and activated.
* Fixed an MU Mode issue where the Home URL did not trigger a match if a query string was present.
* Fixed an issue where the Customizer was getting certain optimizations applied.
* Fixed an issue where the Disable Embeds toggle was interfering with responsive video styles.
* Script Manager UI fixes.
* Updated uninstall function to remove Perfmatters cache folder.
* Added readme.txt file.

= 1.7.4 – 06.08.2021 =
* Re-enabled Local Google Fonts functionality.
* Refactoring of buffer-related code and various functions that were already using our main buffer filter.
* Translation updates.

= 1.7.3 – 06.03.2021 =
* Rolled back the latest changes related to the new universal buffer class and Local Google Fonts while we do some more in-depth testing. We’ll be working to release this feature next week using an alternative method.

= 1.7.2 – 06.02.2021 =
* Added new Fonts section inside of the main Options tab.
* Added new option to use Display Swap for Google fonts.
* Added new Local Google Fonts option which will attempt to download any Google Font files and serve them from your local server or CDN.
* Integrated new universal HTML buffer library to help going forward with plugin features that manipulate DOM elements.
* Migrated CDN Rewrite feature to the universal buffer class.
* Added new perfmatters_delayed_scripts filter to modify the Delay JavaScript input array before any scripts are delayed.
* Added new perfmatters_preload filter to modify the Preloads data array before anything is printed.
* Made some compatibility improvements to the inline lazy loading JavaScript.
* Added attributes to delayed scripts to exclude them from being picked up by Litespeed Cache.
* Added exclusion for SiteGround Optimizer to the main Script Manager JavaScript file.
* Added CodeMirror support to all code text area inputs in plugin settings.
* Removed license activation check and corresponding links from the plugins page to improve back-end performance. 

= 1.7.1 – 05.06.2021 =
* Added expiration date row to license tab in plugin settings.
* Added support for WooCommerce shop page when setting a preload location by post ID.
* Fixed an issue with device exceptions not working correctly in MU Mode.
* Fixed a query string encoding issue that was affecting some email templates when using a custom login URL.

= 1.7.0 – 04.26.2021 =
* Fixed an issue where Preload tags were still being printed on archive pages even if a location was set.
* Fixed a compatibility issue with older WordPress versions when using certain functions that check for a JSON request.
* Translation updates.

= 1.6.9 – 04.22.2021 =
* New additions to preload feature, allowing specification for device type and location.
* Script Manager improvements to allow for Regex disable to be used alongside Current URL disables for the same script.
* Added new Script Manager exception for device type.
* Add new Delay Timeout option when delaying JavaScript.
* Added new wheel event to user interaction script for delay function.
* Added new multisite network administration tool to apply default site settings to all subsites.
* Multiple improvements to WooCommerce disable scripts toggle for increased effectiveness.
* Added additional exclusions for JSON and REST requests to all asset optimization functions.
* Fixed an undefined index warning coming from local analytics function.
* Fixed an issue where YouTube preview thumbnails were getting a layout shift warning when using a theme with responsive embed support.
* Fixed a Script Manager bug that was not fully clearing exceptions when changing disable away from everywhere.
* Script Manager styling compatibility fixes.
* Translation updates.

= 1.6.8 – 03.10.2021 =
* Compatibility fixes for local analytics when using MonsterInsights.
* Local analytics improvements for multisite.
* Added alt tag to YouTube preview thumbnail images.
* Fixed a PHP undefined index notice coming from functions.php.
* Translation file updates.

= 1.6.7 – 03.02.2021 =
* Added new tool to Purge Perfmatters Meta Options.
* Added new Exclude Post IDs input for existing Disable Google Maps option.
* Added new gtag.js option to local analytics script type selection.
* Added new CDN URL input to local analytics options when using gtag.js.
* Added new option to Enable AMP Support to local analytics.
* Moved Use MonsterInsights option to gtag.js script type and updated script replacement hook. Important: If you were previously using analytics.js with MonsterInsights, please move to the gtag.js option.
* Added onload function to style preloads to prevent duplicate preloads from occurring.
* Added exception for WP Rocket script deferral to our lazy load script.
* Added exception for site health tool to disable heartbeat function.
* Fixed an issue where background images weren’t being lazy loaded if the style attribute was the first attribute declared on the element.
* Script Manager styling fixes.
* Fixed a PHP warning coming from settings.php.
* Translation file updates.

= 1.6.6 – 01.13.2021 =
* Added new Script Manager exception to select logged in or logged out users.
* Added new option in Script Manager settings to Display Dependencies.
* Added total plugin sizes in the Script Manager.
* Added new perfmatters_lazyload_threshold filter to adjust the distance at which lazy elements are loaded.
* Multiple Script Manager style and UI improvements.
* Fixed an issue where MU mode script was attempting to run on wp-login.php.
* Multiple page builder compatibility fixes.
* Made an adjustment to prevent YouTube preview thumbnails from getting picked up by Pinterest image hover tools.
* Removed deprecated plugin option to Remove Query Strings. Make sure to double-check your preloads as Google needs the exact URL when preloading.
* PHP 8 compatibility testing.
* Minor adjustments to lazy load inline scripts to fix invalid markup warnings.

= 1.6.5 – 12.04.2020 =
* Added new option to Delay JavaScript from loading until user interaction.
* Added new gtag.js v4 option to local analytics.
* Added new built-in option to Exclude from Lazy Loading which can be used in addition to the existing filter.
* Add new perfmatters_lazyload_youtube_thumbnail_resolution filter to adjust YouTube preview thumbnail quality.
* Optimized analytics updater function.
* Updated EDD plugin updater class which will now allow for WordPress auto-update support.
* Removed option to Defer Inline JavaScript which is now being replaced by the new Delay JavaScript option.
* Adjusted Script Manager hook priority for better compatibility.
* Compatibility fix to the DOM Monitoring lazy load option.
* Added compatibility fix for jQuery fitVids to lazy loading function.
* Fixed an issue where lazy loading was attempting to run on AMP pages.

= 1.6.4 – 10.29.2020 =
* Fixed an issue that was causing the Reset Script Manager button to not work correctly.
* Fixed an issue where the Perfmatters meta box wouldn’t display if only using Lazy Loading.
* Adjusted Script Manager hook priority for better compatibility.
* Added additional checks to MU Mode plugin file to prevent it from interfering with certain REST API requests. (Fixes a bug when running the Yoast SEO data indexer.)
* Added additional checks to confirm user functions are available before verifying admin status.
* Updated translation files.

= 1.6.3 – 10.22.2020 =
* Added new Testing Mode option to the Script Manager settings.
* Rewrote script-manager.js entirely using vanilla JavaScript to get rid of the jQuery dependency on the back-end.
* Added additional MU Mode check to help prevent certain configurations from interfering with AJAX requests.
* Improved Script Manager form handling.
* Adjusted Script Manager disclaimer text and added a close button.
* Moved the Script Manager print function from the wp_footer hook to shutdown for better compatibility.
* Fixed an undefined index warning in the Lazy Load function.
* Added a Lazy Load exclusion for Gravity Forms iframes.
* Added a Rocket Loader exclusion to the Instant Page JS file.
* Added an exclusion to the CDN Rewrite for script-manager.js.
* Script Manager styling fixes for better compatibility.

= 1.6.2 – 09.24.2020 =
* Updated placeholder text in Preload UI.
* Fixed an issue where the Password Strength Meter script was getting disabled in the admin.
* Small tweak to JS Deferral buffer to make sure HTML is being filtered correctly.
* Translation updates.

= 1.6.1 – 09.23.2020 =
* New Local Analytics Script Type toggle with new Minimal Analytics options.
* New JavaScript Deferral options in Extras → Assets.
* New meta option to exclude JavaScript deferral, Instant Page, and Lazy Load per individual post/page.
* Updates to Cart Fragments and Password Strength Meter toggles to improve effectiveness.
* Multiple updates to Instant Page functionality for better compatibility.
* Multiple plugin admin UI updates and improvements.
* Script Manager style updates for better compatibility.
* MU Mode improvements for increased stability.
* Fixed an issue causing Preload and Preconnect settings to not save correctly in some cases.

= 1.6.0 – 08.17.2020 =
* Added a filter to disable WordPress’ native lazy loading when Perfmatters’ lazy loading is active.
* Adjusted Script Manager styles to more effectively overlay the entire page while still allowing admin bar functions to be fully available.
* Fixed an undefined index notice that was appearing on specific lazy loading and script manager functions.
* Updated translation files.

= 1.5.9 – 08.12.2020 =
* Added new Preloading section in the Extras tab, with new options for Instant Page and Preload.
* Added new perfmatters_lazyload_forced_attributes filter to allow for matched elements to be skipped when checking for exclusions.
* Added support for WooCommerce Shop page to show up as a Current URL option in the Script Manager.
* Added exclusions for REST and AJAX requests to MU Mode function.
* Fixed a bug that was causing the MU Mode function to still run even if the Script Manager was disabled.
* Fixed an issue where images were being prepped for lazy loading on feed URLs.
* Fixed an issue where lazy loading was breaking images in embeds from the same site.
* Compatibility fixes for lazy load script with Autoptimize and Litespeed Cache.

= 1.5.8 – 07.20.2020 =
* Added support for lazy loading background images, iframes, and videos.
* Added new lazy loading option to enable YouTube Preview Thumbnails.
* Removed native lazy loading in preparation for WordPress 5.5.
* Added multiple page builder exclusions to our lazy load functions.
* Added proper support for 404 templates in the Script Manager (non-MU).
* Fixed some minor styling issues in the Script Manager UI.
* Fixed an undefined index in the database optimizer class.
* Removed customer email row from the license tab.

= 1.5.7 – 06.22.2020 =
* Added new Database Optimization section in the Extras tab.
* Added new DOM Monitoring option to complement our existing lazy load settings.
* Added additional input styles in the Script Manager for better compatibility
* Made some changes to the Script Manager file include process for better compatibility.
* Fixed multiple undefined index notices.
* Updated translation files.

= 1.5.6 – 06.02.2020 =
* Plugin UI improvements, new tooltip styles.
* Licensing workflow improvements. Simpler UI, license no longer deactivated on plugin deactivation, license auto-activates on input.
* Moved Script Manager javascript back to a separate plugin file for better compatibility.
* Added Remove Query Strings exemption to the Script Manager javascript file.
* Code refactoring.

= 1.5.5 – 05.27.2020 =
* Added a new modified function to the MU plugin file which should be able to get the current post ID more effectively for certain types of URLs (custom post types, blog page, etc…).
* Made some improvements to the MU plugin file detection and update process.

= 1.5.4 – 05.26.2020 =
* Added additional tooltip warning text to the MU Mode toggle.
* Added mu_mode=off URL parameter to force the page to load with MU Mode settings disabled.
* Added an additional check to make sure MU Mode settings don’t run if the base Perfmatters plugin is not activated.

= 1.5.3 – 05.25.2020 =
* Added new MU Mode (BETA) feature in the Script Manager which can be used to disable plugins per page.
* Reworked main Script Manager update function to dynamically save settings via AJAX to prevent having to reload the page every time options are saved.
* Moved Script Manager javascript inline to better support further updates.
* Fixed an issue in the Script Manager where a Current URL disable would not function correctly for an individual script if the plugin’s scripts were disabled globally on a different Current URL.
* Changed hooks for Disable Google Maps and Disable Google Fonts toggles to prevent a conflict with the Block Editor (Gutenberg).
* Added an exclusion attribute to our LazyLoad script to prevent it from conflicting with WP Rocket’s JS deferral feature.
* Updated EDD Plugin Updater Class to version 1.7.1.
* Updated various translation files.

= 1.5.2 – 04.22.2020 =
* Added new options in Extras → Tools to Import and Export Plugin Settings.
* Updated Script Manager form input names to be more specific to prevent conflicts when saving Script Manager settings.
* Added compatibility fix for Beaver Builder to the Script Manager dequeue function.
* Updated French and German translation files.

= 1.5.1 – 04.02.2020 =
* Adjusted the Script Manager styles for better compatibility with other admin bar tools when the Script Manager UI is being displayed.
* Fixed an issue in the Script Manager that was causing individual script settings to not work correctly when the parent group had previously been disabled.
* Updated Russian (ru_RU) translation files.
* Updated plugin description.

= 1.5.0 – 03.20.2020 =
* Fixed a bug that was causing the Script Manager dequeue function to interfere with the query loop in certain cases.

= 1.4.9 – 03.18.2020 =
* Performance update to Script Manager form submission function which should help dramatically reduce the footprint when saving script configurations.
* Removed the Current URL option in the Script Manager when loaded on URLs without a valid post ID. (ex. dynamically generated archive templates)
* Added plugin settings page header with links to Contact and Support.
* Minor styling fixes in plugin settings UI.
* Updated Russian (ru_RU) translation files.

= 1.4.8 – 03.03.2020 =
* Added new ‘Body Code‘ box in the Extras tab to go along with our existing header + footer boxes to give some more control there.
* Added some limits to the Script Manager action links in WP Admin to ensure they are only showing up for public post types.
* Fixed a bug that was causing the admin stylesheet not to load on the network settings page when running on a multisite.
* Added Russian (ru_RU) translation files. (credit: Sergey Shljahov)

= 1.4.7 – 02.04.2020 =
* Added an exception for Gravity Forms to the Disable Heartbeat function.
* Added an exception for Contact Form 7 to the Disable REST API function.
* Added updated German (de_DE) translation files. (credit: Daniel Luttermann)

= 1.4.6 – 01.21.2020 =
* Added a specific and more generous threshold for lazy loading. This ensures butter-smooth loading of images while visitors scroll down the page. While raw performance is the objective, perceived performance (how quick a user thinks the site is) is also important.
* Added some additional dequeues to the Disable WooCommerce function to target inline CSS and JS.

= 1.4.5 – 12.08.2019 =
* Updated Disable Google Maps and Disable Google Fonts toggles to not run in WP Admin.
* Turned off native lazy loading by default and added new option to Use Native.
* Added perfmatters_lazyload_excluded_attributes filter which allows for an array of attribute strings to be given that if found will exclude the matched image/s from lazy loading.
* Made some compatibility improvements to the Script Manager function that gets the ID of the current post.
* Added perfmatters_get_current_ID filter which allows the user to extend or modify the functionality of the Script Manager’s current ID function.

= 1.4.4 – 10.20.2019 =
* Fixed undefined index PHP Notice coming from the Preconnect settings display function.
* Added additional compatibility with Elementor when using the Script Manager to disable certain Elementor scripts + styles.
* Added a ignore flag class to all Lazy Load functions. Simply add the ‘no-lazy’ class to any image element you want to be exempt from lazy loading.
* Added validation filter to Login URL input to prevent incompatible characters from being entered.

= 1.4.3 – 10.02.2019 =
* Fixed an issue with the Lazy Load function that was causing an error with some older PHP versions.

= 1.4.2 – 09.30.2019 =
* Added new option for Lazy Loading images (BETA).

= 1.4.1 – 08.18.2019 =
* New addition to the Preconnect option, you can now choose to whether or not to add the crossorigin property for each Preconnect URL.
* Optimization to the loading of Perfmatters admin scripts + styles.
* Added additional Script Manager styles for better compatibility.
* Added an additional function for the Custom Login URL to help rewrite certain wp-admin links in specific multisite setups.
* Reorganized plugin action links in the plugins table.

= 1.4.0 – 07.16.2019 =
* Fixed an issue where the Current URL Exceptions were not loading correctly after saving in the Script Manager.

= 1.3.9 – 07.14.2019 =
* Added new Extra options to Add Header Code and Add Footer Code.
* Added missing blank defaults for DNS Prefetch and Preconnect options.
* Added functionality to force the Admin Bar to display when the Script Manager is loaded.
* Script Manager styling adjustments.
* Added success message on save when the Script Manager options are updated.
* Added support for 404 pages when trying to disable or enable on the Current URL.

= 1.3.8 – 06.17.2019 =
* Added new option to Disable Comments.
* Updated a section of the Script Manager to better reflect the Current URL when determining if it is a match for the given regex pattern.

= 1.3.7 – 05.29.2019 =
* Added links to the Script Manager from the posts list page and post edit page which will take you to the front end and load the Script Manager for the corresponding post.
* Added warning notices for both WP_POST_REVISIONS and AUTOSAVE_INTERVAL if they are set in Perfmatters while also defined elsewhere.