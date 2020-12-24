<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css?v='.time()) }}" rel="stylesheet">

</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-4">

            <div class="just-padding">
                <div class="list-group list-group-root well">
                    @each('partials.category', $categories, 'category')
                </div>
            </div>

        </div>
        <div class="col-md-8">
asd
        </div>
    </div>
</div>

</body>
</html>
