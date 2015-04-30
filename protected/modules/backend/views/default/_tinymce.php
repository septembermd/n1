<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript">
            tinyMCE.init({
                mode : "specific_textareas",
                editor_selector : "mceEditor",
                theme:"advanced",
                theme_advanced_buttons1:"bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,undo,redo,link,unlink,image,|,fullscreen, media,code",
                theme_advanced_buttons2:"",
                theme_advanced_buttons3:"",
                theme_advanced_toolbar_location:"top",
                theme_advanced_toolbar_align:"left",
                theme_advanced_statusbar_location:"bottom",
                plugins:'imagemanager,inlinepopups,fullscreen,media',
                width:'100%',
                height:'300px',
                extended_valid_elements : "iframe[src|title|width|height|allowfullscreen|frameborder]"
            });
        </script>