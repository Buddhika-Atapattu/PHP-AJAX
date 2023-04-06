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
    $count = $_POST['count'];
}
else{
    $count = 1;
}


    

$number = 9;
$start = ($count - 1) * $number;



$select = "SELECT * FROM image img ORDER BY img.id DESC LIMIT $start,$number";
$allImages = "SELECT * FROM image";
$result2 = $con->query($allImages);
$result = $con->query($select);
$rows = mysqli_num_rows($result2);
$totalPage = ceil($rows/$number);
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

$html .= '</div><div class="d-flex justify-content-end my-3"><ul class="d-inline-flex">';
for($i=1; $i <= $totalPage; $i++){
    // $html .= '<li class="list-group-item border-0 p-0">'.
    // ' <a class="text-decoration-none d-block text-light btn btn-dark mx-2" href="index.php?page='.$i.'">'.$i.'<a>'.
    // '</li>';
    $onclick = "window.location.href='index.php?page=".$i."'";
    $html .= '<li class="list-group-item border-0 p-0"><button class="btn btn-outline-dark mx-2" id="btn_'.$i.'" onclick="'.$onclick.'">'.$i.'</button></li>';
    
}

echo $html .= '</ul></div>';

// $data = array(
//     'html'=>$html,
//     'row'=>$rows,
//     'totalPage'=>$totalPage,
//     'count'=>$count,
//     'number'=>$number
// );

// echo json_encode($data);




