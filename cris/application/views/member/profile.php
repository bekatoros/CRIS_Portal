<script>
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
        $("#startDate").keypress(function(event) {
            event.preventDefault();
        });
        $("#endDate").datepicker({dateFormat: "dd-mm-yy"});
        $("#endDate").keypress(function(event) {
            event.preventDefault();
        });

    });
</script>
<div class="container">

    <!-- Main hero unit for a primary marketing message or call to action -->
    <div class="hero-unit" align="center">
        <table align="center">
            <h3 >Επεξεργασία Προφίλ</h3>
            <p >Επεξεργαστείτε το προφίλ σας και ενεργοποιήστε το σύστημα CRIS</p>
        </table>
    </div>
<!--    <pre>
    //<?php // var_dump($this->session->all_userdata());         ?>
    </pre>-->
    <!-- Example row of columns -->
    <div class="row-fluid">
        <div class="span3"  align="center"  >
            <?php
            foreach ($photo as $cw) {
                $photopath = $cw['cuPhoto'];
            }
            ?>
            </br></br>
            <?php if ($this->session->userdata('cris') === '1') { ?>
                <img id="mypic" name="mypic" type="image" onclick="showFileBrowser()"   width="200px" length="200px" src="<?php echo base_url() . 'userpic/' . $photopath; ?>"  >

                <form id='upload' action='<?php echo base_url() . 'index.php/member/profile/' . $this->session->userdata['userid']; ?>' method='post' enctype='multipart/form-data'>
                                                                  <!--<input type='hidden' id='sub_id' name='sub_id' value='<?php echo $userid ?>' />-->

                    <INPUT type='file' name='picToUpload' id='picToUpload'  /> 

                    <input class='btn' type='button' value="Αλλαγή Φωτογραφίας" id='bt1' onclick='uploadPic()'     />
                </form> 
               <div align="justify"> Αν θέλετε να εμφανίζονται οι δημοσιεύσεις στο προσωπικό ιστοτοπό σας 
                αντιγράψτε το παρακάτω σε μια σελίδα.
               </div>
                   <code>&lt;iframe src="<?php echo base_url()  ?> </br>index.php/public_c/iframe/  <?php echo $this->session->userdata['userid']; ?>" </br>width="100%" height="700" &gt;&lt;/iframe&gt;
                    </code>

  <?php }
            ?>
                
                
                
        </div>


        <div class="span7"  >

            <?php
            /* foreach ($message as $msg)
              {
              print_r($msg);
              } */


            //  print_r($message);
            if (isset($message) && !empty($message)) {
                echo '<div class="alert">';
                echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                //       echo '<strong>Warning!</strong><br/>';
                echo $message . '<br/>';
                echo '</div>';
            }
            ?>


            <div class="tabbable">
                <?php if ($this->session->userdata('cris') === '1') { ?>
                    <ul class="nav nav-tabs" id="myTab" >
                        <li class="active"><a href="#pane1" data-toggle="tab">Προσ. Στοιχεία</a></li>
                         <li><a href="#pane2" data-toggle="tab">Θέσεις</a></li>
                        <li><a href="#pane3" data-toggle="tab">Ερευνητικά Ενδιαφέροντα</a></li>    
                         <li><a href="#pane4" data-toggle="tab">Διδασκαλία</a></li>
                        <li><a href="#pane5" data-toggle="tab">CV</a></li>
                       
                       
                    </ul>
                    <div class="tab-content">

                        <div id="pane1" class="tab-pane active"> <!--pane1-->    
                        <?php }
                        ?>
                        <div align="center"> 
                            <h4> Στοιχεία </h4>    
                        </div>
                        <form class="form-horizontal"  method="post"  accept-charset="utf-8" action="<?php echo base_url() . 'index.php/member/updateProfile'.'#tab_pane1'; ?>">
                            <div class="control-group">
                                <?php if (form_error('surname')) { ?>
                                    <div class="alert alert-info">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Warning!</strong><?php echo form_error('surname'); ?>
                                    </div>                        
                                <?php } ?>
                                <label class="control-label" for="surname" id="lbl_surname">Επώνυμο</label>
                                <div class="controls">
                                    <input type="text" id="surname" name="surname" value=  <?php echo $this->session->userdata['surname'] ?> >
                                </div>
                            </div>

                            <div class="control-group">
                                <?php if (form_error('name')) { ?>                        
                                    <div class="alert alert-info">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Warning!</strong><?php echo form_error('name'); ?>
                                    </div>
                                <?php } ?>
                                <label class="control-label" for="name" id="lbl_name">Όνομα</label>
                                <div class="controls">
                                    <input type="text" id="name" name="name"  value=  <?php echo $this->session->userdata['name'] ?>>
                                </div>
                            </div>

                            <div class="control-group">
                                <?php if (form_error('surname_other')) { ?>            
                                    <div class="alert alert-info">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Warning!</strong><?php echo form_error('surname_other'); ?>
                                    </div>
                                <?php } ?>
                                <label class="control-label" for="surname_other" id="lbl_surname_other">Επώνυμο σε 2η γλώσσα</label>
                                <div class="controls">
                                    <input type="text" id="surname_other" name="surname_other"  value=<?php
                                if (isset($this->session->userdata['surname_other'])) {
                                    echo $this->session->userdata['surname_other'];
                                }
                                ?>>
                                </div>  
                            </div>

                            <div class="control-group">
                                <?php if (form_error('name_other')) { ?>  
                                    <div class="alert alert-info">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Warning!</strong><?php echo form_error('name_other'); ?>
                                    </div>
                                <?php } ?>
                                <label class="control-label" for="name_other" id="lbl_name_other">Όνομα σε 2η γλώσσα</label>
                                <div class="controls">
                                    <input type="text" id="name_other" name="name_other" value=  <?php
                                if (isset($this->session->userdata['name_other'])) {
                                    echo $this->session->userdata['name_other'];
                                }
                                ?>>
                                </div>
                            </div>

                            <div class="control-group">                             
                                <label class="control-label" for="website" id="lbl_name_other">Προσ. Ιστοσελίδα</label>
                                <div class="controls">
                                    <input type="text" id="website" name="website" value=  <?php
                                           if (isset($this->session->userdata['website'])) {
                                               echo $this->session->userdata['website'];
                                           }
                                ?>>
                                </div>
                            </div>
                            <div class="control-group">                                
                                <label class="control-label" for="telephone" id="lbl_name_other">Τηλέφωνο</label>
                                <div class="controls">
                                    <input type="text" id="telephone" name="telephone" value=  <?php
                                           if (isset($this->session->userdata['telephone'])) {
                                               echo $this->session->userdata['telephone'];
                                           }
                                ?>>
                                </div>
                            </div>

                            <div class="control-group">                         
                                <label class="control-label" for="contact" id="lbl_name_other">Στοιχ. Επικοινωνίας</label>
                                <div class="controls">
                                    <textarea type="text" id="contact" name="contact" ><?php
                                           if (isset($this->session->userdata['contact'])) {
                                               echo $this->session->userdata['contact'];
                                           }
                                ?></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="orgunit">Τμήμα</label>
                                <div class="controls">
                                    <select name="orgunit" class =""  id="orgunit">
                                        <?php
                                        $extra = '';
                                        for ($i = 0; $i < count($orgunits); $i++) {
                                            if (($i + 1) == $this->session->userdata['department']) {
                                                $extra = 'selected="selected"';
                                            } else {
                                                $extra = '';
                                            }
                                            echo "<option value =" . $orgunits[$i]['id'] . " " . $extra . ">";
                                            echo $orgunits[$i]['name'];
                                        }
                                        ?>

                                    </select> 
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="gender">Φύλο</label>
                                <div class="controls">
                                    <select name="gender" class =""  id="gender">
                                        <option value="0" <?php
                                        if (isset($this->session->userdata['gender'])) {
                                            if (0 == $this->session->userdata['gender']) {
                                                $extra = 'selected="selected"';
                                                echo $extra;
                                            }
                                        }
                                        ?> >Άνδρας</option>

                                        <option value="1"
                                        <?php
                                        if (isset($this->session->userdata['gender'])) {
                                            if (1 == $this->session->userdata['gender']) {
                                                $extra = 'selected="selected"';
                                                echo $extra;
                                            }
                                        }
                                        ?>

                                                >Γυναίκα </option>
                                    </select> 
                                </div>
                            </div>



                            <div class="control-group">
                                <div class="controls">            
                                    <button type="submit" class="btn" id="submit_button">Υποβολή Αλλαγών</button>
                                </div>
                            </div>

                            <?php
                            /*   if (isset($message) && !empty($message)) {

                              echo '<div class="alert alert-success">';
                              echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                              echo $message . '<br/>';
                              echo '</div>';
                              } */
                            ?>
                        </form>
                        <form class="form-horizontal"  method="post"  accept-charset="utf-8" action="<?php echo base_url() . 'index.php/member/cris'; ?>">
                            <div class="control-group">
                                <div class="controls">                                   
                                    <?php if (!$this->session->userdata('cris')) { ?>
                                        <button   type="submit" class="btn btn-primary  btn-danger"><i class="icon-plus-sign icon-white"></i>Ενεργοποίηση CRIS</button>                           
                                    <?php } else { ?>
                                        <button   type="submit" class="btn btn-primary  btn-success"><i class="icon-off icon-white"></i>Απενεργοποίηση CRIS</button>
                                    <?php } ?>
                                </div>
                            </div>

                        </form>
                    </div> <!--pane1-->      
                    <?php if ($this->session->userdata('cris') === '1') { ?>
                        <div id="pane3" class="tab-pane" > <!--pane2-->  
                            <div align="center">  <h4> Ερευνητικά Ενδιαφέροντα </h4>     </div>
                            <table  align="center"  class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="85%" >Όνομα</th>
                                        <th width="15%">Αφαίρεση</th>
        <!--                                <th>Ημερ. Έναρξης</th>
                                        <th>Ημερ. Λήξης</th>
                                        <th>Τρέχουσα</th>-->
                                    </tr>
                                </thead>
                                <?php
                                foreach ($research as $cw) {
                                    echo '<tr><td> 
                                        <a href="' . base_url() . 'index.php/member/searchrepository/' . $cw['cuName'] . '">' . $cw['cuName'] . '</a></td>';
                                    echo "<td>  <div align='center'> <a href='" . base_url() . "index.php/member/removeresearch/" . $cw['cuResearchId'] . "#tab_pane3'><i size='10px' class='icon-remove-sign icon-black icon-large'></i></a></div>
               </td>";
                                    echo '</tr>';
                                }
                                ?>

                            </table>

                            <script type="text/javascript">
                                jQuery(document).ready(function($){
                                    $('#area_name').autocomplete(
                                    {
                                        source:'<?php echo base_url() . 'index.php/member/searchInterest'; ?>',
                                        minLength:1}
                                );
                        
                        
                        
                                });


                                jQuery(document).ready(function($){
                                    $('#lesson_name').autocomplete(
                                    {
                                        source:'<?php echo base_url() . 'index.php/member/searchLesson'; ?>',
                                        minLength:1}
                                );
                        
                        
                        
                                });
                                /*             
                                $(document).ready(function() {  

                                    // Icon Click Focus
                                    $('div.icon').click(function(){
                                        $('input#area_name').focus();
                                    });

                                    // Live Search
                                    // On Search Submit and Get Results
                                    function search() {
                                        var query_value = $('input#area_name').val();
                                        $('b#search-string').html(query_value);
                                        if(query_value !== ''){
                                            $.ajax({
                                                type: "POST",
                                                url: "<?php echo base_url() . 'index.php/member/searchInterest'; ?>",
                                                data: { query: query_value },
                                                cache: false,
                                                success: function(html){
                                                    $("ul#results").html(html);
                                                }
                                            });
                                        }return false;    
                                    }

                                    $("input#area_name").live("keyup", function(e) {
                                        // Set Timeout
                                        clearTimeout($.data(this, 'timer'));

                                        // Set Search String
                                        var search_string = $(this).val();

                                        // Do Search
                                        if (search_string == '') {
                                            $("ul#results").fadeOut();
                                            $('h4#results-text').fadeOut();
                                        }else{
                                            $("ul#results").fadeIn();
                                            $('h4#results-text').fadeIn();
                                            $(this).data('timer', setTimeout(search, 100));
                                        };
                                    });

                                });*/
                            </script>                  
                            <h4 align='center' >Προσθήκη  Ερευνητικής Περιοχής</h4>
                            <form class="form-horizontal"  method="post"  accept-charset="utf-8" action="<?php echo base_url() . 'index.php/member/addResearch'.'#tab_pane3'; ?>">

                                <div class="control-group">

                                    <label class="control-label" for="name" id="lbl_name">Περιοχή</label>
                                    <div class="controls">
                                        <input type="text" id="area_name" name="area_name"  >
                                    </div>
                                </div>                                    



                                <div class="control-group">
                                    <div class="controls">            
                                        <button type="submit" class="btn" id="submit_button">Προσθήκη</button>
                                    </div>
                                </div>


                            </form>



                        </div><!--pane2-->  

                        <div id="pane5" class="tab-pane" > <!--pane3-->

                            <?php
                            $cvpath = $cv['cfCVDoc'];
                            ?>

                            <div align="center">           <h4> Βιογραφικό σημείωμα </h4>   
                                <?php if (!empty($cv['cfCVDoc'])) {
                                    ?>                         <a href="<?php echo base_url() . 'files/' . $cvpath; ?>" target='_blank' > Κατεβάστε το CV σας</a>
                                <?php }
                                ?>
                                </br> 


                                               <!--<span class="btn btn-file">Upload<input type="file" /></span>-->
                                <form id='upload' action='<?php echo base_url() . 'index.php/member/profile/' . $this->session->userdata['userid'].'#tab_pane5'; ?>' method='post' enctype='multipart/form-data'>
                                                                     <!--<input type='hidden' id='sub_id' name='sub_id' value='<?php echo $userid ?>' />-->
                                    <div><label for='fileselect'>Επιλογή αρχείου:</label> 
                                        <INPUT type='file' name='fileToUpload' id='fileToUpload' onchange='fileSelected();' /> </div>
                                    <div class="progress-bar" role="progressbar" id='prbar'></div>
                                    <div id='fileSize'></div>
                                    </br>
                                    <input class='btn' type='button' id='bt1' onclick='uploadFile()'                <?php if (!empty($cv['cfCVDoc'])) {
                                    ?>       value='Αντικατάσταση CV' 
                                           <?php } else {
                                               ?>
                                               value='Προσθήκη CV'
                                           <?php }
                                           ?>
                                           /> </form> 
                            </div> 

                        </div><!--pane3-->  
                        <div id="pane4" class="tab-pane" > <!--pane4-->  

                            <div align="center">  <h4> Διδακτική Δραστηριότητα </h4>     </div>
                            <table  align="center"  class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="85%" >Όνομα</th>
                                        <th width="15%">Αφαίρεση</th>
        <!--                                <th>Ημερ. Έναρξης</th>
                                        <th>Ημερ. Λήξης</th>
                                        <th>Τρέχουσα</th>-->
                                    </tr>
                                </thead>
                                <?php
                                foreach ($teaching as $cw) {
                                    echo '<tr><td>' . $cw['cuName'] . '</td>';
                                    echo "<td>                      <div align='center'> <a href='" . base_url() . "index.php/member/removelesson/" . $cw['cuLessonId'] . "#tab_pane4'><i size='10px' class='icon-remove-sign icon-black icon-large'></i></a></div>
               </td>";
                                    echo '</tr>';
                                }
                                ?>

                            </table>
                            <h4 align='center' >Προσθήκη Μαθήματος</h4>
                            <form class="form-horizontal"  method="post"  accept-charset="utf-8" action="<?php echo base_url() . 'index.php/member/addLesson'.'#tab_pane4'; ?>">

                                <div class="control-group">

                                    <label class="control-label" for="name" id="lbl_name">Όνομα Μαθήματος</label>
                                    <div class="controls">
                                        <input type="text" id="lesson_name" name="lesson_name"  >
                                    </div>
                                </div>                                    



                                <div class="control-group">
                                    <div class="controls">            
                                        <button type="submit" class="btn" id="submit_button">Προσθήκη Μαθήματος</button>
                                    </div>
                                </div>


                            </form>



                        </div><!--pane4-->  

                        <div id="pane2" class="tab-pane" > <!--pane4-->  
                            <div align="center">  <h4> Ιστορικό Θέσεων </h4>     </div>
                            <table  class="table table-striped table-bordered">
                                <thead>
                                    <tr>

                                        <th>Θέση</th>
                                        <th>Ημερ. Έναρξης</th>
                                        <th>Ημερ. Λήξης</th>
                                        <th width="10%">Τρέχουσα</th>
                                        <th width="10%">Αφαίρεση</th>
                                    </tr>
                                </thead>
                                <?php
                                //     var_dump($cowriters);
                                foreach ($currentposid as $cw) {
                                    $cposid = $cw['cuCurrentPosId'];
                                }

                                foreach ($position as $cw) {
                                    if ($cw['cuPositionType'] == 5) {
                                        $position_name = $cw['cuExtra'];
                                    } else {
                                        $position_name = $positionTypes[$cw['cuPositionType']]['type'];
                                    }

                                    echo '<tr><td>' . $position_name . '</td><td>' . convert_str_to_date_for_date_picker($cw['cuStartDate']) . '</td><td>' . convert_str_to_date_for_date_picker($cw['cuEndDate']) . '</td><td>';

                                    if ($cw['cuPositionId'] == $cposid) {
                                        echo "<div align='center'> <i class='icon-star icon-black icon-large'></i></div>";
                                    } else {

                                        echo "<div align='center'> <a href='" . base_url() . "index.php/member/setcurrent/" . $cw['cfPersId'] . "/" . $cw['cuPositionId'] .  "#tab_pane2"."'><i size='10px' class='icon-star-empty icon-black icon-large'></i></a></div>";
                                    }

                                    echo "<td> <div align='center'> <a href='" . base_url() . "index.php/member/removeposition/" . $cw['cuPositionId'] . "#tab_pane2". "'><i  class='icon-remove-sign icon-black icon-large'></i></a></div>
               </td>";
                                    echo '</tr>';
                                }
                                ?>

                            </table>

                            <h4 align='center' >Νέα Θέση</h4>
                            <form class="form-horizontal"  method="post"  accept-charset="utf-8" action="<?php echo base_url() . 'index.php/member/addPosition'.'#tab_pane2'; ?>">

                                <div class="control-group">
                                    <label class="control-label" for="position">Θέση</label>
                                    <div class="controls">
                                        <select name="position" class =""  id="position">                                          
                                            <?php
                                            $extra = '';
                                            foreach ($positionTypes as $key => $i) {

                                                echo "<option value =" . $key . ">";
                                                echo $i['type'];
                                            }
                                            ?>
                                        </select> 
                                    </div>
                                </div>


                                <div  id="extrainput" name="extrainput" >                    


                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="startDate" id="lbl_name_other">Ημερ. έναρξης</label>
                                    <div class="controls">
                                        <input <?php echo $uneditclass; ?>  type="text" id="startDate" name="startDate"  data-date-format="dd-mm-yyyy" value=  <?php echo convert_str_to_date_for_date_picker($cw['cfStartDate']) ?>>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    $("select[name=position]").change(function() {
                                        if ($(this).val() == '5') {
                                            $("#extrainput").append(' <div class="control-group"><label class="control-label" for="extra" id="extra">Περιγραφή</label>\n\
    <div class="controls"><input type="text" id="extra" name="extra"/></div>  </div>');
                                        }
                                    })

                                    $("select[name=position]").change(function() {
                                        if ($(this).val() != '5') {
                                            var myNode = document.getElementById("extrainput");
                                            myNode.innerHTML = '';
                                            /*  $("#extrainput"). .append(' <div class="control-group"><label class="control-label" for="extra" id="extra">Περιγραφή</label>\n\
    <div class="controls"><input type="text" id="extra" name="extra"/></div>  </div>');*/
                                        }
                                    })

                                </script>


                                <div class="control-group">                    
                                    <label class="control-label" for="endDate" id="lbl_name_other">Ημερ. λήξης</label>
                                    <div class="controls">
                                        <input <?php echo $uneditclass; ?>  type="text" id="endDate" name="endDate"  data-date-format="dd-mm-yyyy" value=  <?php echo convert_str_to_date_for_date_picker($cw['cfEndDate']) ?>>
                                    </div>
                                </div>



                                <div class="control-group">
                                    <div class="controls">            
                                        <button type="submit" class="btn" id="submit_button">Προσθήκη Θέσης</button>
                                    </div>
                                </div>

                                <?php
                                if (isset($message) && !empty($message)) {

                                    echo '<div class="alert alert-success">';
                                    echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                                    echo $message . '<br/>';
                                    echo '</div>';
                                }
                                ?>
                            </form>
                        </div><!--pane5--> 
                    </div>  <!--tabbed content-->
                <?php }
                ?>
            </div><!-- /.tabbable -->      
        </div>
        <div class="span3" >

        </div>
    </div>

    <hr>



