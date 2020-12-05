<html lang="ru">
    <head>
        <title>Test</title>
    </head>
    <body>
        <form action="{{ route('test') }}" method="post" enctype="multipart/form-data"> Select image to upload:
            @csrf
            <input type="file" name="files[]" id="fileToUpload" multiple>
            <input type="submit" value="Upload Image" name="submit">
        </form>
    </body>
</html>
