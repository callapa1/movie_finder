<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8" />
    <title>Movie Finder</title>
</head>
<body>
    <style>
        ul {
            list-style-type: none;
            margin-block-start: 0;
            padding-inline-start: 0;
        }
        form {
            margin: 10px;
        }
        #results {
            display: flex;
            width: 100%;
            flex-flow: row wrap;
        }
        #movie-item {
            display: block;
            flex: 0 0 25%;
            text-align: center;
        }
        #description {
            max-width: 300px;
            padding-left: 40px;
        }
    </style>
    
    <form action="" method="POST">
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
                value="<?=$_POST['movie_id']?>"
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
                value="<?=$_POST['keywords']?>">
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