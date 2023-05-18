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
                               <h4><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPublisherrModal"><i class="fa fa-plus"></i>   Add Publisher </button></h4>

                                <!-- Add Publisher Modal -->
                                <div class="modal fade" id="addPublisherrModal" tabindex="-1" role="dialog" aria-labelledby="addPublisherrModal" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addPublisherTitle">Add Publisher </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="modal-body">
                                                    <input type="text" name="publishername" id ="publishername" class="form-control form-control-lg" style="margin-bottom:10px;" placeholder="Enter publisher name ...">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="btnsave" onclick="collect_data(event)">Save </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End AddPublisher Modal -->

                                <!-- EDIT Publisher Modal -->
                              <div class="modal fade" id="editPublisherModal" tabindex="-1" aria-labelledby="addAuthorModal" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="edittitle">Edit Publisher</h5>
                                        </div>
                                        <div class="modal-body">
                                          <input type="text" name="editpublishername" id ="editpublishername" class="form-control form-control-lg" style="margin-bottom:10px;">
                                         </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                                          <button type="button" class="btn btn-primary" id="btnupdate" onclick="update_publisher_data(event)">Update </button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                               <!-- END EDIT Publisher Modal -->

                                
                              
                              <hr>
                              <thead>
                              <tr>
                                  <th class="hidden-phone"></i> ID #</th>
                                  <th><i class="fa fa-book"></i> Publisher Name</th>
                                  <th><i class=" fa fa-edit"></i> Action</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody id="publisher_table_body" style="font-size:14px;">

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
    var publisherName = document.querySelector("#publishername").value.trim();
    if(publisherName == "" || !isNaN(publisherName)){
        alert("please enter a valid publisher name");
    }

    send_data({
        publisherName:publisherName,
        actionType:"add_new"
        });
}

//create function will send data to _Category controller
function send_data(data ={}){
    var ajax = new XMLHttpRequest();
    ajax.addEventListener('readystatechange', function(){
        if(ajax.readyState == 4 && ajax.status == 200){
            //handle the response
            handle_results(ajax.responseText);
        }
    });
    //send data
    ajax.open("POST","<?=ROOT?>publisherAjaxHandler", true);
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

                        document.querySelector("#publishername").value = "";

                        let publisher_table_body = document.querySelector("#publisher_table_body");
                        publisher_table_body.innerHTML = obj.data;
                       alert(obj.message);
                    }else
                    {
                        // alert("Error adding category");

                        alert(obj.message);
                    }

                }else if(obj.actionType == "delete_row")
                {

                    let publisher_table_body = document.querySelector("#publisher_table_body");
                    publisher_table_body.innerHTML=obj.data;
                   // alert(obj.message);

                }else if(obj.actionType == "edit_row")
                {
                    let publisher_table_body = document.querySelector("#publisher_table_body");
                    publisher_table_body.innerHTML=obj.data;
                    alert(obj.message);
                    document.querySelector("#editpublishername").value="";

                }

            }
        }
     }

 //function to bring up the edit modal
    function edit_record(id, e){

        var info = e.currentTarget.getAttribute("info");
        info = JSON.parse(info.replaceAll("'",'"')); //replace single quotes by double quotes to make it a proper json object
        info = JSON.parse(info);
 
        document.querySelector("#editpublishername").value = info.publisherName;

        EDIT_ID =id;

    }

    // Function to actually send data to be pushed to database
   
    function update_publisher_data(e){
        let publisherName = document.querySelector("#editpublishername").value.trim();
        if (publisherName == "" || !isNaN(publisherName)) {
            alert("Publisher name is not valid");
        }

        send_data({
            id:EDIT_ID,
            publisherName:publisherName,
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