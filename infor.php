<?php
$con = mysqli_connect('localhost','root','','testdb');



if(isset($_POST['image'])){
    $file = $_FILES['image']['name'];

    // print_r($file);

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



if(isset($_POST['count'])){
    $page = $_POST['count'];
}
else{
    $page = 1;
}


$numbersPerPage = 9;

$startFrom = ($page - 1) * $numbersPerPage;

$selectImages = "SELECT * FROM image img ORDER BY img.id DESC LIMIT $startFrom,$numbersPerPage";

$result = $con->query($selectImages);

$rows2 = mysqli_num_rows($result);

$allImages = "SELECT * FROM image";

$rowsResult = $con->query($allImages);

$rows = mysqli_num_rows($rowsResult);

$totalPages = ceil($rows/$numbersPerPage);


$html = "";
$html .= '<div class="row">';
while($resultRow = $result->fetch_assoc()){
    $html .=  '<div class="col-lg-4 card p-0">'.
        '<img id="img_'.$resultRow['id'].'"  alt="" class="card-image-top h-100 btn border-0" src="'. $resultRow['image_url'] .'">'.
    '</div>';
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
}




$html .= '</div><div class="d-flex justify-content-end my-3"><ul class="d-inline-flex" id="pagination">';
// $html .= '<script>let pageArray = [];</script>';
for($i=1; $i <= $totalPages; $i++){
    $onclick = "window.location.href='index.php?page=".$i."'";
    // $html .= '<li class="list-group-item border-0 p-0"><button class="btn btn-outline-dark mx-2" id="btn_'.$i.'" onclick="'.$onclick.'">'.$i.'</button></li>';
    $html .= '<li class="list-group-item border-0 p-0">
    <button class="btn btn-outline-dark mx-2" id="btn_'.$i.'">'.$i.'</button>
    <input type="hidden" id="btn_input_'.$i.'" value="'.$i.'">
    </li>';
    $html .= '<script> 
    $(document).ready(()=>{
        $("#btn_'.$i.'").on("click",function(){
            
            let page = $("#btn_input_'.$i.'").val();
            
            $.ajax({
                url:"infor.php",
                method:"POST",
                data:{count: page},
                dataType:"html",
                // processData:false,
                // contentType:false,
                // cache:false,
                success:(data)=>{
                    
                    // let item = JSON.parse(data);
                    $("#mydiv").html(data);
                    // console.log(data);
                },
            });
        });
    });
     </script>';
}
// $html .= '<script>console.log(pageArray)</script>';
$html .= '<input type="hidden" value="'.$page.'" id="page_number">';

echo $html .= '</ul></div>';





