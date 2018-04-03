<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form method="post" action="http://localhost/arafat/elp/admin/test_mail" enctype='multipart/form-data'> <!--  -->
		{{csrf_field()}}
	<input type="text" name="from_setting" value="ezlawpro@dnmsecurexxxcvt140093.com" placeholder="from">		
	<input type="text" name="to[]" placeholder="to">		
	<input type="text" name="subject" placeholder="subject">		
	<input type="text" name="email_body" placeholder="email body">		
	<input type="file" name="file[]" placeholder="file" multiple>
	<input type="submit" name="btn" value="submit">
	</form>
</body>
</html>