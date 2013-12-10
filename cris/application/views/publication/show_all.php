<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



?>
<div class="container">

        <!-- Main hero unit for a primary marketing message or call to action -->
        <div class="hero-unit" align="center">
            <table align="center">
                <h4 >Εμφάνιση όλων των Δημοσιεύσεις</h3>
          
            </table>
        </div>

        <!-- Example row of columns -->
        <div class="row-fluid">
            <div class="span3"   >
                 <?php 
                if ($this->crisuser->is_logged_in()) {
                 ?>    
                            <form class="form-horizontal"  method="post"  accept-charset="utf-8" action="<?php echo base_url() . 'index.php/member/searchrepository'; ?>">

                                        <input type="text" id="reposearch" name="reposearch" placeholder='Αναζήτηση στο αποθετήριο'  >
                                        <button type="submit" class="btn" id="submit_button">Αναζήτηση</button>
                           
                            </form>
                   <?php }   ?>    
            </div>
            <div class="span6"  >
              
                  <table  class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Τίτλος σε κύρια γλώσσα</th>
                                <th>Τίτλος στα Ελληνικά</th>
                                <!--<th>Ημερ.</th>-->
                              
                            </tr>
                        </thead>
                        <?php                  
                        foreach ($publication as $cw) {
                            echo '<tr><td><a href="'.base_url() . 'index.php/publication/show/'.$cw['cfResPublid'].'" >'.$cw['cfTitle']. '</a></td><td><a href="'.base_url() . 'index.php/publication/show/'.$cw['cfResPublid'].'" >'.$cw['cuTitle_sec']. '</a></td>';
//                       echo '<td>'.convert_str_to_date_for_date_picker($cw['cfResPubDate']).'</td>' ;  
                              echo  '</tr>';
                        }
                        ?>
                    </table>
            </div>
            <div class="span3" >

            </div>
        </div>

        <hr>



    </div> <!-- /container -->