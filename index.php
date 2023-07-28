<?php

$connection = require_once __DIR__ . '/Connection.php';
$notes = $connection->getNotes();

$currentNote = [
    'id' => '',
    'title' => '',
    'description' => ''
];

if (isset($_GET['id'])) {
    $currentNote = $connection->getNoteById($_GET['id']); 
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <header>
        <h1 class="text-center fw-bold m-3">
            Notes
        </h1>
    </header>
    <main>
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-4">
                    <form action="./save.php" method="POST">
                        <div class="mb-3">
                            <input type="hidden" name="id" value="<?php echo $currentNote['id'] ;?>">
                        </div>                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" value="<?php echo $currentNote['title'] ;?>" class="form-control" id="title" placeholder="Note title">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="" rows="5" id="description" class="form-control" placeholder="Note description"
                            ><?php echo $currentNote['description'] ;?></textarea>
                        </div>
                        <button class="btn btn-outline-secondary">
                            <?php if($currentNote['id']):?> 
                                <?php echo 'Update note'; ?>
                            <?php else: ?>
                                <?php echo 'Add note'; ?>
                            <?php endif; ?> 
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="row flex-column align-items-center flex-nowrap overflow-auto" style="height: 400px; margin: 0 35%">
                <?php foreach ($notes as $note): ?>
                    <div class="col-12 border bg-warning overflow-auto mb-3" style="height: 200px;">
                        <div class="header d-flex justify-content-between">
                            <h3 class="mb-0">
                                <a href="?id=<?php echo $note['id']; ?>" style="color: black;">
                                    <?php echo $note['title']; ?>
                                </a>
                            </h3>
                            <button class="border-0 bg-warning py-0 px-3">X</button>
                        </div>
                        <small class="mb-2 d-block">
                            <?php
                                // La data UTC salvata nel database (assumiamo che sia nel formato "Y-m-d H:i:s")
                                $utc_date_str = $note['create_date'];

                                // Crea un oggetto DateTime per la data UTC
                                $utc_date = new DateTime($utc_date_str, new DateTimeZone('UTC'));

                                // Imposta la zona oraria desiderata (ad esempio, "Europe/Rome" per l'Italia)
                                $local_timezone = new DateTimeZone('Europe/Rome');

                                // Converte la data UTC nel tuo fuso orario locale
                                $local_date = $utc_date->setTimezone($local_timezone);

                                // Ora puoi stampare la data nel tuo fuso orario locale
                                echo $local_date->format('Y-m-d H:i:s');
                            ?>
                        </small>
                        <p>
                            <?php echo $note['description']; ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
</body>
</html>