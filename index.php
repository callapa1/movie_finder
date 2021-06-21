<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8" />
    <title>Movie Finder</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>    
    <form action="" method="GET">
        <button
            type="submit"
            name="all_movies"
            >Get all movies
        </button>
    </form>

    <form action="" method="POST">
        <label>
            Movie ID
            <input
                type="text"
                name="movie_id"
                id=""
                value="<?= empty($_POST['movie_id']) ? '' : $_POST['movie_id']; ?>"
            >
        </label>
        <button
            type="submit"
            name="movie_by_id"
            >Search
        </button>
    </form>

    <form action="" method="POST">
        <label>
            Title (or keywords)
            <input
                type="text"
                name="keywords"
                id=""
                value="<?= empty($_POST['keywords']) ? '' : $_POST['keywords']; ?>"
            >
        </label>
        <button
            type="submit"
            name="movie_by_title"
            >Search
        </button>
    </form>
    <div id="results">
        <?php
        include_once 'process.php';
        ?>    
    </div>
</body>
</html>
