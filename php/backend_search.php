<?php 
	include_once '../backend/connection.php';

	// get the q parameter from URL
	$q = $_REQUEST["q"];



	//sql codes
	/*$sql = "
	SELECT prod_name, MATCH (prod_name)
    AGAINST ('".$q."' IN NATURAL LANGUAGE MODE WITH QUERY EXPANSION) AS search_percent
    FROM product ORDER BY search_percent DESC LIMIT 5
    ";

    $sql_genre = "
	SELECT prod_genre_name, MATCH (prod_genre_name)
    AGAINST ('".$q."' IN NATURAL LANGUAGE MODE WITH QUERY EXPANSION) AS search_percent
    FROM product_genre ORDER BY search_percent DESC LIMIT 5
    ";*/

    $sql_search_table = "
	SELECT user_searches, search_query, MATCH (search_query)
    AGAINST ('".$q."' IN NATURAL LANGUAGE MODE) AS search_percent
    FROM search ORDER BY search_percent DESC, user_searches DESC LIMIT 5
    ";

    //$result = $conn->query($sql);
    //$result_genre = $conn->query($sql_genre);
    $result_search = $conn->query($sql_search_table);
    $a[] = 'none';

    /*while ($row = $result->fetch_assoc()) {
    	if ($row['search_percent'] == 0) {
    		//Do nothing
    	} else {
    		if (!in_array($row['prod_name'], $a)) {
  				$a[] .= $row['prod_name'];
    		}
    	}
    }
    
    while ($row_genre = $result_genre->fetch_assoc()) {
    	if ($row_genre['search_percent'] == 0) {
    		//Do nothing
    	} else {
    		if (!in_array($row_genre['prod_genre_name'], $a)) {
  				$a[] .= $row_genre['prod_genre_name'];
    		}    
    	}
    }*/

    while ($row_search = $result_search->fetch_assoc()) {
    	if ($row_search['search_percent'] == 0) {
    		//Do nothing
    	} else {	
    		if (!in_array($row_search['search_query'], $a)) {
  				$a[] .= $row_search['search_query'];
    		}    
    	}
    }


    foreach ($a as $name) {
    	if ($name == 'none') {
    		// Do nothing
    	} else {
    		echo "<a href='search.php?q=".$name."' id='txtHint'>".$name."</a>";
    	}
    }

?>