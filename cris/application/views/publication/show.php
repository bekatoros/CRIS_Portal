

<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<script>
    // Javascript to enable link to tab
    window.onload = function()
    { 
        var hash = document.location.hash;
        var prefix = "tab_";
        if (hash) {
            $('.nav-tabs a[href='+hash.replace(prefix,"")+']').tab('show');
        } 

        // Change hash for page-reload
        $('.nav-tabs a').on('shown', function (e) {
            window.location.hash = e.target.hash.replace("#", "#" + prefix);
        });
        
    }
    
    $(function() {
        $("#startDate").datepicker({dateFormat: "dd-mm-yy"});
      

    });
</script>

<div class="container">

    <!-- Main hero unit for a primary marketing message or call to action -->
    <div class="hero-unit" align="center">
        <table align="center">
            <h3 >Δημοσίευση</h3>

        </table>
    </div>

    <!-- Example row of columns -->
    <div class="row-fluid">
        <div class="span3"   >

            <form class="form-horizontal"  method="post"  accept-charset="utf-8" action="<?php echo base_url() . 'index.php/member/searchrepository'; ?>">

                <input class="input" type="text" id="reposearch" name="reposearch" placeholder='Αναζήτηση στο αποθετήριο'  >
                <button type="submit" class="btn" id="submit_button">Αναζήτηση</button>

            </form>

        </div>
        <div class="span8"  >
            <?php
            $uneditclass = 'class = "input-xlarge uneditable-input" disabled ';
            $owner = false;
            $pubid = $this->uri->segment(3);
            //    print_r($publication);


            if (!empty($writer)) {

                $owner = TRUE;
                $uneditclass = ' class = "input-xlarge"';
            } else {
                //      echo   'den eisai melos';
            }
            ?>



            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#pane1" data-toggle="tab">Στοιχεία</a></li>
                    <li><a href="#pane2" data-toggle="tab">Συγγραφείς</a></li>
                    <?php if ($this->session->userdata('cris') === '1') { ?>
                        <li><a href="#pane3" data-toggle="tab">Έργα</a></li>
                    <?php }
                    ?>
                    <li><a href="#pane4" data-toggle="tab">Μεταδεδομένα</a></li>
                    <li><a href="#pane5" data-toggle="tab">Έγγραφο</a></li>
                </ul>
                <div class="tab-content">

                    <div id="pane1" class="tab-pane active">
                        <div align="center">   <h4> Στοιχεία </h4></div>
                        <?php
