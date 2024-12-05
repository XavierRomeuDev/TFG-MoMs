@props(['name', 'id', 'value' => ''])

<div>
    <textarea id="{{ $id }}" name="{{ $name }}">{{ $value }}</textarea>
</div>

<script src="https://cdn.tiny.cloud/1/t9r9anclcfpr69phglipgcund7r4ec4ewcp99ng4ucfdptnq/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
</script>
<script>
    tinymce.init({
        selector: 'textarea#{{ $id }}',
        height: 400,
        menubar: false,
        paste_as_text: true,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount',
            'code'
        ],
        toolbar: 'undo redo | formatselect | ' +
            ' bold italic forecolor backcolor | alignleft aligncenter ' +
            ' alignright alignjustify | bullist numlist outdent indent |' +
            ' removeformat | help',
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tiny.cloud/css/codepen.min.css'
        ]
    });
</script>
