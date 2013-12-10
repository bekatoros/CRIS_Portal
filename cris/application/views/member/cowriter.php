<script type="text/javascript">
    function changeName()
    {
        
        var index = document.getElementById('sel').value;// .selectedIndex;
     
       if (document.getElementById("sel").value=="other")
       {
           document.getElementById("writer").style.visibility="hidden";
           br = document.createElement('br');
           document.getElementById("newuser").appendChild(br);
           
           lb = document.createElement('label');          
           lb.innerHTML="Εισάγετε το email για να προσκληθεί :";
    //       
           
           document.getElementById("newuser").appendChild(lb);
           
           input=document.createElement('input');           
           input.style.property="width: 200px; height: 25px";    
           input.setAttribute("name","email");
           input.setAttribute("id", "email");
           document.getElementById("newuser").appendChild(input);
           
           strng=document.createElement('strong');           
           strng.innerHTML="@hua.gr";           
           document.getElementById("newuser").appendChild(strng);  
           document.getElementById("writer").innerHTML= " ";
        //   document.getElementById("writer").setAttribute("name", "writer");
           
       }else if (document.getElementById("sel").value=="-1")
       {document.getElementById("writer").style.visibility="visible";
        document.getElementById("writer").innerHTML= " ";
         var parent=  document.getElementById("newuser");
          if (parent.hasChildNodes()){
         parent.removeChild(parent.lastChild);
         parent.removeChild(parent.lastChild);
         parent.removeChild(parent.lastChild); 
         parent.removeChild(parent.lastChild); }
       }       
       else
       {         document.getElementById("writer").style.visibility="visible"; 
            var parent=  document.getElementById("newuser");
            if (parent.hasChildNodes()){
         parent.removeChild(parent.lastChild);
         parent.removeChild(parent.lastChild);
         parent.removeChild(parent.lastChild); 
         parent.removeChild(parent.lastChild); }
     var url='<?php echo base_url()?>index.php/member/get_user?user_id='+index;
	    $.getJSON(url,function(json){
            // loop through the posts here
         //  alert(json);
            //document.getElementById("writer"+num.toString()+"").value=json;
              $.each(json,function(i,post){
                                 //   alert(post.toString());\
                         
                 document.getElementById("writer").innerHTML= post[0].cuEmail  ; 
                //   document.getElementById("writer").innerHTML=         JSON.stringify(post[0].cuEmail)    ;
                });
           }); 
       }
    }
    </script>
    
<div id="container">
    <h1></h1>

    <div id="body">
        <div class="container">

            <!-- Main hero unit for a primary marketing message or call to action -->
            <div class="hero-unit" align="center" >
                <h2>Συνεργάτες</h2>
            </div>


            <!-- Example row of columns -->
            <div class="row-fluid">
                <div class="span3"   >
                </div>
                <div class="span6"  >
                    <table  class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Όνομα</th>
                                <th>Επώνυμο</th>
                                <th class="email">E-mail</th>
                            </tr>
                        </thead>
                        <?php
                   //     var_dump($cowriters);
                        foreach ($cowriters as $cw) {
                            echo '<tr><td>'.$cw['cuFirstNames_el']. '</td><td>'.$cw['cuFamilyNames_el']. '</td><td>'.$cw['cuEmail'] .'</td>';
                        }
                        ?>
                    </table>
                    <form   method="post" align='center' action="<?php echo base_url()?>index.php/cowriter/new_cowriter" >
                        
                        <table align='center'><tr><td align='center' ></br><label  >Ονοματεπώνυμο Συγγραφέα</label></td></tr><tr align='center'><td><br> <label  id='writer' style='width: 250px; height: 25px' type='text' /></label>
         <select id='sel' name='sel' onchange='changeName()' style='width: 150px;' > 
             <option value='' selected> </option>
            <?php 
   //   <option value='16' >test </option>
            foreach($suggest as $user)
            {
                echo '<option value="'.$user['cfPersId'].'" >'.$user['cuFamilyNames_el']." ".$user['cuFirstNames_el'].'</option>';
            }
      ?>
      <option value='other'>άλλος</option></select></td></tr><tr><td> <div id='newuser' ></div> </td></tr></br>
        <tr><td align="center"><input class='btn' type='submit' id='bt1'  value='Υποβολή' /> </td></tr> </table></form></br> 
                    
                </div>
                
                
                <div class="span3" >

                </div>
            </div>

        </div>

    </div>   
</div>