//@todo prepei na ginei edit form opws kai sto profile an o xrhsths einai idiokthths
                        foreach ($publication as $cw) {

                            $bitid = $cw['irBitId'];
                            ?>


                            <form class="form-horizontal"    accept-charset="utf-8" method="post" action="<?php echo base_url() . 'index.php/publication/update/' . $pubid . '#tab_pane1';
                        ;
                            ?>">

                                <div class="control-group">

                                    <label class="control-label" for="fTitle" id="lbl_surname">Τίτλος σε κύρια γλώσσα</label>
                                    <div class="controls">
                                        <input  <?php echo $uneditclass; ?>  type="text" id="fTitle" name="fTitle" value='<?php echo $cw['cfTitle'] ?>' required>
                                    </div>
                                </div>

                                <div class="control-group">

                                    <label class="control-label" for="fTitle_sec" id="lbl_name">Τίτλος σε άλλη γλώσσα</label>
                                    <div class="controls">
                                        <input <?php echo $uneditclass; ?>  type="text" id="fTitle_sec" name="fTitle_sec"  value='<?php echo $cw['cuTitle_sec'] ?>'>
                                    </div>
                                </div>

                                <div class="control-group">

                                    <label class="control-label" for="uri" id="lbl_surname_other">URI</label>
                                    <div class="controls">
                                        <input <?php echo $uneditclass; ?>  type="text" id="projcode" name="uri"   value='<?php echo $cw['cfURI'] ?>'  >

                                    </div>  
                                </div>

                                <div class="control-group">

                                    <label class="control-label" for="startDate" id="lbl_name_other">Ημερ. Δημοσίευσης</label>
                                    <div class="controls">
                                        <input <?php echo $uneditclass; ?>  type="text" id="startDate" name="startDate" data-date-format="dd-mm-yyyy" value=  <?php echo convert_str_to_date_for_date_picker($cw['cfResPubDate']) ?>>
                                    </div>
                                </div>

                                <div class="control-group">

                                    <label class="control-label" for="citation" id="lbl_name_other">Βιβλιογραφική Αναφορά</label>
                                    <div class="controls">
                                        <input <?php echo $uneditclass; ?>  type="text" id="citation" name="citation"  value=  '<?php echo $cw['irCitation'] ?>'>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label  class="control-label" id='pubTypelabel' name='pubTypelabel'   >Τύπος δημοσίευσης</label>
                                    <div  class="controls"> <select id='pubType' name='pubType'>

                                            <?php
                                            $extra = '';
                                            $pta = $this->config->item('pubtypes');        //   echo $md[1]['name'].$md[1]['schema'].$md[1]['element'].$md[1]['qualifier'].$md[1]['language'].$md[1]['required'].$md[1]['pair'] ;
                                            foreach ($pta as $key => $pt) {
                                                if ($key == $cw['cuPubType']) {
                                                    $extra = 'selected="selected"';
                                                } else {
                                                    $extra = '';
                                                }

                                                echo '<option value="' . $key . '"  ' . $extra . ' >' . $pt['type'] . '</option>';
                                            }
                                            ?>                         
                                        </select></div>
                                </div>


                                <?php
                                if ($owner) {
                                    ?>              <div class="control-group">
                                        <div class="controls">            
                                            <button type="submit" class="btn" id="submit_button">Υποβολή Αλλαγών</button>
                                        </div>
                                    </div>
                            <?php } ?>                  
                            </form>
                        <?php }
                        ?>
                    </div><!--pane1-->
                    <div id="pane2" class="tab-pane">

                        <div align="center"> 
                            <h4> Συγγραφείς </h4>

                            <table  class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Όνομα</th>
                                        <th>Επώνυμο</th>
                                        <th class="email">E-mail</th>
                                        <th colspan="2" >  Αλλαγή σειράς</th>
                                    </tr>
                                </thead>
                                <?php
//     var_dump($cowriters);

                                foreach ($cowriter as $key => $cw) {
                                    echo '<tr><td>' . $cw['cuFirstNames_el'] . '</td><td>' . $cw['cuFamilyNames_el'] . '</td><td>' . $cw['cuEmail'] . '</td>';
                                    echo '<td>';
                                    if ($key > 0) {

                                        echo '<div align="center"> <a  href="' . base_url() . 'index.php/publication/up_one/' . $pubid . '/' . $key . '#tab_pane2"><i class=" icon-arrow-up" ></i></a></div>';
                                    } echo '</td>';

                                    echo '<td>';
                                    if ($key != sizeof($cowriter) - 1) {
                                        echo' <div align="center"> <a  href="' . base_url() . 'index.php/publication/down_one/' . $pubid . '/' . $key . '#tab_pane2"><i class=" icon-arrow-down" ></i></a></div>';
                                    }
                                    echo '</td></tr>';
                                }
                                ?>
                            </table>
                            <?php
                            if ($owner) {
                                ?>     
                                <form  class="form-inline" method="post" action="<?php echo base_url() . 'index.php/publication/addcowriter/' . $pubid . '#tab_pane2'; ?>">

                                    <select class="input-large" id="userid" name="userid" >
                                        <option selected></option>
                                        <?php
                                        foreach ($suggest as $user) {
                                            echo '<option value="' . $user['cfPersId'] . '" >' . $user['cuFamilyNames_el'] . " " . $user['cuFirstNames_el'] . '</option>';
                                        }
                                        ?>
                                    </select>

                                    <button type="submit" class="btn">Προσθήκη</button>
                                </form>
                                <?php
                            }
                            ?>     </div>

                    </div><!--pane2-->
