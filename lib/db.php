<?php

/*
 * Mvnoのデータベースを扱う
 * $m = new Mvno();
 * $results = $m->getInfo( 'dmm' );
 * $results['shortname'] -> 'dmm';
 */
class Mvno
{
    private $db;

    function __construct()
    {
        // $dbname = 'sqlite:/var/www/sim/wp-content/themes/sim/data/mvno.db';
        $dbname = 'sqlite:' . dirname( __FILE__ ) . '/../data/mvno.db';

        try{
            $this->db = new PDO( $dbname );
            $this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }catch( PDOException $e ){
            die( 'DB connect error' . $e->getMessage() );
        }
    }

    function __destruct()
    {
        $this->db = null;
    }

    function get_mvno( $shortname )
    {
        $sql = 'SELECT * FROM mvnos WHERE shortname = :shortname';
        $stmt = $this->db->prepare( $sql );
        $stmt->bindValue( ':shortname', $shortname, PDO::PARAM_STR );

        try{
            $stmt->execute();
            $result = $stmt->fetch( PDO::FETCH_ASSOC );
            // $results = $stmt->fetchAll( PDO::FETCH_ASSOC );
        }catch( PDOException $e ){
            die( 'get_mvno error' . $e->getMessage() );
        }

        return $result;
    }
    function get_plan( $shortname )
    {
        $sql = 'SELECT * FROM plans WHERE shortname = :shortname ORDER BY id ASC';
        $stmt = $this->db->prepare( $sql );
        $stmt->bindValue( ':shortname', $shortname, PDO::PARAM_STR );
        
        try{
            $stmt->execute();
            // $result = $stmt->fetch( PDO::FETCH_ASSOC );
            $results = $stmt->fetchAll( PDO::FETCH_ASSOC );
        }catch( PDOException $e ){
            die( 'get_plan error' . $e->getMessage() );
        }
        
        // return $result;
        return $results;
    }
    function get_review( $shortname, $count = 2 )
    {
        if( $shortname == 'all' ){
          $sql = 'SELECT * FROM reviews ORDER BY RANDOM()';
          $stmt = $this->db->prepare( $sql );
        }else{
          $sql = 'SELECT * FROM reviews WHERE shortname = :shortname ORDER BY RANDOM() LIMIT :count';
          $stmt = $this->db->prepare( $sql );
          $stmt->bindValue( ':shortname', $shortname, PDO::PARAM_STR );
          $stmt->bindValue( ':count', $count, PDO::PARAM_STR );
        }
        
        try{
            $stmt->execute();
            // $result = $stmt->fetch( PDO::FETCH_ASSOC );
            $results = $stmt->fetchAll( PDO::FETCH_ASSOC );
        }catch( PDOException $e ){
            die( 'get_review error' . $e->getMessage() );
        }
        
        // return $result;
        return $results;
    }
    function get_mobile( $shortname )
    {
        $sql = 'SELECT * FROM mobiles WHERE shortname = :shortname';
        $stmt = $this->db->prepare( $sql );
        $stmt->bindValue( ':shortname', $shortname, PDO::PARAM_STR );

        try{
            $stmt->execute();
            $result = $stmt->fetch( PDO::FETCH_ASSOC );
            // $results = $stmt->fetchAll( PDO::FETCH_ASSOC );
        }catch( PDOException $e ){
            die( 'get_mobile error' . $e->getMessage() );
        }

        return $result;
    }
    function get_data_by_sql( $sql )
    {
        $stmt = $this->db->prepare( $sql );

        try{
            $stmt->execute();
            $result = $stmt->fetchAll( PDO::FETCH_ASSOC );
        }catch( PDOException $e ){
            die( 'get_data_by_sql error' . $e->getMessage() );
        }

        return $result;
    }
}
