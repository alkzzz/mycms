<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
        tinymce.init({
            selector: "#edittext_id",
            file_picker_callback : elFinderBrowser,
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
          function elFinderBrowser (callback, value, meta) {
  tinymce.activeEditor.windowManager.open({
    file: "{{ route('elfinder.tinymce4') }}",// use an absolute path!
    title: 'Upload Media',
    width: 900,
    height: 450,
    resizable: 'yes'
  }, {
    oninsert: function (file, elf) {
      var url, reg, info;

      // URL normalization
      url = file.url;
      reg = /\/[^/]+?\/\.\.\//;
      while(url.match(reg)) {
        url = url.replace(reg, '/');
      }

      // Make file info
      info = file.name + ' (' + elf.formatSize(file.size) + ')';

      // Provide file and text for the link dialog
      if (meta.filetype == 'file') {
        callback(url, {text: info, title: info});
      }

      // Provide image and alt text for the image dialog
      if (meta.filetype == 'image') {
        callback(url, {alt: info});
      }

      // Provide alternative source and posted for the media dialog
      if (meta.filetype == 'media') {
        callback(url);
      }
    }
  });
  return false;
}
</script>
<script type="text/javascript">
        tinymce.init({
            selector: "#edittext_en",
            file_picker_callback : elFinderBrowser,
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
          function elFinderBrowser (callback, value, meta) {
  tinymce.activeEditor.windowManager.open({
    file: "{{ route('elfinder.tinymce4') }}",// use an absolute path!
    title: 'Upload Media',
    width: 900,
    height: 450,
    resizable: 'yes'
  }, {
    oninsert: function (file, elf) {
      var url, reg, info;

      // URL normalization
      url = file.url;
      reg = /\/[^/]+?\/\.\.\//;
      while(url.match(reg)) {
        url = url.replace(reg, '/');
      }

      // Make file info
      info = file.name + ' (' + elf.formatSize(file.size) + ')';

      // Provide file and text for the link dialog
      if (meta.filetype == 'file') {
        callback(url, {text: info, title: info});
      }

      // Provide image and alt text for the image dialog
      if (meta.filetype == 'image') {
        callback(url, {alt: info});
      }

      // Provide alternative source and posted for the media dialog
      if (meta.filetype == 'media') {
        callback(url);
      }
    }
  });
  return false;
}
</script>
