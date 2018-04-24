<?php
/* This web site had the most current and correct code for working with MongoDB:
	http://zetcode.com/db/mongodbphp/
*/

/* This code will list all databases in Mongo */
try {

    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    $listdatabases = new MongoDB\Driver\Command(["listDatabases" => 1]);
    $res = $mng->executeCommand("admin", $listdatabases);

    $databases = current($res->toArray());

    foreach ($databases->databases as $el) {
		echo"<h1>";
        echo $el->name . "\n";
		echo"</h1>";
    }

} catch (MongoDB\Driver\Exception\Exception $e) {

    $filename = basename(__FILE__);
    
    echo "The $filename script has experienced an error.\n"; 
    echo "It failed with the following exception:\n";
    
    echo "Exception:", $e->getMessage(), "\n";
    echo "In file:", $e->getFile(), "\n";
    echo "On line:", $e->getLine(), "\n";       
}

/*********** End Database Listing **********************/


/* This query will extract data from the department collection in employees*/
try {

    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $query = new MongoDB\Driver\Query([]); 
     
    $rows = $mng->executeQuery("employees.department", $query);
    
	echo"<table><tr><td>Dept. ID</td><td>Dept. Name</td></tr>";
    foreach ($rows as $row) {
		echo"<tr><td>";
        echo "$row->_id : $row->dept_name\n";
		echo"</td></tr>";
    }
    echo"</table>";
} catch (MongoDB\Driver\Exception\Exception $e) {

    $filename = basename(__FILE__);
    
    echo "The $filename script has experienced an error.\n"; 
    echo "It failed with the following exception:\n";
    
    echo "Exception:", $e->getMessage(), "\n";
    echo "In file:", $e->getFile(), "\n";
    echo "On line:", $e->getLine(), "\n";       
}
/*********** End data query from department *************************/

/* This code allows for data filtering. It will only query a department named 'Sales' */

try {
         
    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    
    $filter = [ 'dept_name' => 'Sales' ]; 
    $query = new MongoDB\Driver\Query($filter);     
    
    $res = $mng->executeQuery("employees.department", $query);
    
    $dept = current($res->toArray());
    
    if (!empty($dept))
	{
		echo"<h1>";
        echo $dept->dept_name, ": ", $dept->dept_manager, PHP_EOL;
		echo"</h1>";
    } 
	else
	{
    
        echo "No match found\n";
    }
    
} catch (MongoDB\Driver\Exception\Exception $e) {

    $filename = basename(__FILE__);
    
    echo "The $filename script has experienced an error.\n"; 
    echo "It failed with the following exception:\n";
    
    echo "Exception:", $e->getMessage(), "\n";
    echo "In file:", $e->getFile(), "\n";
    echo "On line:", $e->getLine(), "\n";    
}
/****************************************************************************/

/* Working with Projections! */
try {
     
    $filter = [];
    $options = ["projection" => ['_id' => 0]];
    
    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $query = new MongoDB\Driver\Query($filter, $options);
    
    $rows = $mng->executeQuery("employees.department", $query);
       
    foreach ($rows as $row) {
          echo"\n";
		  print_r($row);
		  
    }    
        
} catch (MongoDB\Driver\Exception\Exception $e) {

    $filename = basename(__FILE__);
    
    echo "The $filename script has experienced an error.\n"; 
    echo "It failed with the following exception:\n";
    
    echo "Exception:", $e->getMessage(), "\n";
    echo "In file:", $e->getFile(), "\n";
    echo "On line:", $e->getLine(), "\n";    
}
/*********** End working with Projections **************/
?>