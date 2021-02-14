<?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['search'])) {
    $pok_api_link = 'https://pokeapi.co/api/v2/pokemon/';
    $pok_api = $pok_api_link . $_GET['search'];
    $pok_json = file_get_contents($pok_api);
    $pokemon = json_decode($pok_json, true);

    $name = $pokemon['name'];
    $id = $pokemon['id'];
    $picture = $pokemon['sprites']['front_default'];

    $moves = array_slice($pokemon["moves"], 0, 4);
    $move1 = $moves[0]["move"]["name"];
    $move2 = $moves[1]["move"]["name"];
    $move3 = $moves[2]["move"]["name"];
    $move4 = $moves[3]["move"]["name"];

    $species = json_decode(file_get_contents($pokemon["species"]["url"]), true);
    $evolution = json_decode(file_get_contents($species["evolution_chain"]["url"]), true);

    $evolution1 = json_decode(file_get_contents(str_replace("-species", "", $evolution["chain"]["species"]["url"])), true);
    $evolution2 = json_decode(file_get_contents(str_replace("-species", "", $evolution["chain"]["evolves_to"][0]["species"]["url"])), true);
    $evolution3 = json_decode(file_get_contents(str_replace("-species", "", $evolution['chain']['evolves_to'][0]['evolves_to'][0]['species']['url'])), true);
}

?>


<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pokemon</title>
    <meta name="description" content="Pokedex">
    <meta name="author" content="Anton Kantartzhiuev & Mark Hoogkamer">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="Pokedex">
    <meta property="og:type" content="Pokedex for pokemons">
    <meta property="og:url" content="../img/logo.jpeg">
    <meta property="og:image" content="img/logo.jpeg">

    <link rel="icon" type="imgage/png" href="img/logo.png">
    <link rel="apple-touch-icon" href="img/logo.png">

    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <meta name="theme-col p-2or" content="#fafafa">

</head>
<body class="container-fluid main">


<header>
    <div class="row " id="title">
        <h1 class="mx-auto titlecaption ">Pokemon <img src="img/logo.png" alt="Logo Pokedex "> Database</h1>
    </div>
</header>

<main class="container">

    <section class="row container-fluid" id="pokedex-tpl">

        <div class="col-md-6">
            <div class="row search">
                <form action="index.php" class="search" method="get">
                    <label for="search"><input id="search" name="search" placeholder="Pokémon name or ID" type="text">
                    <button type="submit" class="btn btn-warning btn-outline-dark" id="pressSearch">Search Poké</button></label>
                </form>
            </div>
            <div class="row evolution">
                <?php
                if ($evolution1 !== null) {
                    echo "<a href='index.php?search=".($evolution1['id'])."'><div id='first'><img alt='second evolution' src='".$evolution1["sprites"]["front_default"]."'></div></a>";
                }
                if ($evolution2 !== null) {
                    echo "<a href='index.php?search=".($evolution2['id'])."'><div id='second'><img alt='second evolution' src='".$evolution2["sprites"]["front_default"]."'></div></a>";
                }
                if ($evolution3 !== null) {
                    echo "<a href='index.php?search=".($evolution3['id'])."'><div id='third'><img alt='third evolution' src='".$evolution3["sprites"]["front_default"]."'></div></a>";
                }
                ?>
            </div>
        </div>
        <div class="col-md-6 " id="pokemons">
            <div class="row pokemon-img" id="pokemon-img"><?php echo "<img src='".$picture."'>"; ?></div>
            <div class="row data2" id="name"><?php echo $name; ?></div>
            <div class="row data2" id="id"><?php echo $id; ?></div>

            <table id="movestable">
                <tr>
                    <td>
                        <div class="row data2" id="move1"><?php echo $move1; ?></div>
                    </td>
                    <td>
                        <div class="row data2" id="move2"><?php echo $move2; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row data2" id="move3"><?php echo $move3; ?></div>
                    </td>
                    <td>
                        <div class="row data2" id="move4"><?php echo $move4; ?></div>
                    </td>
                </tr>
            </table>
        </div>

    </section>

</main>
<footer>

</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>

<!--bootstrap scripts-->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF"
        crossorigin="anonymous"></script>
</body>

</html>