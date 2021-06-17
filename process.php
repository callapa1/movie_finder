<?php
    include_once './db.php';
    include_once './helpers/string_helpers.php';
    include_once './helpers/print_helpers.php';
    include_once './helpers/db_helpers.php';

    // For testing only
    // $data = file_get_contents("movies.json");
    // $movies = json_decode($data,true)['movies'];

    // if (isset($_POST['all_movies'])) {
    //     $movies = DbHelpers::fetch_movies();

    //     foreach($movies as $movie) {
    //         PrintHelpers::print_movie($movie);
    //     }
    // }
    
    if (isset($_POST['all_movies'])) {
        $movies = DbHelpers::fetch_movies_four();

        foreach($movies as $movie) {
            PrintHelpers::print_movie($movie);
        }
    }

    if (isset($_POST['next_page'])) {
        $movies = DbHelpers::fetch_movies_four(4);
        foreach($movies as $movie) {
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
