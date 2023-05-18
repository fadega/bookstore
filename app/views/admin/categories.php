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
                               <h4><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal"><i class="fa fa-plus"></i>   Add Genre/Category </button></h4>

                                <!-- Add category Modal -->
                                <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addCategoryModalTitle">Add Genre/Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="modal-body">
                                                    <input type="text" name="categoryname" id ="categoryname" class="form-control form-control-lg" placeholder="Enter Genre/Category Name ...">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="btnsave" onclick="collect_data(event)">Save </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End AddCategory Modal -->

                                <!-- EDIT category Modal -->
                              <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="addCategoryModal" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="edittitle">Edit Category</h5>
                                          <!-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button> -->
                                        </div>
                                        <div class="modal-body">
                                          <input type="text" name="catname" id ="editcatname" class="form-control form-control-lg"  >
                                         </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                                          <button type="button" class="btn btn-primary" id="btnupdate" onclick="update_category_data(event)">Update </button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                               <!-- END EDIT category Modal -->

                                
                              
                              <hr>
                              <thead>
                              <tr>
                                  <th class="hidden-phone"></i> ID #</th>
                                  <th><i class="fa fa-bookmark"></i> Category Name</th>
                                  <th><i class=" fa fa-edit"></i> Action</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody id="table_body" style="font-size:14px;">

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
    var categoryName = document.getElementById("categoryname").value;
    categoryName = categoryName.trim();
    if(categoryName == "" || !isNaN(categoryName)){
        alert("please enter a valid category name");
    }
// catetory = category.trim();
    send_data({
        category:categoryName,
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
    ajax.open("POST","<?=ROOT?>categoryAjaxHandler", true);
    ajax.send(JSON.stringify(data));


}

//this function will handle the ajax response
function  handle_results(result)
    {
        console.log(typeof result);
          console.log(result);
          if(result!=="")
          {
            let obj= JSON.parse(result);

            if(typeof obj.actionType!=='undefined')
            {
                if(obj.actionType == "add_new")
                {
                    // alert("add reached");
                    if(obj.messageType=="info")
                    {
                        document.getElementById("categoryname").value = "";
                        let table_body = document.getElementById("table_body");
                        table_body.innerHTML = obj.data; 
                        alert(obj.message);                       
              
                       
                    }else
                    {
                        // alert("Error adding category");

                        alert(obj.message);
                    }

                }else if(obj.actionType == "delete_row")
                {

                    let table_body = document.getElementById("table_body");
                    table_body.innerHTML=obj.data;
                   alert(obj.message);

                }else if(obj.actionType == "edit_row")
                {
                    let table_body = document.getElementById("table_body");
                    table_body.innerHTML=obj.data;
                    document.getElementById("editcatname").value="";
                    alert(obj.message);

                }

            }
        }
     }

// Function to bring data to be edited
   
    function edit_record(id, category){
        console.log(id, category)
        let txt_category = document.getElementById("editcatname");
        txt_category.value = category;

        EDIT_ID =id;

    }

   // Function to actually send data to pushed to database
   
    function update_category_data(e){
        let category = document.getElementById("editcatname").value.trim();
        if (category == "" || !isNaN(category)) {
            alert("Check if characteres entered are valid");
        }

        send_data({
            id:EDIT_ID,
            category:category,
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