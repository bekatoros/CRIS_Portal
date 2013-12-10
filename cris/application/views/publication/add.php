<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<script>
    $(function() {
        $("#startDate").datepicker({dateFormat: "dd-mm-yy"});
//        $("#startDate").keypress(function(event) {
//            event.preventDefault();
//        });
//        $("#endDate").datepicker({dateFormat: "dd-mm-yy"});
//        $("#endDate").keypress(function(event) {
//            event.preventDefault();
//        });

    });
</script>




<div class="container">

    <!-- Main hero unit for a primary marketing message or call to action -->
    <div class="hero-unit" align="center">
        <table align="center">
            <h4 >Υποβολή νέας δημοσίευσης</h4>          
        </table>
    </div>

    <!-- Example row of columns -->
    <div class="row-fluid">
        <div class="span3"   >
        </div>
        <div class="span6" align='center' >
           
            
              <form class="form-horizontal"    accept-charset="utf-8" method="post" action="<?php echo base_url() . 'index.php/publication/submit'; ?>" >
                    
                    <div class="control-group">

                        <label class="control-label" for="fTitle" id="lbl_surname">Τίτλος σε κύρια γλώσσα</label>
                        <div class="controls">
                            <input  <?php echo $uneditclass; ?>  type="text" id="fTitle" name="fTitle"  required>
                        </div>
                    </div>

                    <div class="control-group">

                        <label class="control-label" for="fTitle_sec" id="lbl_name">Τίτλος σε άλλη γλώσσα</label>
                        <div class="controls">
                            <input <?php echo $uneditclass; ?>  type="text" id="fTitle_sec" name="fTitle_sec"  >
                        </div>
                    </div>

                    <div class="control-group">

                        <label class="control-label" for="uri" id="lbl_surname_other">URI</label>
                        <div class="controls">
                            <input <?php echo $uneditclass; ?>  type="text" id="uri" name="uri"     >

                        </div>  
                    </div>
                    
                      <div class="control-group">

                        <label class="control-label" for="citation" id="lbl_name_other">Βιβλιογραφική Αναφορά</label>
                        <div class="controls">
                            <input <?php echo $uneditclass; ?>  type="text" id="citation" name="citation"  >
                        </div>
                    </div>
                  
                  
                    <div class="control-group">

                        <label class="control-label" for="startDate" id="lbl_name_other">Ημερ. Δημοσίευσης</label>
                        <div class="controls">
                            <input <?php echo $uneditclass; ?>  type="text" id="startDate" name="startDate" data-date-format="dd-mm-yyyy" >
                        </div>
                    </div>

                  <div class="control-group">
                  <label  class="control-label" id='pubTypelabel' name='pubTypelabel'   >Τύπος δημοσίευσης</label><br/>
                           <div  class="controls"> <select id='pubType' name='pubType'>
                                <?php
                                $pta = $this->config->item('pubtypes');        //   echo $md[1]['name'].$md[1]['schema'].$md[1]['element'].$md[1]['qualifier'].$md[1]['language'].$md[1]['required'].$md[1]['pair'] ;
                                foreach ($pta as $key => $pt) {
                                    echo '<option value=' . $key . '>' . $pt['type'] . '</option>';
                                }
                                ?>                         
                            </select></div>
                     </div>

           <div class="control-group">
                            <div class="controls">            
                                <button type="submit" class="btn" id="submit_button">Υποβολή</button>
                            </div>
                        </div>
                  </form>
            
                    
                    </div>
                    <div class="span3" >

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
