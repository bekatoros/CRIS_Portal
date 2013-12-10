<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
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
    <?php
    $uneditclass = 'class = "input-xlarge uneditable-input" disabled ';
    $owner = false;
    $pid = $this->uri->segment(3);
    //  print_r($project);
    if (!empty($member)) {
        //  print_r($member);
        $owner = TRUE;
        $uneditclass = ' class = "input-xlarge"';
    } else {
        //      echo   'den eisai melos';
    }
    ?>
    <!-- Main hero unit for a primary marketing message or call to action -->
    <div class="hero-unit" align="center">
        <table align="center">
            <h3 >Έργο</h3>

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
        <div class="span7"  >

            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#pane1" data-toggle="tab">Στοιχεία</a></li>
                    <li><a href="#pane2" data-toggle="tab">Συνεργάτες</a></li>
                    <li><a href="#pane3" data-toggle="tab">Τμήματα</a></li>
                    <li><a href="#pane4" data-toggle="tab">Χρηματοδότηση</a></li>
                </ul>
                <div class="tab-content">

                    <div id="pane1" class="tab-pane active">
                        <div align="center">            <h4> Στοιχεία </h4></div>
                        <?php
//@todo prepei na ginei edit form opws kai sto profile an o xrhsths einai idiokthths
                        foreach ($project as $cw) {

                            $projid = $cw['cfProjId'];
                            $managerid = $cw['cuManagerId'];
                            ?>


                            <form class="form-horizontal"    accept-charset="utf-8" method="post" action="<?php echo base_url() . 'index.php/project/update/' . $pid . '#tab_pane1'; ?>">

                                <div class="control-group">

                                    <label class="control-label" for="fName_en" id="lbl_surname">Όνομα στα Αγγλικά</label>
                                    <div class="controls">
                                        <input  <?php echo $uneditclass; ?>  type="text" id="fName_en" name="fName_en" value=  '<?php echo $cw['cfTitle'] ?>' required>
                                    </div>
                                </div>

                                <div class="control-group">

                                    <label class="control-label" for="fName_el" id="lbl_name">Όνομα στα Ελληνικά</label>
                                    <div class="controls">
                                        <input <?php echo $uneditclass; ?>  type="text" id="fName_el" name="fName_el"  value= '<?php echo $cw['cuTitle_el'] ?>'>
                                    </div>
                                </div>

                                <div class="control-group">

                                    <label class="control-label" for="projcode" id="lbl_surname_other">Κωδ. Έργου</label>
                                    <div class="controls">
                                        <input <?php echo $uneditclass; ?>  type="text" id="projcode" name="projcode"   value= '<?php echo $cw['cuProjCode'] ?>'  >

                                    </div>  
                                </div>

                                <div class="control-group">

                                    <label class="control-label" for="startDate" id="lbl_name_other">Ημερ. έναρξης</label>
                                    <div class="controls">
                                        <input <?php echo $uneditclass; ?>  type="text" id="startDate" name="startDate"  data-date-format="dd-mm-yyyy" value=  <?php echo convert_str_to_date_for_date_picker($cw['cfStartDate']) ?>>
                                    </div>
                                </div>
                                <div class="control-group">                    
                                    <label class="control-label" for="endDate" id="lbl_name_other">Ημερ. ολοκλήρωσης</label>
                                    <div class="controls">
                                        <input <?php echo $uneditclass; ?>  type="text" id="endDate" name="endDate"  data-date-format="dd-mm-yyyy" value=  <?php echo convert_str_to_date_for_date_picker($cw['cfEndDate']) ?>>
                                    </div>
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
                            <h4> Μέλη </h4>

                            <table  class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Όνομα</th>
                                        <th>Επώνυμο</th>
                                        <th class="email">E-mail</th>
                                        <th> Επ. Υπεύθυνος</th>
                                    </tr>
                                </thead>
                                <?php
                                //var_dump($members);
                                foreach ($members as $cw) {
                                    echo '<tr><td>' . $cw['cuFirstNames_el'] . '</td><td>' . $cw['cuFamilyNames_el'] . '</td><td>' . $cw['cuEmail'] . '</td><td>';
                                    if ($cw['cfPersId'] == $managerid) {
                                        echo "<div align='center'> <i class='icon-star icon-black'></i></div>";
                                    } else {
                                        echo "<div align='center'>";
                                        if ($owner) {
                                            echo " <a href='" . base_url() . "index.php/project/setmanager/" . $projid . "/" . $cw['cfPersId'] . "#tab_pane2'>";
                                        }


                                        echo "<i size='10px' class='icon-star-empty icon-black'></i>";
                                        if ($owner) {
                                            echo "</a>";
                                        }

                                        echo "</div>";
//                         
//                                  echo  "<div align='center'> <form method='post' action=".base_url() . "index.php/project/setmanager/".$projid." > <input type='hidden' name='persid' id='persid' value='".$cw['cfPersId'].
//                                    "'><button type='submit'><i class='icon-star-empty icon-black'></i></button></form></div>";
//                         
                                    }
                                    echo '</td></tr>';
                                }
                                ?>
                            </table>
                                <?php
                                if ($owner) {
                                    ?>     
                                <form  class="form-inline" method="post" action="<?php echo base_url() . 'index.php/project/adduser/' . $pid . '#tab_pane2'; ?>">

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

                    </div>
                    <div id="pane3" class="tab-pane">

                        <div align="center"> 
                            <h4> Τμήματα </h4>

                            <table  class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Όνομα στα Αγγλικά</th>
                                        <th>Όνομα στα Ελληνικά</th>

                                    </tr>
                                </thead>
<?php
foreach ($orgmembers as $cw) {
    echo '<tr><td>' . $cw['cfName'] . '</td><td>' . $cw['cuName_el'] . '</td>';
}
?>
                            </table>
                                <?php
                                if ($owner) {
                                    ?>  
                                <form  class="form-inline" method="post" action="<?php echo base_url() . 'index.php/project/addorgunit/' . $pid . '#tab_pane3'; ?>">

                                    <select class="input-large" id="orgunitid" name="orgunitid" >
                                        <option selected></option>
                                <?php
                                foreach ($orgunits as $org) {
                                    echo '<option value="' . $org['cfOrg_UnitId'] . '" >' . $org['cuName_el'] . " " . $org['cfName'] . '</option>';
                                }
                                ?>
                                    </select>

                                    <button type="submit" class="btn">Προσθήκη</button>
                                </form>
                                    <?php }
                                    ?>
                        </div>


                    </div>

                    <div id="pane4" class="tab-pane">

                        <div align="center"> 
                            <h4> Χρηματοδότηση </h4>

                            <table  class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Όνομα στα Αγγλικά</th>
                                        <th>Όνομα στα Ελληνικά</th>
                                        <th class="email">Συνολικό Ποσό</th>
                                    </tr>
                                </thead>
<?php
//     var_dump($cowriters);
foreach ($funding as $cw) {
    echo '<tr><td><a href=' . base_url() . 'index.php/fund/show/' . $cw[cfFundId] . '>' . $cw['cfName'] . '</a></td><td><a href=' . base_url() . 'index.php/fund/show/' . $cw[cfFundId] . '>' . $cw['cuName_el'] . '</a></td><td>' . $cw['cfAmount'] . '</td>';
}
?>
                            </table>
                        </div>

                    </div>

                </div>  <!--tabbed content-->
            </div><!-- /.tabbable -->
        </div>
        <div class="span4 "  >






        </div>
    </div>

    <hr>



</div> <!-- /container -->


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

    $('#submit_button').click(function() {

        var fname_en = $('#fName_en').val();
        var fname_el = $('#fName_el').val();
        var famount = $('#fAmount').val();



        if (!fname_el || fname_el === '' || fname_el.length < 1) {
            $('#lbl_fName_el').css('color', 'red');
            $('#lbl_fName_el').text('Παρακαλώ εισάγετε το όνομα της χρηματοδότησης στα ελληνικά');
            $('#fname_el').css('background-color', '#FFC3C4');
            return false;
        }


        if (!fname_en || fname_en === '' || fname_en.length < 1) {
            $('#lbl_fName_en').css('color', 'red');
            $('#lbl_fName_en').text('Παρακαλώ εισάγετε το όνομα της χρηματοδότησης στα αγγλικά');
            $('#fname_en').css('background-color', '#FFC3C4');
            return false;
        }


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
