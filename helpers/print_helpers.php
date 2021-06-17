<?php

Class PrintHelpers {
    static function print_movie($movie) {
        $output = "<ul id='movie-item'>";
        $output .= "<li><b>Movie ID:</b> " .$movie['id']."</li>";
        $output .= "<li><b>Title:</b> " .$movie['title']."</li>";
        $output .= self::print_poster($movie['poster']);
        $output .= self::print_description($movie['description']);
        $output .= self::print_year($movie['year']);
        $output .= self::print_actors_from_movie_id($movie['id']);
        $output .= "</ul>";

        echo $output;
    }

    static function print_poster($url) {
        if ($url == "") return "<li>No poster available.</li>";

        $img = "<img ";
        $img .= "src='";
        $img .= $url;
        $img .= "' ";
        $img .= "alt='Movie poster' ";
        $img .= "width='250' ";
        $img .= "/>";
        return $img;
    }

    static function print_description($description) {
        if (empty($description)) return;

        $desc_string = "<li id='description'><b>Info:</b> ".$description."</li>";
        return $desc_string;
    }
    
    static function print_year($year) {
        if (empty($year)) return;

        $year_string = "<li><b>Year:</b> " .$year."</li>";
        return $year_string;
    }

    static function print_actors($actors) {
        if (empty($actors)) return;

        $string = "<ul><b>Actors:</b>";
        foreach($actors as $actor) {
            $string .= "<li>" .$actor['name']. "</li>";
        }
        $string .= "</ul>";
        return $string;
    }

    static function print_actors_from_movie_id($movie_id) {
        $result = DbHelpers::fetch_actors_from_movie_id($movie_id);

        if(empty($result)) return;

        $string = "<ul><b>Actors:</b>";
        foreach($result as $actor) {
            $string .= "<li>" .$actor['name']. "</li>";
        }
        $string .= "</ul>";
        return $string;
    }
}
