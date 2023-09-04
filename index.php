<!DOCTYPE html>
<html>
<head>
    <title>DoC to JPEG Converter</title>
</head>
<body>
    <h1>DOC to JPEG Converter</h1>
    <form action="convert.php" method="post" enctype="multipart/form-data">
  <label for="documents">Choose files to convert (PDF, DOC, DOCX, JPG, PNG):</label><br>
  <input type="file" name="documents[]" id="documents" multiple accept=".pdf, .doc, .docx, .jpg, .jpeg, .png"><br>
  <input type="submit" value="Convert">
</form>

</body>
</html>
