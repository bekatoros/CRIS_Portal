<div class="container">
    <?php
    foreach ($userdata as $ud) {

        //   print_r($ud);
        ?>   <?php }
    ?>
    <!-- Main hero unit for a primary marketing message or call to action -->
    <div class="hero-unit" align="center">
        <table align="center">
            <h3 >Δημόσιο Προφίλ Ερευνητή </h3>
            <p>
                <?php
                echo $ud['cuFamilyNames_el'] . ' ' . $ud['cuFirstNames_el']
                ?>
            </p>

        </table>
    </div>
<!--    <pre>
    //<?php // var_dump($this->session->all_userdata());      ?>
    </pre>-->
    <!-- Example row of columns -->
    <div class="row-fluid">
        <div class="span3"  align="right"  >
            <?php
            foreach ($photo as $cw) {
                $photopath = $cw['cuPhoto'];
            }
            ?>
            </br></br>

            <img id="mypic" name="mypic" type="image" onclick="showFileBrowser()"   width="200px" length="200px" src="<?php echo base_url() . 'userpic/' . $photopath; ?>"  >


            <?php
            $cvpath = $cv['cfCVDoc'];
            ?>

            <div align="right">           <h4> Βιογραφικό σημείωμα </h4>   
                <?php if (!empty($cv['cfCVDoc'])) {
                    ?>                         <a href="<?php echo base_url() . 'files/' . $cvpath; ?>" target='_blank' > Κατεβάστε το CV </a>
                <?php }
                ?>
                </br> 

            </div> 
        </div>


        <div class="span7"  >
            <div class="tabbable">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#pane1" data-toggle="tab">Προσ. Στοιχεία</a></li>
                    <li><a href="#pane5" data-toggle="tab">Θέσεις</a></li>
                    <li><a href="#pane2" data-toggle="tab">Ερ. Ενδιαφέροντα</a></li>    
                     <li><a href="#pane4" data-toggle="tab">Διδασκαλία</a></li>
                    <li><a href="#pane3" data-toggle="tab">Δημοσιεύσεις</a></li>
                   
                    
                </ul>
                <div class="tab-content">

                    <div id="pane1" class="tab-pane active"> <!--pane1-->    


                        <div align="center"> 
                            <h4> Στοιχεία </h4>    
                        </div>
                        <form class="form-horizontal"  method="post"  accept-charset="utf-8" action="<?php echo base_url() . 'index.php/member/updateProfile'; ?>">
                            <div class="control-group">

                                <label class="control-label" for="surname" id="lbl_surname">Ονοματεπώνυμο</label>
                                <div class="controls">
                                    <p class = "input-xlarge uneditable-input"   type="text" id="surname" name="surname" value=   >
                                        <?php    echo $ud['cuFamilyNames_el'] . ' ' . $ud['cuFirstNames_el'] ?>
                                    </p></div>
                            </div>
                            
                             <div class="control-group">
                                <label class="control-label" for="orgunit">Τμήμα</label>
                                <div class="controls">
                                    <p class = "input-xlarge uneditable-input" name="orgunit" class =""  id="orgunit">
                                        <?php
                                        $extra = '';
                                        foreach ($users_orgunit as $unit)
                                        {
                                            $orgid=$unit['cfOrg_UnitId'];
                                        }
                                        
                                        for ($i = 0; $i < count($orgunits); $i++) {
                                            if (($i + 1) == $orgid) {
                                             //   $extra = 'selected="selected"';
                                                   echo $orgunits[$i]['name'];
                                            } 
                                       
                                        }
                                        ?>

                                    </p> 
                                </div>
                            </div>

                            <div class="control-group">

                                <label class="control-label" for="www" id="lbl_name_other">E-mail</label>
                                <div class="controls">
                                    <p class = "input-xlarge  uneditable-input "   type="text" target="_blank" id="website" name="e-mail" > <a href='mailto:<?php
                                        echo $ud['cuEmail']
                                        ?>'> <?php
                                                                                                                                               echo $ud['cuEmail']
                                        ?></a></p>
                                </div>
                            </div>
                            <div class="control-group">

                                <label class="control-label" for="www" id="lbl_name_other">Προσ. Ιστοσελίδα</label>
                                <div class="controls">
                                    <p class = "input-xlarge  uneditable-input "   type="text" target="_blank" id="website" name="website"  ><a href='http://<?php
                                            echo $ud['cuWebsite']
                                        ?>' >
                                                                                                                                                    <?php
                                                                                                                                                    echo $ud['cuWebsite']
                                                                                                                                                    ?></a></p>
                                </div>
                            </div>
                            <div class="control-group">

                                <label class="control-label" for="telephone" id="lbl_name_other">Τηλ. Επικοινωνίας</label>
                                <div class="controls">
                                    <p class = "input-xlarge uneditable-input phone"   type="text" id="telephone" name="telephone" value=  >
                                        <a href="tel: <?php echo $ud['cuTelephone'] ?>">                               
                                            <?php
                                            echo $ud['cuTelephone']
                                            ?> </a>  </p>
                                </div>
                            </div>

                            <div class="control-group">

                                <label class="control-label" for="name_other" id="lbl_name_other">Στοιχ. Επικοινωνίας</label>
                                <div class="controls">
                                    <p class = "input-xlarge uneditable-input"  type="text" id="contact" name="contact" ><?php
                                            echo $ud['cuContact']
                                            ?></p>
                                </div>
                            </div>
                           

                           




                        </form>

                    </div> <!--pane1-->      

                    <div id="pane2" class="tab-pane" > <!--pane2-->  
                        <div align="center">  <h4> Ερευνητικά Ενδιαφέροντα </h4>     </div>
                        <table  align="center"  class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th align="center" >Όνομα</th>

