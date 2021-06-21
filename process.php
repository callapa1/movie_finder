<?php
    include_once './db.php';
    include_once './helpers/string_helpers.php';
    include_once './helpers/print_helpers.php';
    include_once './helpers/db_helpers.php';

    // For testing only
    // $data = file_get_contents("movies.json");
    // $movies = json_decode($data,true)['movies'];
    
    
    if (isset($_GET['all_movies'])) {
        $results_per_page = 4;
        $result = $GLOBALS['conn']->query("SELECT * FROM movies");
        $number_of_results = mysqli_num_rows($result);
        
        if ($_GET['all_movies'] == ""){
            $page = 1;
        } else {
            $page = $_GET['all_movies'];
        }

        $this_page_first_result = ($page-1) * $results_per_page;
        $no_of_pages = ceil($number_of_results / $results_per_page);

        // Exporting globals
        $GLOBALS['page'] = $page;
        $GLOBALS['no_pages'] = $no_of_pages;

        // echo "<div class='pagination'>";
        // for ($page=1 ; $page <= $no_of_pages ; $page++) {
        //     echo '<a href="index.php?all_movies=' . $page . '">' . $page . '</a>';
        // }
        // echo "</div>";

        $movies_sql = $GLOBALS['conn']->query("SELECT * FROM movies LIMIT " . $this_page_first_result .",". $results_per_page);
        while($movie = mysqli_fetch_array($movies_sql)) {
            PrintHelpers::print_movie($movie);
        }
    }

    if (isset($_POST['movie_by_id'])) {
        $movie_id = (int)$_POST['movie_id'];
        $movie = DbHelpers::fetch_movie_by_id($movie_id);
        $movie = $movie[$movie_id];
        if($movie) {
            PrintHelpers::print_movie($movie);
        }
    }

    if (isset($_POST['movie_by_title'])) {
        $pass = false;
        $ids_printed = [];
        $_POST['keywords'] = StringHelpers::tidy_string($_POST['keywords'], $pass);
        $movies = DbHelpers::fetch_movies();

        if ($pass == false) return;
        $keywords_array = explode(" ", $_POST['keywords']);

        while($keywords_array) {
            $word = array_shift($keywords_array);
            foreach($movies as $movie) {
                $found = stripos($movie['title'], $word);
                $is_printed = array_search($movie['id'], $ids_printed);

                if ($found !== false) {
                    if ($is_printed !== false) {
                        continue;
                    } else {
                        $ids_printed[] = $movie['id'];

                        PrintHelpers::print_movie($movie);
                    }
                }
            }
        }

        if (empty($ids_printed)) {
            echo "Keywords not found";
        }
    }
    ?>
