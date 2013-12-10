
        <div class="container">

    <!-- Main hero unit for a primary marketing message or call to action -->
           <div class="hero-unit" align="center">
            <table align="center">
                <h3 >Επεξεργασία Προφίλ</h3>
                <p >Επεξεργαστείτε το προφίλ σας</p>
            </table>
        </div>

        <!-- Example row of columns -->
        <div class="row-fluid">
            <div class="span3"   >
            </div>
            <div class="span6"  >

        <form class="form-horizontal"  method="post"  accept-charset="utf-8" action="<?php echo base_url() . 'index.php/member/register'; ?>">
            <?php if ($error_msg) { ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Warning!</strong>
                    <?php echo form_error('surname_other'); ?>
                    <?php echo form_error('name_other'); ?>
                </div>
            <?php }
            ?>
            <div class="control-group">
                <label class="control-label" for="surname_other">Επώνυμο σε άλλη γλώσσα</label>
                <div class="controls">           
                    <input type="text" id="othername" name="surname_other" placeholder="Επώνυμο σε άλλη γλώσσα">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="name_other">Όνομα σε άλλη γλώσσα</label>
                <div class="controls">            
                    <input type="text" id="othername" name="name_other" placeholder="Όνομα σε άλλη γλώσσα">
                </div>
            </div>

          
   
    
    <div class="control-group">
        <label class="control-label" for="orgunit">Τμήμα</label>
        <div class="controls">
            <select name="orgunit" class =""  id="orgunit">
                <?php             
                for ($i = 0; $i < count($orgunits); $i++) {
                    echo "<option value =". $orgunits[$i]['id'] .">";
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
                <option value="0">Άνδρας</option>
                <option value="1">Γυναίκα</option>
            </select> 
        </div>
    </div>

    <div class="control-group">
        <div class="controls">            
            <button type="submit" class="btn">Καταχώρηση</button>
        </div>
              </div>
            
              </div>
            <div class="span3" >

            </div>
      

              </div>
    </div>   



    
