<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <title>test</title>

</head>

<body>
    <header class="container">
        <div class="container  ">
            <div class="row">
                <div class="g-col-6 text-md-left flex-column">
                    <h1> Test de insercion de un hotel </h1>
                </div>
            </div>
        </div>
    </header>

    <section>

        <!--  Metodo para insertar un campo   -->
        <form method="POST" action="{{ route('insertarEmpresa') }}">
            @csrf
            <div class="container m-2">
                <label for="nombre" class="form-label">Nombre del hotel</label>
                <input type="text" name="nombre" id="nombre" class="form form-inline">
            </div>
            <button type="submit" class="btn btn-primary m-2">Ingresar</button>
        </form>



    </section>

    <footer>

    </footer>
</body>

</html>