</div> <!-- /container -->

<script type="text/javascript">


    $('#name').attr("disabled", true);

    $('#surname').attr("disabled", true);

    $('#name').focus(function() {
        $('#name').css('background-color', 'inherit');
        $('#lbl_name').text('Όνομα');
        $('#lbl_name').css('color', 'inherit');
    });

    $('#surname').focus(function() {
        $('#surname').css('background-color', 'inherit');
        $('#lbl_surname').text('Επώνυμο');
        $('#lbl_surname').css('color', 'inherit');
    });

    $('#name_other').focus(function() {
        $('#name_other').css('background-color', 'inherit');
        $('#lbl_name_other').text('Όνομα σε 2η γλώσσα');
        $('#lbl_name_other').css('color', 'inherit');
    });

    $('#surname_other').focus(function() {
        $('#surname_other').css('background-color', 'inherit');
        $('#lbl_surname_other').text('Επώνυμο σε 2η γλώσσα');
        $('#lbl_surname_other').css('color', 'inherit');
    });

    $('#submit_button').click(function() {

        //        $('#lb_reg_name').text('');

        var name = $('#name').val();
        var surname = $('#surname').val();
        var othername = $('#name_other').val();
        var othersurname = $('#surname_other').val();

        if (!surname || surname === '' || surname.length < 1) {
            $('#lbl_surname').css('color', 'red');
            $('#lbl_surname').text('Παρακαλώ εισάγετε το επώνυμό σας');
            $('#surname').css('background-color', '#FFC3C4');
            return false;
        }

        if (!name || name === '' || name.length < 1) {
            $('#lbl_name').css('color', 'red');
            $('#lbl_name').text('Παρακαλώ εισάγετε το όνομά σας');
            $('#name').css('background-color', '#FFC3C4');
            return false;
        }

        if (!othersurname || othersurname === '' || othersurname.length < 1) {
            $('#lbl_surname_other').css('color', 'red');
            $('#lbl_surname_other').text('Παρακαλώ εισάγετε το επώνυμό σας στη 2η γλώσσα');
            $('#surname_other').css('background-color', '#FFC3C4');
            return false;
        }

        if (!othername || othername === '' || othername.length < 1) {
            $('#lbl_name_other').css('color', 'red');
            $('#lbl_name_other').text('Παρακαλώ εισάγετε το όνομά σας στη 2η γλώσσα');
            $('#name_other').css('background-color', '#FFC3C4');
            return false;
        }


        //        var form_data = {
        //            name: $('#reg_name').val(),
        //            email: $('#reg_email').val(),
        //            password: $('#reg_pwd').val(),
        //            password_confirmation: $('#reg_retype_pwd').val(),
        //            ajax: '1'
        //        };

        //        $.ajax({
        //            url: "
        //            type: 'POST',
        //            data: form_data,
        //            success: function(msg) {
        //                var msgReturn = jQuery.parseJSON(msg);
        //                if (msgReturn.name)
        //                {
        //                    $('#lb_reg_name').text(msgReturn.name);
        //                }
        //
        //                if (msgReturn.email)
        //                {
        //                    $('#lb_reg_email').text(msgReturn.email);
        //                }
        //                if (msgReturn.password)
        //                {
        //                    $('#lb_reg_pwd').text(msgReturn.password);
        //                }
        //                if (msgReturn.password_confirmation)
        //                {
        //                    $('#lb_reg_retype_pwd').text(msgReturn.password_confirmation);
        //                }
        //                if (msgReturn.error)
        //                {
        //                    $('#lb_no_registration').text(msgReturn.error);
        //                    $('#registration_data_panel').hide();
        //                    $('#registration_data_error').show();
        //                    return false;
        //                }
        //                if (msgReturn.success)
        //                {
        //                    $('#registration_data_panel').hide();
        //                    $('#registration_data_success').show();
        //                    return true;
        //                }
        //            }
        //        });

        return true;
    });
  


