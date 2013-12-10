
<div id="container">
    <!--<h1>Πύλη Ερευνητικής Δραστηριότητας Χαροκοπείου Πανεπιστημίου</h1>-->

    <div id="body">
        <div class="container">
          <div class="hero-unit" align="center">
            <table align="center">
                <h4 >Τμήμα <?php  
                  foreach ($depname as $cw) {
                   echo $cw['cuName_el'];
                  }

                ?></h3>
          
            </table>
        </div>
            
            <div class="span3"   >
               <?php 
                if ($this->crisuser->is_logged_in()) {
                 ?>           <form class="form-horizontal"  method="post"  accept-charset="utf-8" action="<?php echo base_url() . 'index.php/member/searchrepository'; ?>">

                                        <input type="text" id="reposearch" name="reposearch" placeholder='Αναζήτηση στο αποθετήριο'  >
                                        <button type="submit" class="btn" id="submit_button">Αναζήτηση</button>
                           
                            </form>
            <?php }   ?>
            </div>
            <div class="span6"  >
              
                  <table  class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Όνοματεπώνυμο</th>
                           <th width='15%' >Καταχωρημένες Δημοσιεύσεις </th>
                                <!--<th>Κάτι άλλο...</th>-->
                              
                            </tr>
                        </thead>
                        <?php                  
                  //       print_r($users);
                        foreach ($fulldata as $cw) {
                            
                            echo '<tr><td><a href="'.base_url() . 'index.php/public_c/showperson/'.$cw['cfPersId'].'" >'.$cw['cuFamilyNames_el'].', '. $cw['cuFirstNames_el'].'</a></td><td>'. $cw['publ'].'</td></tr>';
                  
                        }
                        ?>
                        <tr>
                                <td>Σύνολο</td>
                           <!--<td>    </td>-->
                                <td>    <?php print_r($publ);?></td>
                              
                            </tr>
                    </table>
            </div>
            <div class="span3" >

            </div>
        </div>

        <hr>

            
         
        </div>

    </div>

<!--    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>-->
</div>