<?php if ($this->session->userdata('cris') === '1') { ?>
                        <div id="pane3" class="tab-pane"><!--pane3--> 

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
                                <?php
                                if ($owner) {
                                    ?>  
                                    <form  class="form-inline" method="post" action="<?php echo base_url() . 'index.php/publication/addproj/' . $pubid . '#tab_pane3'; ?>">

                                        <select class="input-large" id="projid" name="projid" >
                                            <option selected></option>
                                            <?php
                                            foreach ($userproj as $org) {
                                                echo '<option value="' . $org['cfProjId'] . '" >' . $org['cuTitle_el'] . " " . $org['cfTitle'] . '</option>';
                                            }
                                            ?>
                                        </select>

                                        <button type="submit" class="btn">Προσθήκη</button>
                                    </form>
                                <?php }
                                ?>
                            </div>


                        </div><!--pane3--> 
                    <?php }
                    ?>
                    <div id="pane4" class="tab-pane"> <!--pane4--> 

                        <div align="center"> 
                            <h4> Μεταδεδομένα </h4>

                            <form class="form-horizontal"    accept-charset="utf-8" method="post" action="<?php echo base_url() . 'index.php/publication/update_meta/' . $pubid . '#tab_pane4';
                    ;
                    ?>">


                                <div class="control-group">

                                    <label class="control-label" for="citation" id="lbl_name_other">Περίληψη στη Πρωτότυπη γλώσσα</label>
                                    <div class="controls">
                                        <textarea rows="5" id="abstract_en" name="abstract_en"  ><?php echo $admeta['1'] ?></textarea>
                                    </div>
                                </div>
                                <div class="control-group">

                                    <label class="control-label" for="citation" id="lbl_name_other">Περίληψη στα Ελληνικά</label>
                                    <div class="controls">
                                        <textarea rows="5" id="abstract_el" name="abstract_el"  ><?php echo $admeta['2']; ?></textarea>
                                    </div>
                                </div>

                                <div class="control-group">

                                    <label class="control-label" for="subject_en" id="lbl_name_other">Θέμα στα Αγγλικά</label>
                                    <div class="controls">
                                        <input  <?php echo $uneditclass; ?>  type="text" id="subject_en" name="subject_en" value='<?php echo $subjects['1'] ?>' >
                                    </div>
                                </div>
                                <div class="control-group">

                                    <label class="control-label" for="subject_el" id="lbl_name_other">Θέμα στα Ελληνικά</label>
                                    <div class="controls">
                                        <input  <?php echo $uneditclass; ?>  type="text" id="subject_el" name="subject_el" value='<?php echo $subjects['2'] ?>' >
                                    </div>
                                </div>


                                <?php
                                if ($owner) {
                                    ?>              <div class="control-group">
                                        <div class="controls">            
                                            <button type="submit" class="btn" id="submit_button">Αλλαγή Μεταδεδομένων</button>
                                        </div>
                                    </div>
<?php } ?>                  
                            </form>



                        </div>
                        <script type="text/javascript">
                            jQuery(document).ready(function($){
                                $('#subject_en').autocomplete(
                                {
                                    source:'<?php echo base_url() . 'index.php/member/searchInterest'; ?>',
                                    minLength:1}
                            );
                
                
                
                            });
                            jQuery(document).ready(function($){
                                $('#subject_el').autocomplete(
                                {
                                    source:'<?php echo base_url() . 'index.php/member/searchInterest'; ?>',
                                    minLength:1}
                            );
                
                
                
                            });
                        </script>


                    </div> <!--pane4-->

                    <div id="pane5" class="tab-pane"> <!--pane5-->

                        <div align="center"> 
                            <h4> Έγγραφο </h4>
                            <a href="http://estia2.hua.gr:8080/xmlui/bitstream/id/<?php echo $bitid ?>/" target='_blank'> Κατεβάστε το έγγραφο</a>
                            </br>
                                                   <!--<span class="btn btn-file">Upload<input type="file" /></span>-->
                            <form id='upload' action='<?php echo base_url() . 'index.php/publication/replace_file/' . $pubid; ?>' method='post' enctype='multipart/form-data'>
                                                                 <!--<input type='hidden' id='sub_id' name='sub_id' value='<?php echo $userid ?>' />-->
                                <div><label for='fileselect'>Επιλογή αρχείου:</label> 
                                    <INPUT type='file' name='fileToUpload' id='fileToUpload' onchange='fileSelected();' /> </div>
                                <div id='prbar'></div>
                                <div id='fileSize'></div></br>
                                <input class='btn' type='button' id='bt1' onclick='uploadFile()' value='Αντικατάσταση Δημοσίευσης' /> </form> 


                        </div>


                    </div> <!--pane5-->

                </div>  <!--tabbed content-->
            </div><!-- /.tabbable -->
        </div>

    </div>
    <div class="span1" >

    </div>
