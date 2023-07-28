<?php

require_once __DIR__ . '/Connection.php';
$connection = new Connection();

$notes = $connection->getNotes();
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
            <div class="row justify-content-center mb-3">
                <div class="col-4">
                    <form action="">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" placeholder="Note title">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="" id="" rows="5" id="description" class="form-control" placeholder="Note description"
                            ></textarea>
                        </div>
                        <button class="btn btn-outline-secondary">Create</button>
                    </form>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <?php foreach ($notes as $note): ?>
                    <div class="col-4 border bg-warning">
                        <div class="header d-flex justify-content-between">
                            <h2>
                                <?php echo $note['title']; ?>
                            </h2>
                            <button class="border-0 bg-warning py-0 px-3">X</button>
                        </div>
                        <p>
                            <?php echo $note['description']; ?>
                        </p>
                        <small>
                            <?php echo $note['create_date']; ?>
                        </small>
                    </div>
                <?php endforeach; ?>
            </div>
    
        </div>
    </main>
</body>
</html>