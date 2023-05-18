<?php
     $this->view('admin/adminheader',$data);
     $this->view('admin/sidebar',$data);

?>


    	<!-- <p>Place your content here categories.</p> -->
        <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
	                        	
                                <!-- Button trigger modal -->
                               <h4><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAuthorModal"><i class="fa fa-plus"></i>   Add Author </button></h4>

                                <!-- Add author Modal -->
                                <div class="modal fade" id="addAuthorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addAuthorModalTitle">Add Author</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="modal-body">
                                                    <input type="text" name="name" id ="name" class="form-control form-control-lg" style="margin-bottom:10px;" placeholder="Enter author name ...">
                                                    <input type="email" name="email" id ="email" class="form-control form-control-lg" placeholder="Enter author email ...">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="btnsave" onclick="collect_data(event)">Save </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End AddAuthor Modal -->

                                <!-- EDIT Author Modal -->
                              <div class="modal fade" id="editAuthorModal" tabindex="-1" aria-labelledby="addAuthorModal" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="edittitle">Edit Author</h5>
                                          <!-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button> -->
                                        </div>
                                        <div class="modal-body">
                                          <input type="text" name="editname" id ="editname" class="form-control form-control-lg" style="margin-bottom:10px;">
                                          <input type="email" name="editemail" id ="editemail" class="form-control form-control-lg"  >
                                         </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                                          <button type="button" class="btn btn-primary" id="btnupdate" onclick="update_author_data(event)">Update </button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                               <!-- END EDIT author Modal -->

                                
                              
                              <hr>
                              <thead>
                              <tr>
                                  <th class="hidden-phone"></i> ID #</th>
                                  <th><i class="fa fa-user"></i> Author Name</th>
                                  <th><i class="fa fa-envelope"></i> Email</th>
                                  <th><i class=" fa fa-edit"></i> Action</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody id="author_table_body" style="font-size:14px;">

                                <?php 
                                  //print generated table rows from model class through controller 
                                    echo $tblRows;
                                    // echo $data['table_rows'];
                                ?>                           
                              
                              </tbody>
                          </table>
                      </div><!-- /content-panel -->
                  </div><!-- /col-md-12 -->
              </div><!-- /row -->

    
              
<script type="text/javascript">
    

var EDIT_ID =0;
function collect_data(e){
    var name = document.querySelector("#name").value.trim();
    var email = document.querySelector("#email").value.trim();
    if(name == "" || !isNaN(name)){
        alert("please enter a valid name");
    }

    if(email == "" || !isNaN(email)){
        alert("please enter a valid email");
    }

    send_data({
        name:name,
        email:email,
        actionType:"add_new"
        });
}

//create function will send data to Category controller
function send_data(data ={}){
    var ajax = new XMLHttpRequest();
    ajax.addEventListener('readystatechange', function(){
        if(ajax.readyState == 4 && ajax.status == 200){
            //handle the response
            handle_results(ajax.responseText);
        }
    });
    //send data
    ajax.open("POST","<?=ROOT?>authorAjaxHandler", true);
    ajax.send(JSON.stringify(data));


}

//this function will handle the ajax response
function  handle_results(result)
    {
        // console.log(typeof result);
          console.log(result);
          if(result!=="")
          {

            let obj= JSON.parse(result);
 ;
            if(typeof obj.actionType!=='undefined')
            {
                if(obj.actionType == "add_new")
                {
                    // alert("add reached");
                    if(obj.messageType=="info")
                    {

                        clearForm();

                        let author_table_body = document.querySelector("#author_table_body");
                        author_table_body.innerHTML = obj.data;
                       alert(obj.message);
                    }else
                    {
                        // alert("Error adding category");

                        alert(obj.message);
                    }

                }else if(obj.actionType == "delete_row")
                {

                    let author_table_body = document.querySelector("#author_table_body");
                    author_table_body.innerHTML=obj.data;
                   // alert(obj.message);

                }else if(obj.actionType == "edit_row")
                {
                    let author_table_body = document.querySelector("#author_table_body");
                    author_table_body.innerHTML=obj.data;
                    alert(obj.message);
                    document.querySelector("#editname").value="";
                    document.querySelector("#editemail").value="";
                  

                }

            }
        }

        function clearForm() {
            document.querySelector("#name").value = "";
            document.querySelector("#email").value = ""
        }
     }

 //function to bring up the edit modal
    function edit_record(id, e){

        var info = e.currentTarget.getAttribute("info");
        info = JSON.parse(info.replaceAll("'",'"')); //replace single quotes by double quotes to make it a proper json object
        info = JSON.parse(info);
 
        document.querySelector("#editname").value = info.name;
        document.querySelector("#editemail").value = info.email;
        // name.value = info.name;
        // email.value = info.email;

        EDIT_ID =id;

    }

    // Function to actually send data to be pushed to database
   
    function update_author_data(e){
        let name = document.querySelector("#editname").value.trim();
        let email = document.querySelector("#editemail").value.trim();
        if (name == "" || !isNaN(name)) {
            alert("Author name is not valid");
        }
        if (email == "" || !isNaN(email)) {
            alert("Email is not valid");
        }

        send_data({
            id:EDIT_ID,
            name:name,
            email:email,
            actionType: "edit_row"
        });

    }

  // Function to delete a record
 
    function delete_record(e,id){

        if(!confirm("Are you sure to delete the record?")){
            return; //exit
        }
        send_data({
            id:id,
            actionType: "delete_row"
        });

    }




</script>







<?php
     $this->view('admin/adminfooter',$data);
?>