/**
 * Single Latest Posts TinyMCE Plugin
 * Version: 1.2.5
 * Author: L'Elite
 * Author URI: http://laelite.info/
 * License: GNU General Public License 2.0 (GPL) http://www.gnu.org/licenses/gpl.html
 */
/* 
 * Copyright 2007 - 2013 L'Elite de José SAYAGO (opensource@laelite.info)
 * 'SLPosts Lite', 'SLPosts Pro', 'NLPosts' are unregistered trademarks of L'Elite, 
 * and cannot be re-used in conjuction with the GPL v2 usage of this software 
 * under the license terms of the GPL v2 without permission.
 *
 * Single Latest Posts brings all the awesomeness available
 * in Network Latest Posts to individual WordPress installations.
 *
 */
(function() {
    // Set the plugin
    tinymce.create('tinymce.plugins.slposts', {
        init : function(ed, url) {
            // Add this button to the TinyMCE editor
            ed.addButton('slposts', {
                // Button title
                title : 'Single Latest Posts Shortcode',
                // Button image
                image : url+'/slposts_button.png',
                onclick : function() {
                    // Window size
                    var width = jQuery(window).width(), height = jQuery(window).height(), W = ( 720 < width ) ? 720 : width, H = ( height > 600 ) ? 600 : height;
                    W = W - 80;
                    H = H - 84;
                    tb_show( 'Single Latest Posts Shortcode Settings', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=slposts-form' );
                    // Load form
                    jQuery(function(){
                        // Dynamic load
                        jQuery('#TB_ajaxContent').load(url+'/slposts_shortcode_form.php');
                    });
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    // Run this stuff
    tinymce.PluginManager.add('slposts', tinymce.plugins.slposts);
})();