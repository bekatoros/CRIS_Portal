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
                <h4 >Εμφάνιση όλων των Χρηματοδοτήσεων</h3>
          
            </table>
        </div>

        <!-- Example row of columns -->
        <div class="row-fluid">
            <div class="span3"   >
            </div>
            <div class="span6"  >
              
                  <table  class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Όνομα Αγγλικά</th>
                                <th>Όνομα Ελληνικά</th>
                                <th>Ποσό</th>
                              
                            </tr>
                        </thead>
                        <?php
               
                        foreach ($fund as $cw) {                            
                            echo '<tr><td><a href="'.base_url() . 'index.php/fund/show/'.$cw['cfFundId'].'" >'.$cw['cfName']. '</a></td><td><a href="'.base_url() . 'index.php/fund/show/'.$cw['cfFundId'].'" >'.$cw['cuName_el']. '</a></td>';
                            echo '<td>'.$cw['cfAmount']. '</td></tr>';
                        }
                        ?>
                    </table>
            </div>
            <div class="span3" >

            </div>
        </div>

        <hr>



    </div> <!-- /container -->