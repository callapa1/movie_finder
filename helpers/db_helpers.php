<?php

Class DbHelpers {
    static function fetch_movies(){
        $movies_sql = $GLOBALS['conn']->query("SELECT * FROM movies");
        $indexed = [];

        while($row = $movies_sql->fetch_assoc()){
            $indexed [$row['id']]= $row;
        }
        return $indexed;
    }

    static function fetch_movies_four($checkpoint = 0){
        $movies_sql = $GLOBALS['conn']->query("SELECT * FROM movies LIMIT 4 OFFSET $checkpoint");
        $indexed = [];

        while($row = $movies_sql->fetch_assoc()){
            $indexed [$row['id']]= $row;
        }
        return $indexed;
    }

    static function fetch_movie_by_id($id){
        $movies_sql = $GLOBALS['conn']->query("SELECT * FROM movies WHERE id=$id LIMIT 1");

        while($row = $movies_sql->fetch_assoc()){
            $indexed [$row['id']]= $row;
        }
        return $indexed;
    }

    static function fetch_actors_from_movie_id($movie_id){
        $actors_sql = $GLOBALS['conn']->query("SELECT * FROM actors WHERE movie_id=$movie_id");
        $indexed = [];

        while($row = $actors_sql->fetch_assoc()){
            $indexed []= $row;
        }
        return $indexed;
    }
}
