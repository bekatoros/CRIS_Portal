<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<script>
    $(function() {
        $("#startDate").datepicker({dateFormat: "dd-mm-yy"});
      

    });
</script>

<div class="container">
    <?php
           

            foreach ($publication as $cw) {
                
                 $bitid=$cw['irBitId'];
              
                }
?>

        <!-- Main hero unit for a primary marketing message or call to action -->
        <div class="hero-unit" align="center">
            <table align="center">
                <h3 >Δημοσίευση με τίτλο</h3>
                <p><?php echo $cw['cfTitle'] ?> </p>
          
            </table>
        </div>

        <!-- Example row of columns -->
        <div class="row-fluid">
            <div class="span3"   >
            </div>
            <div class="span6"  >
               <?php
                $uneditclass  ='class = "input-xlarge uneditable-input"  ';
               $owner = false;
              $pubid = $this->uri->segment(3);
         //    print_r($publication);
             
             
               if (!empty($writer)){
                  
                       $owner = TRUE;
                 $uneditclass  = ' class = "input-xlarge"';
               }else
               {
          //      echo   'den eisai melos';
               }
            ?>
                
<!--        
                
                   <div class="tabbable">
  <ul class="nav nav-tabs">-->
<!--    <li class="active"><a href="#pane1" data-toggle="tab">Στοιχεία</a></li>
    <li><a href="#pane2" data-toggle="tab">Συγγραφείς</a></li>-->
     <?php if ($this->session->userdata('cris') === '1') { ?>
    <!--<li><a href="#pane3" data-toggle="tab">Έργα</a></li>-->
      <?php }
                            ?>
<!--    <li><a href="#pane4" data-toggle="tab">Μεταδεδομένα</a></li>
    <li><a href="#pane5" data-toggle="tab">Έγγραφο</a></li>
  </ul>
<div class="tab-content">-->
    
<!--    <div id="pane1" class="tab-pane active">
          <div align="center">   <h4> Στοιχεία </h4></div>
         
                <form class="form-horizontal"    accept-charset="utf-8"  >
                    
                    <div class="control-group">

                        <label class="control-label" for="fTitle" id="lbl_surname">Τίτλος σε κύρια γλώσσα</label>
                        <div class="controls">
                              <p class = "input-xlarge uneditable-input"    ><?php echo $cw['cfTitle'] ?></p>
                        </div>
                    </div>

                    <div class="control-group">

                        <label class="control-label" for="fTitle_sec" id="lbl_name">Τίτλος σε άλλη γλώσσα</label>
                        <div class="controls">
                            <p class = "input-xlarge uneditable-input" type="text" id="fTitle_sec" name="fTitle_sec"  ><?php echo $cw['cuTitle_sec'] ?></p>
                        </div>
                    </div>

                    <div class="control-group">

                        <label class="control-label" for="uri" id="lbl_surname_other">URI</label>
                        <div class="controls">
                               <p class = "input-xlarge uneditable-input" type="text" id="projcode" name="uri" /> <?php echo $cw['cfURI'] ?></p>

                        </div>  
                    </div>

                    <div class="control-group">

                        <label class="control-label" for="startDate" id="lbl_name_other">Ημερ. Δημοσίευσης</label>
                        <div class="controls">
                             <p class = "input-xlarge uneditable-input" >   <?php echo convert_str_to_date_for_date_picker($cw['cfResPubDate']) ?></p>
                        </div>
                    </div>
                    
                      <div class="control-group">

                        <label class="control-label" for="citation" id="lbl_name_other">Βιβλιογραφική Αναφορά</label>
                        <div class="controls">
                             <p class = "input-xlarge uneditable-input" type="text" id="citation" name="citation"  >
                                 <?php echo $cw['irCitation'] ?> </p>
                        </div>
                    </div>
                   </form>

                 
             

        </div>pane1
          <div id="pane2" class="tab-pane">
         
                <div align="center"> 
                    <h4> Συγγραφείς </h4>

                    <table  class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Ονοματεπώνυμο</th>
                                <th class="email">E-mail</th>
                            </tr>
                        </thead>
                        <?php
                        //     var_dump($cowriters);
                        foreach ($cowriter as $cw) {
                            echo '<tr><td><a href="'.base_url() . 'index.php/public_c/showperson/'.$cw['cfPersId'].'">' . $cw['cuFamilyNames_el'] . ', ' . $cw['cuFirstNames_el'] . '</a></td><td>' . $cw['cuEmail'] . '</td>';
                    
                            }
                        ?>
                    </table>
     </div>
              
              </div>pane2
           
 <div id="pane3" class="tab-pane">pane3 
            
                <div align="center"> 
                    <h4> Έργα </h4>

                    <table  class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Όνομα στα Ελληνικά</th>
                                <th>Όνομα στα Αγγλικά</th>

                            </tr>
                        </thead>
                        <?php
                        foreach ($projects as $cw) {
                            echo '<tr><td>' . $cw['cuTitle_el'] . '</td><td>' . $cw['cfTitle'] . '</td>';
                        }
                        ?>
                    </table>

    </div>
          
    
</div>pane3 

              
                      -->
        <!--<div id="pane4" class="tab-pane"> pane4--> 
            
                <div align="center"> 
                    <h4> Μεταδεδομένα </h4>

                    <form class="form-horizontal"    accept-charset="utf-8" method="post" action="<?php echo base_url() . 'index.php/publication/update_meta/'. $pubid; ; ?>">
                    
                    
                    <div class="control-group">

                        <label class="control-label" for="citation" id="lbl_name_other">Περίληψη στα Αγγλικά</label>
                        <div class="controls">
                           <p align="justify"  class="uneditable-textarea "    >
                                       <?php echo $admeta['1']; ?>
                                    </p>
                        </div>
                    </div>
                      <div class="control-group">

                        <label class="control-label" for="citation" id="lbl_name_other">Περίληψη στα Ελληνικά</label>
                        <div class="controls">
                          <p align="justify"  class="uneditable-textarea "    >
                                       <?php echo $admeta['2']; ?>
                                    </p>
                            
                            <!--<textarea <?php echo $uneditclass; ?> rows="5" id="abstract_el" name="abstract_el"  ></textarea>-->
                        </div>
                    </div>
                        
                          <div class="control-group">

                        <label class="control-label" for="subject_en" id="lbl_name_other">Θέμα στα Αγγλικά</label>
                        <div class="controls">
                             <p class = "input-xlarge uneditable-input"    ><?php echo $subjects['1'] ?>     </p>
                        </div>
                    </div>
                      <div class="control-group">

                        <label class="control-label" for="subject_el" id="lbl_name_other">Θέμα στα Ελληνικά</label>
                        <div class="controls">
                             <p class = "input-xlarge uneditable-input"    ><?php echo $subjects['2'] ?>      </p>
                        </div>
                    </div>
                   
                 
                </form>

                    
                    
    </div>
          
    
<!--</div> pane4-->
<!--      
 <div id="pane5" class="tab-pane"> pane5
            
                <div align="center"> 
                    <h4> Έγγραφο </h4>
 <a href="http://estia2.hua.gr:8080/xmlui/bitstream/id/<?php echo $bitid ?>/" target="_blank" > Κατεβάστε το έγγραφο</a>
 </br>

                                         
                    
    </div>
          
    
</div> pane5-->

<!--</div>  tabbed content
          </div> /.tabbable -->
        </div>
                
            </div>
            <div class="span3" >

            </div>
        </div>

        <hr>



    </div> <!-- /container -->
  