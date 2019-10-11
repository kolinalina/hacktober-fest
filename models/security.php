<?php
    require "connection.php";

    class Security extends Connection {
        function clean_post($request) {
            return mysqli_escape_string($this->conn(), $request);
        }

	    function clean_xss($request) {
            $xss = strip_tags($request);
            return $this->clean_post($xss);
        }

	    function clean_all($request) {
            $post = $this->clean_post($request);
            $xss = $this->clean_xss($post);
            return $xss;
	    }
    }

?>