</script>




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

    function uploadPic() {
        var fd = new FormData();
        fd.append("picToUpload", document.getElementById('picToUpload').files[0]);
        //  fd.append("sub_id", document.getElementById('sub_id').value);
        var xhr = new XMLHttpRequest();
        //        xhr.upload.addEventListener("progress", uploadProgress, false);
        xhr.addEventListener("load", uploadComplete, false);
        xhr.addEventListener("error", uploadFailed, false);
        //        xhr.addEventListener("abort", uploadCanceled, false);
        xhr.open("POST", "<?php echo base_url() . 'index.php/member/uploadPic/' . $this->session->userdata['userid']; ?>");
        //        lb = document.createElement('label');
        //        lb.innerHTML = 'Πρόοδος ανεβάσματος : ';
        //        document.getElementById('prbar').appendChild(lb);
        //        pr = document.createElement('progress');
        //        //pr.setIdAttribute('pr', true);
        //        pr.id = 'pr';
        //        pr.setAttribute('max', '100');
        //        pr.setAttribute('value', '0');
        //        document.getElementById('prbar').appendChild(pr);
        //        document.getElementById('bt1').style.visibility = "hidden";

        xhr.send(fd);
        
        xhr.responseXML
        
        //   alert(   xhr.responseBody);
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
        xhr.open("POST", "<?php echo base_url() . 'index.php/member/uploadCV/' . $this->session->userdata['userid']; ?>");
        lb = document.createElement('label');
        lb.innerHTML = 'Πρόοδος ανεβάσματος : ';
        document.getElementById('prbar').appendChild(lb);
        pr = document.createElement('progress');
        //   pr.setAttribute('class', 'progress-bar' )
        //pr.setIdAttribute('pr', true);
        pr.id = 'pr';
        pr.setAttribute('max', '100');
        pr.setAttribute('value', '0');
        document.getElementById('prbar').appendChild(pr);
        document.getElementById('bt1').style.visibility = "hidden";

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
        //   alert( evt.toString());
      
        location.href = '<?php echo base_url() . 'index.php/member/profile'; ?>';
        /* This event is raised when the server send back a response */
        // alert(evt.target.responseText);
    }

    function uploadFailed(evt) {
        document.getElementById('bt1').style.visibility = "visible";
        alert("There was an error attempting to upload the file." + evt.target.responseText);
    }

    function uploadCanceled(evt) {
        document.getElementById('bt1').style.visibility = "visible";
        alert("The upload has been canceled by the user or the browser dropped the connection.");
    }



</script>

<script>

    //Date picker settings for calendar

    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

    var checkin = $('#startDate').datepicker({
        onRender: function(date) {
            return date.valueOf();
        }
    }).on('changeDate', function(ev) {
        if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
        }
        checkin.hide();
        $('#endDate')[0].focus();
    }).data('datepicker');

    var checkout = $('#endDate').datepicker({
        onRender: function(date) {
            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
        }
    }).on('changeDate', function(ev) {
        checkout.hide();
    }).data('datepicker');


    //validation rules

    $('#fName_el').focus(function() {
        $('#fName_el').css('background-color', 'inherit');
        $('#lbl_fname_el').text('Όνομα');
        $('#lbl_fname_el').css('color', 'inherit');
    });


    $(document).ready(function() {
        $("#fAmount").keydown(function(event) {
            // Allow: backspace, delete, tab, escape, and enter
            if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || event.keyCode == 190 | event.keyCode == 188 ||
                // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
                // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            else {
                // Ensure that it is a number and stop the keypress
                if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
                    event.preventDefault();
                }
            }
        });
    });
</script>
