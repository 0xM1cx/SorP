<head>
    <style>
        .container {
            padding: 2rem 0rem;
        }

        h4 {
            margin: 2rem 0rem 1rem;
        }

        .table-image {

            td,
            th {
                vertical-align: middle;
            }
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body class="bg-dark">
    <div class="container bg-dark">
        <div class="row">
            <div class="col-12">
                <table class="table table-image table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Rank</th>
                            <th scope="col">Image</th>
                            <th scope="col">Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require "./models.php";
                        $db = new Database();
                        $counter = 1;
                        $peeps = $db->getRankedPeeps();

                        foreach ($peeps as $peep) {

                        ?>
                            <tr>
                                <th scope="row"><?= $counter; ?></th>
                                <td class="w-25">
                                    <img src="./static/images/<?= $peep['filename']; ?>" class="img-fluid img-thumbnail" alt="Sheep">
                                </td>
                                <td class="text-center"><?= $peep['rating']; ?></td>
                            </tr>
                        <?php
                            $counter++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>