</div>

<hr>



</div> <!-- /container -->

<script type="text/javascript">

    function fileSelected() {
        var file = document.getElementById('fileToUpload').files[0];
        if (file) {
            var fileSize = 0;
            if (file.size > 1024 * 1024)
                fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
            else
                fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';
  
            //document.getElementById('fileName').innerHTML = 'Όνομα : ' + file.name;
            document.getElementById('fileSize').innerHTML = 'Μέγεθος : ' + fileSize;
            // document.getElementById('fileType').innerHTML = 'Τύπος : ' + file.type;
        
        }
    }

    function uploadFile() {
        var fd = new FormData();
        fd.append("fileToUpload", document.getElementById('fileToUpload').files[0]);
        //  fd.append("sub_id", document.getElementById('sub_id').value);
        var xhr = new XMLHttpRequest();
        xhr.upload.addEventListener("progress", uploadProgress, false);
        xhr.addEventListener("load", uploadComplete, false);
        xhr.addEventListener("error", uploadFailed, false);
        xhr.addEventListener("abort", uploadCanceled, false);
        xhr.open("POST", "<?php echo base_url() . 'index.php/publication/replace_file/' . $pubid; ?>");
        lb=document.createElement('label');
        lb.innerHTML='Πρόοδος ανεβάσματος : ';
        document.getElementById('prbar').appendChild(lb);
        pr=document.createElement('progress');
        //pr.setIdAttribute('pr', true);
        pr.id='pr';
        pr.setAttribute('max','100');
        pr.setAttribute('value','0');
        document.getElementById('prbar').appendChild(pr);
        document.getElementById('bt1').style.visibility="hidden";

        xhr.send(fd);
    }

    function uploadProgress(evt) {
        if (evt.lengthComputable) {
            var percentComplete = Math.round(evt.loaded * 100 / evt.total);
            // document.getElementById('progressNumber').innerHTML = percentComplete.toString() + '%';
            document.getElementById('pr').setAttribute('value', percentComplete.toString());
          
        }
        else {
            document.getElementById('progressNumber').innerHTML = 'unable to compute';
        }
    }

    function uploadComplete(evt) {
        location.href = '<?php echo base_url() . 'index.php/publication/show/' . $pubid; ?>';
        /* This event is raised when the server send back a response */
        // alert(evt.target.responseText);
    }

    function uploadFailed(evt) {
        document.getElementById('bt1').style.visibility="visible";
        alert("There was an error attempting to upload the file."+evt.target.responseText);
    }

    function uploadCanceled(evt) {
        document.getElementById('bt1').style.visibility="visible";
        alert("The upload has been canceled by the user or the browser dropped the connection.");
    }
    


</script>