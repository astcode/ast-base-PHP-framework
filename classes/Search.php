<?php
/**
*
*/
class Search {

    private $_db;

    public function __construct() {
        $this->_db = DB::getInstance();
        // var_dump($this);
    }

    public function search($search_term, $table, $row, $row2=NULL, $row3=NULL, $row4=NULL){
        $sanitized = ($search_term);

        $row_2 = ($row2 !==NULL) ? " OR $row2 LIKE '%{$sanitized}%'" : "" ;
        $row_3 = ($row3 !==NULL) ? " OR $row3 LIKE '%{$sanitized}%'" : "" ;
        $row_4 = ($row4 !==NULL) ? " OR $row4 LIKE '%{$sanitized}%'" : "" ;

        // run query
        $query = $this->_db->query("
            SELECT *
            FROM {$table}
            WHERE {$row} LIKE '%{$sanitized}%'
            {$row_2}
            {$row_3}
            {$row_4}
        ");

        // check results
        if (!$query->results()) {
            return false;
        }

        // loop and fetch the objects
        foreach ($query->results() as $row) {
            $rows[] = $row;
        }

        // Build our return results
        $search_results = array(
            'count' =>  $query->count(),
            'results'   =>  $rows
        );

        return $search_results;
    }

    public function getResults($s_table, $value, $param="id", $operators="=") {
        return $this->_db->query("SELECT * FROM $s_table WHERE $param $operators $value");
    }
}