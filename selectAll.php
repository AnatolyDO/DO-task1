<?php
	include('dbconnect.php');
	                
        $query = "SELECT * FROM search";
        
        $result = $mysqlLink->query($query);  
	
	$mysqlLink->close();
		
        echo "
		<a href='index.html'>back</a>
		<table border='0' cellspacing='5' cellpadding='2'>
		<tr> 
			<th>id</th>
			<th>url</th>
			<th style=\"display:none;\">elements</th>
			<th>num</th>
			<th>action</th>
		</tr>
	";

        if ($result) {
            while ($resultObj = $result->fetch_object()) {
                //var_dump($resultObj);  //Посмотреть что внутри объекта
                $id = $resultObj->id;
		$url = $resultObj->url;
		$elements = $resultObj->elements;
		$num = $resultObj->num;
                
                echo "
                    <tr>
                        <td>$id</td>
                        <td><a data-toggle=\"modal\" href=\"#foundModal\" onclick=\"showFound($id, this.text);\">$url</a></td>
                        <td style=\"display:none;\">$elements</td>
                        <td>$num</td>
                        <td>
                            <form action='deleteLine.php' method='GET'>
                                    <input type='hidden' name='d_id' value='$id'/>
                                    <input type='submit' value='delete'/>
                            </form>
                        </td>
                    </tr>
		";
            }
        }
        

?>