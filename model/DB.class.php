<?php

class DB
{
    var $db_host = "";
    var $db_user = "";
    var $db_pass = "";
    var $db_name = "";
    var $db_link;
    var $result;

    function __construct($db_host, $db_user, $db_pass, $db_name) {
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_name = $db_name;
    }

    function open() {
        $this->db_link = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
    }

    function execute($query) {
        $this->result = $this->db_link->query($query);
        return $this->result;
    }

    function getResult() {
        return $this->result->fetch_assoc();
    }

    function close() {
        $this->db_link->close();
    }
}

?>