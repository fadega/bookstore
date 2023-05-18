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
                               <h4><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal"><i class="fa fa-plus"></i>   Add User </button></h4>

                                <!-- Add author Modal -->
                                <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModal" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addAuthorModalTitle">Add User</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="modal-body">
                                                    <input type="text" name="name" id ="name" class="form-control form-control-lg" style="margin-bottom:10px;" placeholder="Enter user name ...">
                                                    <input type="email" name="email" id ="email" class="form-control form-control-lg" style="margin-bottom:10px;" placeholder="Enter user email name ...">
                                                    <input type="text" name="phone" id ="phone" class="form-control form-control-lg" style="margin-bottom:10px;" placeholder="Enter user phone # ...">
                                                    <input type="text" name="address" id ="address" class="form-control form-control-lg" style="margin-bottom:10px;" placeholder="Enter user address ...">
                                                    <select  id="role" class="form-select form-select-lg form-control input-lg form-control-lg mb-4  " style="margin-bottom:5px;" aria-label=".form-select ">
                                                        <option selected>Role *</option>
                                                                <option value="customer">Customer</option>
                                                                <option value="admin">Admin</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="btnsave" onclick="collect_data(event)">Save </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End User Modal -->

                                <!-- EDIT User Modal -->
                              <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModal" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="edittitle">Edit User</h5>
                                          <!-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button> -->
                                        </div>
                                        <div class="modal-body">
                                                <input type="text" name="editname" id ="editname" class="form-control form-control-lg" style="margin-bottom:10px;" >
                                                <input type="email" name="editemail" id ="editemail" class="form-control form-control-lg" style="margin-bottom:10px;">
                                                <input type="text" name="editphone" id ="editphone" class="form-control form-control-lg" style="margin-bottom:10px;">
                                                <input type="text" name="editaddress" id ="editaddress" class="form-control form-control-lg" style="margin-bottom:10px;">
                                                <select  id="editrole" class="form-select form-select-lg form-control input-lg form-control-lg mb-4  " style="margin-bottom:5px;" aria-label=".form-select ">
                                                    <option selected>Role *</option>
                                                    <option value="customer">Customer</option>
                                                    <option value="admin">Admin</option>
                                                </select>
                                         </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                                          <button type="button" class="btn btn-primary" id="btnupdate" onclick="update_user_data(event)">Update </button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                               <!-- END EDIT User Modal -->

                                
                              
                              <hr>
                              <thead>
                              <tr>
                                  <th class="hidden-phone"></i> ID #</th>
                                  <th><i class="fa fa-user"></i> Name</th>
                                  <th><i class="fa fa-envelope"></i> Email</th>
                                  <th><i class="fa fa-phone"></i> Phone</th>
                                  <th><i class="fa fa-home"></i> Date</th>
                                  <th><i class=" fa fa-edit"></i> Action</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody id="user_table_body" style="font-size:14px;">

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
    var phone = document.querySelector("#phone").value.trim();
    var address = document.querySelector("#address").value.trim();

    let selectedRole = document.querySelector('#role');
    let role  = selectedRole.options[selectedRole.selectedIndex].value

    if(name == "" || !isNaN(name)){
        alert("please enter a valid name");
    }

    if(email == "" || !isNaN(email)){
        alert("please enter a valid email");
    }

    if(phone == "" || !isNaN(phone)){
        alert("please enter a valid email");
    }

    if(address == "" || !isNaN(address)){
        alert("please enter a valid email");
    }

    send_data({
        name:name,
        email:email,
        phone:phone,
        address:address,
        role:role,
        actionType:"add_new"
        });
}

//create function will send data to userCategory controller
function send_data(data ={}){
    var ajax = new XMLHttpRequest();
    ajax.addEventListener('readystatechange', function(){
        if(ajax.readyState == 4 && ajax.status == 200){
            //handle the response
            handle_results(ajax.responseText);
        }
    });
    //send data
    ajax.open("POST","<?=ROOT?>userAjaxHandler", true);
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

                        let user_table_body = document.querySelector("#user_table_body");
                        user_table_body.innerHTML = obj.data;
                       alert(obj.message);
                    }else
                    {
                        // alert("Error adding category");

                        alert(obj.message);
                    }

                }else if(obj.actionType == "delete_row")
                {

                    let user_table_body = document.querySelector("#user_table_body");
                    user_table_body.innerHTML=obj.data;
                   // alert(obj.message);

                }else if(obj.actionType == "edit_row")
                {
                    let user_table_body = document.querySelector("#user_table_body");
                    user_table_body.innerHTML=obj.data;
                    alert(obj.message);
                    clearForm();
                  

                }

            }
        }

        function clearForm() {
            document.querySelector("#name").value = "";
            document.querySelector("#email").value = "";
            document.querySelector("#phone").value = "";
            document.querySelector("#address").value = "";
            document.querySelector('#role').selectedIndex = null;
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