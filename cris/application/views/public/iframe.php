<div class="container">  
    <div class="row-fluid">
   

        <div class="span12"  >
            
                          <div align="center">  <h4> Δημοσιεύσεις </h4>     </div>
                        <table  class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="80%">Τίτλος</th>
                                    <th width="10%">Περίληψη</th>
                                    <th width="10%">   Έγγραφο</th>

                                </tr>
                            </thead>
                            <?php
                            foreach ($fullpub as $cw) {
                                echo '<tr><td> '. $cw['cfTitle'] . '</td>';
                                echo '<td><div align="center"> <a href="' . base_url() . 'index.php/public_c/showpub/' . $cw['cfResPublid'] . '" ><i class=" icon-file-text-alt icon-large "></i></a></div></td>
                                    <td><div align="center"><a href="http://estia2.hua.gr:8080/xmlui/bitstream/id/'.$cw['irBitId'].'/" target="_blank" ><i class="icon-download icon-large "></i></a></div></td></tr>';
                            }
                            ?>
                        </table>

        </div>       
    </div>
    <hr>

</div> <!-- /container -->

