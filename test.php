<?php
    // Create connection to Oracle
    $conn = oci_connect("cise_username", "cise_password", "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.cise.ufl.edu)(PORT=1521))(CONNECT_DATA=(SID=orcl)))");
    if (!$conn) {
        $m = oci_error();
        echo $m['message'], "\n";
        exit;
    } else {
        print "Connected to Oracle!";
    }

    // Close the Oracle connection
    oci_close($conn);
?>%

