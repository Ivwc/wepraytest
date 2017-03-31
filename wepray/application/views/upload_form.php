<html>
<head>
<title>Upload Form</title>
</head>
<body>


<?php echo form_open_multipart('picupload_temples/upload');?>

<input type="file" name="file" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>