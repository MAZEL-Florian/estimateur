<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("title") | Projet MVC</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        @yield("css")
</head>
<body class="rokett-bg-estimateur">
    <h1 class="text-center p-5">Estimateur de salaire</h1>
    <!-- <div class=""> -->
        <div class="d-flex justify-content-sm-center rokett-estimateur-section p-5">
            <form id="formulaire" class="rokett-estimateur-form">
                <div id="secteur-container" class="text-center">
                    <select class="secteur-select form-select form-select-lg estimateur-select mb-3" name="secteur_id">
                        <option value="none" selected disabled hidden>Secteur</option>
                        @foreach($secteurs as $secteur)
                            <option value="{{ $secteur->id }}">{{ $secteur->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="metier-container" style="display: none;">
                </div>
                <div id="stack-container" style="display: none;">
                </div>
                <div id="specialisation-container" style="display: none;">
                </div>
                <div id="framework-container" style="display: none;">
                </div>
                <div id="ville-container" style="display: none;">
                </div>
                <div id="xp-container" style="display: none;">
                </div>
                <div class="text-center">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"><br>
                <input disabled type="submit" name="submitForm" value="Estimer mon salaire" class="submit-form bg-gradient-line-btn">
                </div>
                <div class="text-center">
                    <p id="result"></p>
                    <p id="secteur"></p>
                </div>
            </form>
        </div>
    <!-- </div> -->
    <script src="{{ asset('js/estimateurFormAjax.js') }}"></script>
    <script src="\jQuery.js"></script>
    <script src="\bootstrap\js\bootstrap.js"></script>
    @yield("js")
</body>

</html>
