<?php
/*
Pagination without reloading
Normal pagination we are passing page number as a parameter of the URL, if we pass the page number with the URL then the page will reload only
if we go to the next page, in our case when we nagivate to the next page, the current doesn't need to be refreshed, for this we need to use Ajax.
What I did here is first I fetched the page number using Ajax, then I assigned the page number to the variable, secondly I defined the item per
page. 


*/
// database connection
$con = mysqli_connect('localhost','root','','testdb');


// uploading image to the database
if(isset($_POST['image'])){
    $file = $_FILES['image']['name'];

    if($file !== ""){
        $fileName = hexdec(uniqid()).'.png';
        $exe = pathinfo($fileName,PATHINFO_EXTENSION);
        $path = './image/';
        $fileTemName = $_FILES['image']['tmp_name'];
        
        $move = move_uploaded_file($fileTemName,$path.$fileName);
        $filePath = $path.$fileName;

        if($move == true){
            $sql = "INSERT INTO image(image_url) VALUES ('$filePath')";
            $result = $con->query($sql);
            if($result == true){
                
            }
        }
    }
}


// checking the page number
if(isset($_POST['count'])){
    $page = $_POST['count'];
}
else{
    $page = 1;
}


// define the item per page
$numbersPerPage = 3;

// define the starting from the database
$startFrom = ($page - 1) * $numbersPerPage;

// select images per page from database
$selectImages = "SELECT * FROM image img ORDER BY img.id DESC LIMIT $startFrom,$numbersPerPage";

// run query
$result = $con->query($selectImages);

// select all images from database
$allImages = "SELECT * FROM image";

// run query
$rowsResult = $con->query($allImages);

// get tebal rows
$rows = mysqli_num_rows($rowsResult);

// get round number
$totalPages = ceil($rows/$numbersPerPage);

// restrincting the page above total pages
if($page > $totalPages){
    $page = 1;
}

// output
$html = "";

// define page number
$html .= '<input type="hidden" id="page_id" name="page_id" value="'.(int)$page.'" class="d-none">';

// images
$html .= '<div class="row">';
while($resultRow = $result->fetch_assoc()){
    // image col
    $html .=  '<div class="col-lg-4 card p-0">'.
        '<img id="img_'.$resultRow['id'].'"  alt="" class="card-image-top h-100 btn border-0" src="'. $resultRow['image_url'] .'">'.
    '</div>';
    // end image col

    // full screen image
    $html .='<script>
    $(document).ready(()=>{
        $("#img_'.$resultRow['id'].'").on("click",()=>{
            let image = $("#img_'.$resultRow['id'].'").get(0);
            if (image.requestFullscreen) {
                image.requestFullscreen();
            } else if (image.webkitRequestFullscreen) { /* Safari */
                image.webkitRequestFullscreen();
            } else if (image.msRequestFullscreen) { /* IE11 */
                image.msRequestFullscreen();
            }
        });
    });
    </script>';
    // end full screen
}
$html .= '</div>';
// end images

// pagination
$html .= '</div><div class="d-flex justify-content-end my-3"><ul class="d-inline-flex" id="pagination">';
// left arrow
if((int)$page !== 1){
    //left arrow button
    $html .= '<li class="list-group-item border-0 p-0">
            <button class="btn btn-outline-dark mx-2" id="btn_left"><i class="fa fa-angle-left"></i></button>
            </li>';
    //left arrow button end
    //left arrow ajax function when button clicked
    $html .= '<script> 
    $(document).ready(()=>{
        $("#btn_left").on("click",function(){
            
            let page = '.$page.'-1;
            
            $.ajax({
                url:"infor.php",
                method:"POST",
                data:{count: page},
                dataType:"html",
                success:(data)=>{
                    $("#mydiv").html(data);
                },
            });
        });
    });
    </script>';
    //end left arrow function
}
// end left arrow

// pagination numbers

for($i=1; $i <= $totalPages; $i++){

    if($i == $page){
        $html .= '<li class="list-group-item border-0 p-0">
        <button class="btn btn-dark mx-2" id="btn_'.$i.'">'.$i.'</button>
        <input type="hidden" id="btn_input_'.$i.'" value="'.$i.'">
        </li>
        ';
    }
    else{
        $html .= '<li class="list-group-item border-0 p-0">
        <button class="btn btn-outline-dark mx-2" id="btn_'.$i.'">'.$i.'</button>
        <input type="hidden" id="btn_input_'.$i.'" value="'.$i.'">
        </li>';
    }
    //ajax function for pagination number buttons
    $html .= '<script> 
    $(document).ready(()=>{
        $("#btn_'.$i.'").on("click",function(){
            
            let page = $("#btn_input_'.$i.'").val();
            
            $.ajax({
                url:"infor.php",
                method:"POST",
                data:{count: page},
                dataType:"html",
                success:(data)=>{
                    $("#mydiv").html(data);
                },
            });
        });

        
    });
    </script>';
    // end 
    
}



// end pagination numbers

// right arrow
if((int)$page !== (int)$totalPages){
//right arrow button
    $html .= '<li class="list-group-item border-0 p-0">
            <button class="btn btn-outline-dark mx-2" id="btn_right"><i class="fa fa-angle-right"></i></button>
            </li>';
//end right arrow button
//right arrow button ajax function
    $html .= '<script> 
    $(document).ready(()=>{
        $("#btn_right").on("click",function(){
            
            let page = '.$page.'+1;
            
            $.ajax({
                url:"infor.php",
                method:"POST",
                data:{count: page},
                dataType:"html",
                success:(data)=>{
                    $("#mydiv").html(data);
                },
            });
        });
    });
    </script>';
//end right arrow ajax function
}
// end right arrow

// display output
$html .= '</ul></div>';

// slider option

// display
echo $html;





