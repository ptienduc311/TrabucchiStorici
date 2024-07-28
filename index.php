<?php
require("config/email.php");
require("lib/email.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'])) {
        if (empty($_POST['name'])) {
            $error['name'] = "Il nome è obbligatorio!";
        } else {
            $name = htmlspecialchars($_POST['name']);
        }
    }
    if (isset($_POST['adults'])) {
        if (empty($_POST['adults'])) {
            $error['adults'] = "È richiesto l'uso degli adulti!";
        } else {
            $adults = intval($_POST['adults']);
        }
    }
    if (isset($_POST['children6to10'])) {
        if (empty($_POST['children6to10'])) {
            $error['children6to10'] = "Bambini (6 – 10 anni) è obbligatorio!";
        } else {
            $children6to10 = intval($_POST['children6to10']);
        }
    }
    if (isset($_POST['children0to5'])) {
        if (empty($_POST['children0to5'])) {
            $error['children0to5'] = "Bambini (0 – 5 anni) è obbligatorio!";
        } else {
            $children0to5 = intval($_POST['children0to5']);
        }
    }
    if (isset($_POST['email'])) {
        if (empty($_POST['email'])) {
            $error['email'] = "L'e-mail è obbligatoria!";
        } else {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        }
    }
    if (isset($_POST['phone'])) {
        if (empty($_POST['phone'])) {
            $error['phone'] = "È richiesto il telefono!";
        } else {
            $phone = htmlspecialchars($_POST['phone']);
        }
    }
    if (isset($_POST['date'])) {
        if (empty($_POST['date'])) {
            $error['date'] = "La data è obbligatoria!";
        } else {
            $date = htmlspecialchars($_POST['date']);
        }
    }

    if (empty($error)) {
        $total = ($adults * 12) + ($children6to10 * 9);
        $daysOfWeek = [
            1 => 'Lunedì',
            2 => 'Martedì',
            3 => 'Mercoledì',
            4 => 'Giovedì',
            5 => 'Venerdì',
            6 => 'Sabato',
            7 => 'Domenica'
        ];
        $dayOfWeekNumber  = date_format(date_create($date), "N");
        $dayOfWeekItaly = $daysOfWeek[$dayOfWeekNumber];
        $dayOfFormat = date_format(date_create($date), "d/m/Y");
        $day = $dayOfWeekItaly .', ' . $dayOfFormat;
        echo $day;

        // $subject = "Conferma Prenotazione";
        // $message = "
        // <html>
        // <head>
        //     <title>Conferma Prenotazione</title>
        // </head>
        // <body>
        //     <h1>Conferma Prenotazione</h1>
        //     <p>Grazie per la tua prenotazione, $name.</p>
        //     <p><strong>Riepilogo:</strong></p>
        //     <ul>
        //         <li>Nr. adulti: $adults</li>
        //         <li>Nr. bambini (6 – 10 anni): $children6to10</li>
        //         <li>Nr. bambini (0 – 5 anni): $children0to5</li>
        //         <li>Email: $email</li>
        //         <li>Nr. telefono: $phone</li>
        //         <li>Data: $day</li>
        //         <li><strong>Totale da pagare: €$total</strong></li>
        //     </ul>
        //     <p>Grazie per aver scelto i nostri servizi.</p>
        // </body>
        // </html>
        // ";
        // send_mail('info@trabucchidelgargano.org', 'Conferma Prenotazione', $subject, $message);
        // $check = send_mail($email, $name, $subject, $message);
        // if ($check) {
        //     echo "<script>alert('Prenotazione inviata con successo!');</script>";
        // } else {
        //     echo "<script>alert('Errore nell'invio della prenotazione!');</script>";
        // }
    }
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modulo di Prenotazione</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        .container {
            max-width: 960px;
        }

        .hidden {
            display: none;
        }

        #totalDisplay {
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 20px;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Modulo di Prenotazione</h1>
        <form id="bookingForm" method="POST">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" id="name" name="name" required />
                <?php echo !empty($error["name"]) ? "<p class='text-danger m-0 pt-2'>" . $error['name'] . "</p>" : "" ?><br />
            </div>
            <div class="form-group">
                <label for="adults">Nr. adulti:</label>
                <input type="number" class="form-control" id="adults" name="adults" min="0" required />
                <?php echo !empty($error["adults"]) ? "<p class='text-danger m-0 pt-2'>" . $error['adults'] . "</p>" : "" ?><br />
            </div>
            <div class="form-group">
                <label for="children6to10">Nr. bambini (6 – 10 anni):</label>
                <input type="number" class="form-control" id="children6to10" name="children6to10" min="0" required />
                <?php echo !empty($error["children6to10"]) ? "<p class='text-danger m-0 pt-2'>" . $error['children6to10'] . "</p>" : "" ?><br />
            </div>
            <div class="form-group">
                <label for="children0to5">Nr. bambini (0 – 5 anni):</label>
                <input type="number" class="form-control" id="children0to5" name="children0to5" min="0" required />
                <?php echo !empty($error["children0to5"]) ? "<p class='text-danger m-0 pt-2'>" . $error['children0to5'] . "</p>" : "" ?><br />
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required />
                <?php echo !empty($error["email"]) ? "<p class='text-danger m-0 pt-2'>" . $error['email'] . "</p>" : "" ?><br />
            </div>
            <div class="form-group">
                <label for="phone">Nr. telefono:</label>
                <input type="tel" class="form-control" id="phone" name="phone" required />
                <?php echo !empty($error["phone"]) ? "<p class='text-danger m-0 pt-2'>" . $error['phone'] . "</p>" : "" ?><br />
            </div>
            <div class="form-group">
                <label for="date">Data:</label>
                <input type="text" class="form-control" id="date" name="date" required />
                <?php echo !empty($error["date"]) ? "<p class='text-danger m-0 pt-2'>" . $error['date'] . "</p>" : "" ?><br />
            </div>

            <button type="submit" class="btn btn-primary">Invia</button>
        </form>

        <div id="totalDisplay" class="hidden">
            Totale da pagare: €<span id="totalAmount">0</span>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/it.js"></script>
    <script>
        flatpickr("#date", {
            locale: "it",
            dateFormat: "Y-m-d",
            disable: [
                function(date) {
                    return date.getDay() === 5; // Disabilita i venerdì
                },
            ],
            enable: [
                function(date) {
                    return [1, 2, 3, 4, 6, 0].includes(date.getDay()); // Abilita lunedì, martedì, mercoledì, giovedì, sabato, domenica
                },
            ],
        });

        function calculateTotal() {
            const adults = parseInt(document.getElementById("adults").value) || 0;
            const children6to10 =
                parseInt(document.getElementById("children6to10").value) || 0;
            const total = adults * 12 + children6to10 * 9;
            document.getElementById("totalAmount").textContent = total;
            document.getElementById("totalDisplay").classList.remove("hidden");
        }

        document.getElementById("adults").addEventListener("input", calculateTotal);
        document.getElementById("children6to10").addEventListener("input", calculateTotal);
    </script>
</body>

</html>