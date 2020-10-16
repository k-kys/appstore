<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
        <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        @php
        require_once(public_path() ."/phpGrid_Lite/conf.php");

        $dg = new C_DataGrid("SELECT * FROM users", "id", "users");
        $dg->enable_edit("INLINE", "CRUD");
        $dg->display();

        $sdg = new C_DataGrid("SELECT * FROM apps", "id", "apps");
        $sdg->enable_edit("INLINE", "CRUD");
        // $dg->set_masterdetail($sdg, 'id');
        $sdg->display();
        @endphp
    </div>
</body>
</html>



