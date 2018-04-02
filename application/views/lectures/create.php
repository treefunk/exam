Create lecture for 
fsdfs
 <form>
    <textarea name="editor" id="editor" rows="10" cols="80">
        This is my textarea to be replaced with CKEditor.
    </textarea>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'editor', {
	        customConfig: '<?=base_url()?>ckeditor/config.js'
        } );
    </script>
</form>


