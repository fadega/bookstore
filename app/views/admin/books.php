<?php
     $this->view('admin/adminheader',$data);
     $this->view('admin/sidebar',$data);

     $conn = Database::newInstance();

    $query = "select *from author";
    $authorresult = $conn->read($query);

    $query = "select *from category";
    $categoryresult = $conn->read($query);

    $query = "select *from publisher";
    $publisherresult = $conn->read($query);

?>

    	<!-- <p>Place your content here categories.</p> -->
        <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
	                  	  	  
                          
                            <!-- Button trigger modal -->
                            <h4><button type="button" id = "btn-addBook" class="btn btn-primary form-control-lg" data-toggle="modal" data-target="#addBookModal"><i class="fa fa-plus"></i>   Add Book </button></h4>

                            <!-- Add Book Modal -->
                            <div class="modal fade" id="addBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addBookModalTitle">Add Book</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="modal-body">
                                                <input type="text" name="title" id ="title" class="form-control input-lg form-control-lg mb-4" style="margin-bottom:5px;" placeholder="Enter book title .." >

                                                
                                                <select  id="author" class="form-select form-select-lg form-control input-lg form-control-lg mb-4  " style="margin-bottom:5px;" aria-label=".form-select ">
                                                    <option selected>Author *</option>
                                                    <?php
                                                    // show($authors);
                                                    if($authorresult){
                                                    for($count =0; $count < count($authorresult); $count++){?>
                                                            <option value="<?php echo (int)$authorresult[$count]['id'];?>"><?php echo $authorresult[$count]['name'];?></option>
                                                    <?php }
                                                    } ?>
                                                </select>

                                                <select  id="category" class="form-select form-select-lg form-control  input-lg form-control-lg mb-4 " style="margin-bottom:5px;" aria-label=".form-select ">
                                                    <option selected>Select Category*</option>
                                                    <?php
                                                    // show($categories);
                                                    if($categoryresult){
                                                    for($count =0; $count < count($categoryresult); $count++){?>
                                                            <option value="<?php echo (int)$categoryresult[$count]['id'];?>"><?php echo $categoryresult[$count]['categoryName'];?></option>
                                                    <?php }
                                                    } ?>
                                                </select> 
                                                
                                                <select  id="publisher" class="form-select form-select-lg mb-3 form-control input-lg form-control-lg " style="margin-bottom:5px;" aria-label=".form-select ">
                                                    <option selected>Select Publisher*</option>
                                                    <?php
                                                    // show($publishers);
                                                    if($publisherresult){
                                                    for($count =0; $count < count($publisherresult); $count++){?>
                                                            <option value="<?php echo (int)$publisherresult[$count]['id'];?>"><?php echo $publisherresult[$count]['publisherName'];?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                                <label for="publishdate">Date published</label>
                                                <input type="datetime-local" class="form-control" id="publishdate"  style="margin-bottom:8px; width:50%;" >    

                                                <label for="price">Price*</label>
                                                <input type="number" step="0.01" value ="0.00" name="price" id ="price" class="form-control input-lg input-lg form-control-lg " style="margin-bottom:5px;" placeholder="0.00"  >
                                                <label for="Quantity">Quantity</label>
                                                <input type="number" step="1" value ="0" name="quantity" id ="quantity" class="form-control input-lg input-lg form-control-lg " style="margin-bottom:5px;" placeholder="0.00"  >
                                                <input type="text" name="isbn" id ="isbn" class="form-control input-lg form-control-lg mb-4" style="margin-bottom:10px;" placeholder="Enter isbn .." >

                                                <label for="formFileLg" class="form-label">Book Cover images*</label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                    <input class="form-control input-lg form-control-lg mb-4" id="image1" type="file">
                                                    </div>
                                                    <div class="col-sm-6">
                                                    <input class="form-control input-lg form-control-lg mb-4" id="image2" type="file">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="savepro" onclick=" collect_data(event)">Save </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End AddBook Modal -->

                             <!-- Edit Book Modal -->
                            <div class="modal fade" id="editBookModal" tabindex="-1" role="dialog" aria-labelledby="editBookModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editBookModalTitle">Edit Book</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="modal-body">
                                                <input type="text" name="edittitle" id ="edittitle" class="form-control input-lg form-control-lg mb-4" style="margin-bottom:5px;" placeholder="Enter book title .." >

                                                
                                                <select  id="editauthor" class="form-select form-select-lg form-control input-lg form-control-lg mb-4  " style="margin-bottom:5px;" aria-label=".form-select ">
                                                    <option selected>Author *</option>
                                                    <?php
                                                    // show($authors);
                                                    if($authorresult){
                                                        display($authors);
                                                    for($count =0; $count < count($authorresult); $count++){?>
                                                            <option value="<?php echo (int)$authorresult[$count]['id'];?>"><?php echo $authorresult[$count]['name'];?></option>
                                                    <?php }
                                                    } ?>
                                                </select>

                                                <select  id="editcategory" class="form-select form-select-lg form-control  input-lg form-control-lg mb-4 " style="margin-bottom:5px;" aria-label=".form-select ">
                                                    <option selected>Select Category*</option>
                                                    <?php
                                                    // show($categories);
                                                    if($categoryresult){
                                                    for($count =0; $count < count($categoryresult); $count++){?>
                                                            <option value="<?php echo (int)$categoryresult[$count]['id'];?>"><?php echo $categoryresult[$count]['categoryName'];?></option>
                                                    <?php }
                                                    } ?>
                                                </select> 
                                                
                                                <select  id="editpublisher" class="form-select form-select-lg mb-3 form-control input-lg form-control-lg " style="margin-bottom:5px;" aria-label=".form-select ">
                                                    <option selected>Select Publisher*</option>
                                                    <?php
                                                    // show($publishers);
                                                    if($publisherresult){
                                                    for($count =0; $count < count($publisherresult); $count++){?>
                                                            <option value="<?php echo (int)$publisherresult[$count]['id'];?>"><?php echo $publisherresult[$count]['publisherName'];?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                                <label for="publishdate">Date published</label>
                                                <input type="datetime-local" class="form-control" id="editpublishdate"  style="margin-bottom:8px; width:50%;" >    

                                                <label for="price">Price*</label>
                                                <input type="number" step="0.01" value ="0.00" name="editprice" id="editprice" class="form-control input-lg input-lg form-control-lg " style="margin-bottom:5px;" placeholder="0.00"  >
                                                <label for="Quantity">Quantity</label>
                                                <input type="number" step="1" value ="0" name="editquantity" id ="editquantity" class="form-control input-lg input-lg form-control-lg " style="margin-bottom:5px;" placeholder="0.00"  >
                                                <input type="text" name="editisbn" id ="editisbn" class="form-control input-lg form-control-lg mb-4" style="margin-bottom:10px;" placeholder="Enter isbn .." >

                                                <label for="formFileLg" class="form-label">Book Cover images*</label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                    <input class="form-control input-lg form-control-lg mb-4" id="editimage1" type="file">
                                                    </div>
                                                    <div class="col-sm-6">
                                                    <input class="form-control input-lg form-control-lg mb-4" id="editimage2" type="file">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary"  id="btnupdate" onclick="update_book_data(event)">Update </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <!-- End EditBook Modal -->              
                              
                              <hr>
                              <thead>
                              <tr>
                                  <th><i class="fa fa-bullhorn"></i> ID#</th>
                                  <th><i class="fa fa-bullhorn"></i> Title</th>
                                  <th class="hidden-phone"><i class="fa fa-question-circle"></i> Author</th>
                                  <th><i class="fa fa-bookmark"></i> Category</th>
                                  <th><i class=" fa fa-edit"></i> Publisher</th>
                                  <th><i class=" fa fa-edit"></i> Date Published</th>
                                  <th><i class="fa fa-money"></i> Price</th>
                                  <th><i class="fa fa-check"></i> Available</th>
                                  <th><i class="fa fa-bookmark"></i> ISBN</th>
                                  <th><i class="fa fa-bookmark"></i> Cover 1</th>
                                  <th><i class="fa fa-bookmark"></i> Cover 2</th>
                                  <th><i class="fa fa-bookmark"></i> Entry Date</th>
                                  <th><i class=" fa fa-edit"></i> Action</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody id="book_table_body" style="font-size:14px;">

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

    //creating a form to get data through post
    let data = new FormData();

    let title = document.getElementById("title").value.trim();
    let authorSelect = document.querySelector('#author');
    let author  = authorSelect.options[authorSelect.selectedIndex].value;;
    let publishdate = document.getElementById("publishdate").value;

    let categorySelect = document.querySelector('#category');
    let category  = categorySelect.options[categorySelect.selectedIndex].value;

    let publisherSelect = document.querySelector('#publisher');
    let publisher  = publisherSelect.options[publisherSelect.selectedIndex].value;

    let price = document.getElementById("price").value.trim();
    let quantity = document.getElementById("quantity").value.trim();
    let isbn = document.getElementById("isbn").value.trim();
    
    
    //Front end validation - user input validation

    if(title == "" || !isNaN(title)){
        alert("Please enter a valid title");
        return ;
    }
    if(isNaN(author)){
        alert("Please select a author");
        return ;
    }
    if(isNaN(category)){
        alert("Please select a category");
        return ;
    }
    if(isNaN(publisher)){
        alert("Please select a publisher");
        return ;
    }

    if(price <= 0 || isNaN(price) || price <=1 ){
        alert("Please put appropriate price");
        return ;
    }
    if(quantity < 0 || isNaN(quantity) ){
        alert("Quantity can't be less than zero");
        return ;
    }

    let image1 = document.querySelector("#image1");
    let image2 = document.querySelector("#image2");
    if(image1.files.length == 0 ||image2.files.length == 0 ){
        alert("Please add a couple cover images ");
        return ;
    }


    data.append("title",title);
    data.append("author",author);
    data.append("category",category);
    data.append("publisher",publisher);
    data.append("publishdate",publishdate); 
    data.append("price",price);
    data.append("quantity",quantity);
    data.append("isbn",isbn);
    data.append("image1",image1.files[0]); 
    data.append("image2",image2.files[0]);     

    data.append("actionType","add_book");
 

    //call function and pass data
    send_data_files(data);

}

//Function passes data collected from forms  to ajax handling class
function send_data_files(data){
    var ajax = new XMLHttpRequest();
    ajax.addEventListener('readystatechange', function(){
        //check if there is response
        if(ajax.readyState == 4 && ajax.status == 200){
            //handle the response
            handle_results(ajax.responseText);
        }
    });
    //send data
    ajax.open("POST","<?=ROOT?>bookAjaxHandler", true);
    ajax.send(data); 
}


//Function that handles ajax response
function  handle_results(result)
{
      if(result!=="")
      {
        console.log(result);
        let obj = JSON.parse(result);
        if(typeof obj.actionType!=='undefined')
        {
            if(obj.actionType == "add_book")
            {
                if(obj.messageType == "info")
                {
                    clearForm();

                    
                    let book_table_body = document.getElementById("book_table_body");
                    book_table_body.innerHTML = obj.data;
                    alert("Book added successfully");
                }else
                {
                    alert(obj.message);
                }

            }else if(obj.actionType == "delete_book")
            {
                let book_table_body = document.getElementById("book_table_body");
                book_table_body.innerHTML = obj.data;
                // alert(obj.message);

            }else if(obj.actionType == "edit_book")
            {   
                let book_table_body = document.getElementById("book_table_body");
                book_table_body.innerHTML = obj.data;
                alert(obj.message);

            }

        }
    }

    function clearForm() {

        document.getElementById("title").value = "";
        document.querySelector('#author').selectedIndex = null;
        document.querySelector('#category').selectedIndex = null;
        document.querySelector('#publisher').selectedIndex = null;
        document.getElementById("publishdate").value = "";
        document.getElementById("price").value = 0.0;
        document.getElementById("quantity").value = 0;
        document.getElementById("isbn").value = "";
        document.querySelector('#image1').value = '';
        document.querySelector('#image2').value = '';
    }
 }


/**
 * Function to bring data to be edited
 * @param event e
 * @param number id
 * @returnvoid
 */
function edit_record(id, e){

    var info = e.currentTarget.getAttribute("info");
    // console.log("what the heck is info ", info);
    info = JSON.parse(info.replaceAll("'",'"')); //replace single quotes by double quotes to make it a proper json object
    info = JSON.parse(info);
    console.log(info);
    EDIT_ID = info.id;


    let title           = document.querySelector("#edittitle"); 

    let author    = document.querySelector('#editauthor');
    let category  = document.querySelector('#editcategory');
    let publisher = document.querySelector('#editpublisher');
  

    let publishdate     = document.querySelector("#editpublishdate");   
    let price           = document.querySelector("#editprice");
    let quantity        = document.querySelector("#editquantity");
    let isbn            = document.querySelector("#editisbn");
    //view what images were uploaded in the past
    let js_image1= document.querySelector(".js-image1");
    // js_image1.innerHTML = `<img src="<?=ROOT?>${info.image1}" />` ;

    let js_image2= document.querySelector(".js-image2");
    // js_image2.innerHTML = `<img src="<?=ROOT?>${info.image2}" />` 
    

    title.value            = info.title;
    author.value           = info.author;
    category.value         = info.category;
    publisher.value        = info.publisher;
    publishdate.value      = info.publishdate;
    price.value            = info.price;
    quantity.value         = info.quantity;
    isbn.value             = info.isbn;
    let editimage1         = document.querySelector("#editimage1");
    let editimage2         = document.querySelector("#editimage2");
    editimage1.files[0]    = info.editimage1;
    editimage2.files[0]    = info.editimage2

}

//Function to update the book data - make changes to the database
function update_book_data(e){



    //creating a form to get data through post
    let data = new FormData();

    let title = document.getElementById("edittitle").value.trim();
    let authorSelect = document.querySelector('#editauthor');
    let author  = authorSelect.options[authorSelect.selectedIndex].value;;
    let publishdate = document.getElementById("editpublishdate").value;

    let categorySelect = document.querySelector('#editcategory');
    let category  = categorySelect.options[categorySelect.selectedIndex].value;

    let publisherSelect = document.querySelector('#editpublisher');
    let publisher  = publisherSelect.options[publisherSelect.selectedIndex].value;

    let price = document.getElementById("editprice").value.trim();
    let quantity = document.getElementById("editquantity").value.trim();
    let isbn = document.getElementById("editisbn").value.trim();


    //Front end validation - user input validation

    if(title == "" || !isNaN(title)){
        alert("Please enter a valid title");
        return ;
    }
    if(isNaN(author)){
        alert("Please select a author");
        return ;
    }
    if(isNaN(category)){
        alert("Please select a category");
        return ;
    }
    if(isNaN(publisher)){
        alert("Please select a publisher");
        return ;
    }

    if(price <= 0 || isNaN(price) || price <=1 ){
        alert("Please put appropriate price");
        return ;
    }
    if(quantity < 0 || isNaN(quantity) ){
        alert("Quantity can't be less than zero");
        return ;
    }


    //while updating even image 1 is optiona
    let image1 = document.querySelector("#editimage1");
    if(image1.files.length > 0 ){

        data.append("image1",image1.files[0]);
    }

    let image2 = document.querySelector("#editimage2");
    if(image2.files.length > 0 ){

        data.append("image1",image2.files[0]);
    }

    data.append("id",EDIT_ID); 
    data.append("title",title);
    data.append("author",author);
    data.append("category",category);
    data.append("publisher",publisher);
    data.append("publishdate",publishdate); 
    data.append("price",price);
    data.append("quantity",quantity);
    data.append("isbn",isbn);
    data.append("image1",image1.files[0]); 
    data.append("image2",image2.files[0]);   

    data.append("actionType","edit_book");

    //call function and pass data
    send_data_files(data);

}

//Function to delete a book data - make changes to the database
function delete_record(e,id){

    if(!confirm("Are you sure to delete the record?")){
        return; 
    }

    let formdata = new FormData();
    formdata.append("id",id);
    formdata.append("actionType","delete_book");
    send_data_files(formdata);

}




</script>

          

<?php
     $this->view('admin/adminfooter',$data);
?>