<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Random Number Generator</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Random Number Generator</h1>
        <div class="row">
            <div class="col-md-6">
                <form method="post">
                    <div class="form-group">
                        <label for="limit">Enter a limit:</label>
                        <input type="number" class="form-control" id="limit" name="limit">
                    </div>
                    <button type="submit" class="btn btn-primary">Generate Random Number</button>
                </form>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $limit = $_POST["limit"];
                    $randomNumber = rand(1, $limit);
                    echo "<p class='mt-3'>Random number: $randomNumber</p>";
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
