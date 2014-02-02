<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>مرحباً بك فى عامر جروب 2</h2>

		<div>
            لقد تم التسجيل فى موقع عامر جروب2 بنجاح, يمكنك البحث عن:

            <ul>
                @foreach($categories as $category)
                <li><a href="{{ URL::page('estate/all', $category) }}">{{ $category->title }}</a></li>
                @endforeach
            </ul>

            لإضافة عقار
           <a href="{{ URL::page('estate/create') }}">من هنا</a>
		</div>
	</body>
</html>