<script>
        tinymce.init({
            selector: '.editor',
            plugins: [
                'advlist', 'autolink', 'importcss', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor',
                'pagebreak',
                'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen',
                'insertdatetime', 'codesample',
                'media', 'table', 'help'
            ],
            toolbar: "formatgroup paragraphgroup insertgroup moregroup",
            toolbar_groups: {
                formatgroup: {
                    icon: 'format',
                    tooltip: 'Formatting',
                    items: 'bold italic underline strikethrough | forecolor backcolor | superscript subscript | removeformat'
                },
                paragraphgroup: {
                    icon: 'paragraph',
                    tooltip: 'Paragraph format',
                    items: 'h1 h2 h3 | bullist numlist | alignleft aligncenter alignright | indent outdent'
                },
                insertgroup: {
                    icon: 'plus',
                    tooltip: 'Insert',
                    items: 'link image emoticons charmap hr'
                },
                moregroup: {
                    icon: "more-drawer",
                    tooltip: "more",
                    items: "codesample preview help "
                }
            },
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save();
                });
                editor.on('change', function(e) {
                    @this.set('.editor', editor.getContent());
                });
            },
            menubar: false,
            statusbar: false,
            max_height: 200,
            codesample_global_prismjs: true,
            branding: false,
            image_advtab: true,
            importcss_append: true,
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_class: 'mceNonEditable',
            contextmenu: 'link image table',
            toolbar_location: 'bottom',
        });
</script>
