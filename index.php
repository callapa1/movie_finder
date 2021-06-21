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
    <nav class="pagination">
        <div>
            <?php
                include_once './db.php';
                $result = $GLOBALS['conn']->query("SELECT * FROM movies");
                $number_of_results = mysqli_num_rows($result);
                $results_per_page = 4;
                $this_page_first_result = ($page-1) * $results_per_page;
                $no_of_pages = ceil($number_of_results / $results_per_page);    

                if (isset($_GET['all_movies'])) {

                    if ($_GET['all_movies'] == ""){
                        $page = 1;
                    } else {
                        $page = $_GET['all_movies'];
                    }
                    
                    for ($p=1 ; $p <= $no_of_pages ; $p++) {
                        if ($p == $page) {
                            echo '<a class="active" href="index.php?all_movies=' . $p . '">' . $p . '</a>';
                        } else {
                            echo '<a href="index.php?all_movies=' . $p . '">' . $p . '</a>';
                        }
                    }
                }
            ?>
        </div>
    </nav>
    <div id="results">
        <?php
        include_once 'process.php';
        ?>
    </div>
</body>
</html>