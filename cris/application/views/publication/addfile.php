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
            <h3 >Υποβολή νέας δημοσίευσης</h3>          
        </table>
    </div>
 
    <!-- Example row of columns -->
    <div class="row-fluid">
        <div class="span3"   >
        </div>
        <div class="span6" align='center' >
            <h4>Εισαγωγή Αρχείου</h1></br>
                <!--<h1>Υποβολή Αρχείου</h1><br/><br/>-->
                Το αρχείο που θα ανεβάσετε πρέπει να είναι τύπου PDF

                <form class="form-horizontal" id='upload' method='post' enctype='multipart/form-data'>
                      <div><label for='fileselect'>Επιλογή αρχείου:</label> 
                       <INPUT type='file' name='fileToUpload' id='fileToUpload' onchange='fileSelected();' /> </div>
                    <div id='prbar'></div>
                    <div id='fileSize'></div>
                              <input class='btn' type='button' id='bt1' onclick='uploadFile()' value='Υποβολή' /> </form> 
                              </div>                         
        <div class="span3" >

        </div>


        <hr>

    </div>

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
        xhr.open("POST", "<?php echo base_url() . 'index.php/publication/submit_file/'. $pubid;?>");
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
    location.href = '<?php echo base_url() . 'index.php/publication/show/'. $pubid; ?>';
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
      