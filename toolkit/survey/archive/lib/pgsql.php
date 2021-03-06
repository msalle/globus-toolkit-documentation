<?php

class Database
{
    var $db;

    function Database()
    {
        $this->db = pg_connect( "host=pgsql.mcs.anl.gov dbname=gtsurvey
            user=gtsurvey password=gtsurvey.db" )
            or die ( "Postgres connection failed: " .
            pg_last_error( $connection ) );
    }

    function close()
    {
        pg_close( $this->db );
    }

    function query( $sql )
    {
        return pg_exec( $sql );
    }
}

?>
