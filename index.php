<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smash Or Pass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .card {
            width: 300px;
        }


        .card-img {
            height: 300px;
            overflow: hidden;
        }

        .card-img-top {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }

        h1 {
            color: whitesmoke;
            margin-bottom: 10px;
            font-weight: bolder;
            position: relative;
            /* Ensure relative positioning for z-index */
            z-index: 10;
            /* Ensure h1 is above other content */
        }

        #particles-js {
            position: fixed;
            /* Position particles container */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            /* Ensure particles are behind other content */
            background-color: black;
        }

        #content {
            position: relative;
            /* Ensure relative positioning for z-index */
            z-index: 2;
            /* Ensure content is above particles */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: transparent;
            /* Ensure content div is transparent */
        }
    </style>
</head>

<body>
    <div id="particles-js">
    </div>
    <div id="content" class="d-flex justify-content-center align-items-center vh-100">
        <div class="text-center d-flex flex-column align-items-center">
            <h1 class="h1-above-cards">Smash Or Pass</h1>
            <div class="d-flex justify-content-center">
                <?php
                require "./models.php";
                $db = new Database();
                $peeps = $db->getPeeps();
                if (count($peeps) == 2) {
                    $peep1 = $peeps[0];
                    $peep2 = $peeps[1];
                ?>
                    <div class="card" onclick="processImage('<?= $peep1['id']; ?>', '<?= $peep2['id']; ?>)">
                        <?= $peep1['id']; ?>
                        <div class="card-img">
                            <img src="./static/images/<?= $peep1['filename']; ?>" class="card-img-top" alt="pic1">
                        </div>
                    </div>
                    <div class="mx-3"></div>
                    <div class="card" onclick="processImage('<?= $peep2['id']; ?>', '<?= $peep1['id']; ?>')">
                        <?= $peep2['id']; ?>
                        <div class="card-img">
                            <img src="./static/images/<?= $peep2['filename']; ?>" class="card-img-top" alt="pic2">
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <script src="./static/particles.js"></script>
        <script src="./static/app.js"></script>
        <script>
            function processImage(winner, lose) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'process.php';

                const picked = document.createElement('input');
                picked.type = 'hidden';
                picked.name = 'picked';
                picked.value = winner;

                const loser = document.createElement('input');
                loser.type = 'hidden';
                loser.name = 'loser';
                loser.value = lose;


                form.appendChild(picked);
                form.appendChild(loser);
                document.body.appendChild(form);
                form.submit();
            }
        </script>
</body>

</html>