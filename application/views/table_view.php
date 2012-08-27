
<a href='/mvc'>back</a>
    <table border='0' cellspacing='5' cellpadding='2'>
        <tr> 
                <th>id</th>
                <th>url</th>
                <th>num</th>
        </tr>
<?php 

        //var_dump($data);

        foreach($data as $obj) {
            //var_dump($obj);
            $id = $obj->id;
            $url = $obj->url;
            $num = $obj->num;
            echo "
                <tr>
                    <td>$id</td>
                    <td><a data-toggle=\"modal\" href=\"#foundModal\" onclick=\"showFound($id, this.text);\">$url</a></td>
                    <td>$num</td>
                </tr>
            ";
        }

?>
    </table>
            <div class="modal hide" id="foundModal">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">×</button>
                      <h3 id="foundModalHeader">header</h3>
                    </div>
                    <div class="modal-body" id="foundModalBody">
                      body
                    </div>
                    <div class="modal-footer">
                      <a href="#" class="btn" data-dismiss="modal">Close</a>
                    </div>
            </div>