<!--                                <th>Ημερ. Έναρξης</th>
  <th>Ημερ. Λήξης</th>
  <th>Τρέχουσα</th>-->
                                </tr>
                            </thead>
                            <?php
                            foreach ($research as $cw) {
                                echo '<tr><td text-align="center">' . $cw['cuName'] . '</td>';
                                echo '</tr>';
                            }
                            ?>

                        </table>




                    </div><!--pane2-->  

                    <div id="pane3" class="tab-pane" > <!--pane3-->
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


                    </div><!--pane3-->  
                    <div id="pane4" class="tab-pane" > <!--pane4-->  

                        <div align="center">  <h4> Διδακτική Δραστηριότητα </h4>     </div>
                        <table  align="center"  class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th  >Τίτλος Μαθήματος</th>

<!--                                <th>Ημερ. Έναρξης</th>
   <th>Ημερ. Λήξης</th>
   <th>Τρέχουσα</th>-->
                                </tr>
                            </thead>
                            <?php
                            foreach ($teaching as $cw) {
                                echo '<tr><td text-align="center">' . $cw['cuName'] . '</td>';

                                echo '</tr>';
                            }
                            ?>

                        </table>



                    </div><!--pane4-->  

                    <div id="pane5" class="tab-pane" > <!--pane4-->  
                        <div align="center">  <h4> Ιστορικό Θέσεων </h4>     </div>
                        <table  class="table table-striped table-bordered">
                            <thead>
                                <tr>

                                    <th>Θέση</th>
                                    <th width="15%">Ημερ. Έναρξης</th>
                                    <th width="15%">Ημερ. Λήξης</th>
                                    <th width="10%">Τρέχουσα</th>

                                </tr>
                            </thead>
                            <?php
                            //     var_dump($cowriters);
                            foreach ($currentposid as $cw) {
                                $cposid = $cw['cuCurrentPosId'];
                            }

                            foreach ($position as $cw) {
                                
                                if ($cw['cuPositionType'] == 5) {
                                    $position_name= $cw['cuExtra'];
                                } else {
                                       $position_name=$positionTypes[$cw['cuPositionType']]['type'];
                                }

                                echo '<tr><td>' . $position_name . '</td><td>' . convert_str_to_date_for_date_picker($cw['cuStartDate']) . '</td><td>' . convert_str_to_date_for_date_picker($cw['cuEndDate']) . '</td><td>';

                                if ($cw['cuPositionId'] == $cposid) {
                                    echo "<div align='center'> <i class='icon-star icon-black icon-large'></i></div>";
                                } else {

                                    echo "<div align='center'> <i size='10px' class='icon-star-empty icon-black icon-large'></i></a></div>";
                                }


                                echo '</tr>';
                            }
                            ?>

                        </table>



                        </form>
                    </div><!--pane5--> 
                </div>  <!--tabbed content-->

            </div><!-- /.tabbable -->      
        </div>
        <div class="span3" >

        </div>
    </div>

    <hr>



</div> <!-- /container -->

