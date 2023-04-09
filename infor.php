<?php
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
$numbersPerPage = 9;

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

// output
$html = "";

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
    
    $html .= '<li class="list-group-item border-0 p-0">
            <button class="btn btn-outline-dark mx-2" id="btn_left"><i class="fa fa-angle-left"></i></button>
            </li>';
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
}
// end left arrow

// pagination numbers
for($i=1; $i <= $totalPages; $i++){
    if($i == $page){
        $html .= '<li class="list-group-item border-0 p-0">
        <button class="btn btn-dark mx-2" id="btn_'.$i.'">'.$i.'</button>
        <input type="hidden" id="btn_input_'.$i.'" value="'.$i.'">
        </li>';
    }
    else{
        $html .= '<li class="list-group-item border-0 p-0">
        <button class="btn btn-outline-dark mx-2" id="btn_'.$i.'">'.$i.'</button>
        <input type="hidden" id="btn_input_'.$i.'" value="'.$i.'">
        </li>';
    }
    
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
}
// end pagination numbers

// right arrow
if((int)$page !== (int)$totalPages){
    $html .= '<li class="list-group-item border-0 p-0">
            <button class="btn btn-outline-dark mx-2" id="btn_right"><i class="fa fa-angle-right"></i></button>
            </li>';
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
}
// end right arrow

// display output
echo $html .= '</ul></div>';





