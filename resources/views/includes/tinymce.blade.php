<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
        tinymce.init({
            selector: "#edittext_id",
            file_browser_callback : elFinderBrowser,
            content_css : "{{ asset('css/tinymce_custom.css') }}",
            theme_advanced_font_sizes: "10px,12px,13px,14px,16px,18px,20px",
            font_size_style_values : "10px,12px,13px,14px,16px,18px,20px",
            autoresize_min_height: 350,
            theme: "modern",
            relative_urls: false,
            plugins: [
                "autoresize image table link insertdatetime preview media print hr"
            ],
         	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | image | media"
         	});
          function elFinderBrowser (field_name, url, type, win) {
          var elfinder_url = "{{ route('elfinder.tinymce4') }}";    // use an absolute path!
          tinyMCE.activeEditor.windowManager.open({
            file: elfinder_url,
            title: 'File Browser',
            width: 900,
            height: 450,
            resizable: 'yes',
            inline: 'yes',    // This parameter only has an effect if you use the inlinepopups plugin!
            popup_css: false, // Disable TinyMCE's default popup CSS
            close_previous: 'no'
          }, {
            window: win,
            input: field_name
          });
          return false;
        }
</script>
<script type="text/javascript">
        tinymce.init({
            selector: "#edittext_en",
            file_browser_callback : elFinderBrowser,
            content_css : "{{ asset('css/tinymce_custom.css') }}",
            theme_advanced_font_sizes: "10px,12px,13px,14px,16px,18px,20px",
            font_size_style_values : "10px,12px,13px,14px,16px,18px,20px",
            autoresize_min_height: 350,
            theme: "modern",
            relative_urls: false,
            plugins: [
                "autoresize image table link insertdatetime preview media print hr"
            ],
         	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | image | media"
         	});
          function elFinderBrowser (field_name, url, type, win) {
          var elfinder_url = "{{ route('elfinder.tinymce4') }}";    // use an absolute path!
          tinyMCE.activeEditor.windowManager.open({
            file: elfinder_url,
            title: 'File Browser',
            width: 900,
            height: 450,
            resizable: 'yes',
            inline: 'yes',    // This parameter only has an effect if you use the inlinepopups plugin!
            popup_css: false, // Disable TinyMCE's default popup CSS
            close_previous: 'no'
          }, {
            window: win,
            input: field_name
          });
          return false;
        }
</script>
