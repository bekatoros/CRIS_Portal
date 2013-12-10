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
                <h4 >Εμφάνιση όλων των Έργων</h3>
          
            </table>
        </div>

        <!-- Example row of columns -->
        <div class="row-fluid">
            <div class="span3"   >
                
                            <form class="form-horizontal"  method="post"  accept-charset="utf-8" action="<?php echo base_url() . 'index.php/member/searchrepository'; ?>">

                                        <input type="text" id="reposearch" name="reposearch" placeholder='Αναζήτηση στο αποθετήριο'  >
                                        <button type="submit" class="btn" id="submit_button">Αναζήτηση</button>
                           
                            </form>
                    
            </div>
            <div class="span6"  >
              
                  <table  class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Όνομα Αγγλικά</th>
                                <th>Όνομα Ελληνικά</th>
                                <th>Κωδ. έργου</th>
                              
                            </tr>
                        </thead>
                        <?php
                  //     var_dump($project);
                        foreach ($project as $cw) {
                            echo '<tr><td><a href="'.base_url() . 'index.php/project/show/'.$cw['cfProjId'].'" >'.$cw['cfTitle']. '</a></td><td><a href="'.base_url() . 'index.php/project/show/'.$cw['cfProjId'].'" >'.$cw['cuTitle_el']. '</a></td>';
                            echo '<td>'.$cw['cuProjCode']. '</td></tr>';
                        }
                        ?>
                    </table>
            </div>
            <div class="span3" >

            </div>
        </div>

        <hr>



    </div> <!-- /container -->