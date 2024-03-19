<?php
    $hotels = [

        [
            'Name' => 'Hotel Belvedere',
            'Description' => 'Hotel Belvedere Descrizione',
            'Parking' => true,
            'Vote' => 4,
            'Distance' => 10.4
        ],
        [
            'Name' => 'Hotel Futuro',
            'Description' => 'Hotel Futuro Descrizione',
            'Parking' => true,
            'Vote' => 2,
            'Distance' => 2
        ],
        [
            'Name' => 'Hotel Rivamare',
            'Description' => 'Hotel Rivamare Descrizione',
            'Parking' => false,
            'Vote' => 1,
            'Distance' => 1
        ],
        [
            'Name' => 'Hotel Bellavista',
            'Description' => 'Hotel Bellavista Descrizione',
            'Parking' => false,
            'Vote' => 5,
            'Distance' => 5.5
        ],
        [
            'Name' => 'Hotel Milano',
            'Description' => 'Hotel Milano Descrizione',
            'Parking' => true,
            'Vote' => 2,
            'Distance' => 50
        ],

    ];

    $keys = array_keys($hotels[0]);

    $with_parking = isset($_GET['with_parking']) ? $_GET['with_parking'] : null;
    $with_vote = isset($_GET['with_vote']) ? $_GET['with_vote'] : null;

    $hotelsFiltered = [];
    $arrayToPrint = [];

    foreach ($hotels as $currentHotel) {
        if ($with_vote !== "") {
            if ($currentHotel['Vote'] >= $with_vote) {
                array_push($hotelsFiltered, $currentHotel);
            }
        } else {
            array_push($hotelsFiltered, $currentHotel);
        }
    }

    foreach ($hotelsFiltered as $currentHotel) {
        if ($with_parking === 'true') {
            if ($currentHotel['Parking'] === true) {
                array_push($arrayToPrint, $currentHotel);
            }
        } else {
            array_push($arrayToPrint, $currentHotel);
        }
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boovago</title>

    <!-- boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>

<body class="d-flex flex-column align-items-center">

    <h1 class="my-2">Boovago</h1>

    <form method="GET" id="my_form" class="d-flex flex-column align-items-center">
        <div class="mb-3">
            <div class="form-check">
                <input name="with_parking" class="form-check-input" type="checkbox" value="true" id="flexCheckDefault" <?php if ($with_parking) echo "checked"; ?>> <!-- per mantenere la compilazione del form-->
                <label class="form-check-label" for="flexCheckDefault">
                    Parking
                </label>
            </div>
        </div>

        <div class="mb-3">
            <div class="d-flex flex-column align-items-center">
                <label class="input-group-textl">Voto</label>
                <input name="with_vote" type="number" min="1" max="5" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" <?php if (!empty($with_vote)) echo 'value="' . $with_vote . '"'; ?>> <!-- per mantenere la compilazione del form-->
            </div>
        </div>

        <input id="submit" type="submit">
    </form>



    <!-- ------------------------------------------------------------------------ -->

    <table class="table w-75 border border-secondary my-3">
        <thead>
            <tr class="table-primary">
            <?php
                foreach ($keys as $key) {
                    echo "<th scope=\"col\">$key</th>";
                }
            ?>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($hotels as $currentHotel) {
                    echo "
                    <tr class=\"table-secondary\">";
                    foreach($currentHotel as $key => $value) {

                        if($key == 'Parking') {
                            $value = ($value) ? 'Si' : 'No';
                        }

                        echo "<td>$value</td>";
                    }
                    echo "
                    </tr>";
                }
            ?>
        </tbody>
    </table>

    <!-- Per importare la tabella all'interno di un blocco echo in PHP, memorizzo il markup HTML 
    in una variabile e quindi la stampo all'interno dell'istruzione echo. -->

    <?php

        if ($with_parking === 'true' || $with_vote != "") {

            echo "<h2 class='mt-2'> Hotel filtrati </h2>";

            $tableHTML = '
                <table class="table w-75 border border-secondary my-3">
                <thead>
                <tr class="table-primary">
            ';


            foreach ($keys as $key) {
                $tableHTML .= "<th scope=\"col\">$key</th>";
            }

            $tableHTML .= '
                </tr>
                </thead>
                <tbody>
            ';

            foreach ($arrayToPrint as $currentHotel) {
                $tableHTML .= '<tr class="table-secondary">';

                foreach($currentHotel as $key => $value) {
                    if($key == 'Parking') {
                        $value = ($value) ? 'Si' : 'No';
                    }
                    $tableHTML .= "<td>$value</td>";
                }

                $tableHTML .= '</tr>';
            }

            $tableHTML .= '
                </tbody>
            </table>
            ';

            // Stampo la variabile contenente il markup nell' echo
            echo $tableHTML;
        }
    ?>

</body>
</html>