<?php
/*
Pagination without reloading
Normal pagination we are passing page number as a parameter of the URL, if we pass the page number with the URL then the page will reload only
if we go to the next page, in our case when we nagivate to the next page, the current doesn't need to be refreshed, for this we need to use Ajax.
What I did here is first I fetched the page number using Ajax, then I assigned the page number to the variable, secondly I defined the item per
page. 


*/
// include image class and database connection
include('../classes/image.php');
// defined class object
$image = new Images();

// output
$html = "";

// image uploading
if(isset($_POST['image'])){
    $file = $_FILES['image'];
    $image->insertImage($file);
}
// end image uploading

// image deletion
(int)$imageId = (isset($_POST['image_id'])) ? trim($_POST['image_id']) : 0; 
$image->deleteImage($imageId);
// end image deletion


// checking the page number
$page = (isset($_POST['count'])) ? trim($_POST['count']) : 1;

// define search input
$search = (isset($_POST['search']) && (trim($_POST['search']) !== "")) ? trim($_POST["search"]) : "";

// define the item per page
$numbersPerPage = 3;

// define the starting from the database
$startFrom = ($page - 1) * $numbersPerPage;

// echo $search."<br>";

// search query
$searchSql = "SELECT * FROM image img WHERE img.uid LIKE '%$search%' ORDER BY img.id DESC LIMIT $startFrom,$numbersPerPage";

$searchSQLALL = "SELECT * FROM image img WHERE img.uid LIKE '%$search%'";

$searchResult = $con -> query($searchSQLALL);

$searchRow = $searchResult->num_rows;

// search result
$searchResult = $con->query($searchSql);

// print_r($searchResult);

// select images per page from database
$selectImages = "SELECT * FROM image img ORDER BY img.id DESC LIMIT $startFrom,$numbersPerPage";

// run query
$result = $con->query($selectImages);

// select all images from database
$allImages = (isset($_POST["search"])) ? "SELECT * FROM image img WHERE img.uid LIKE '%$search%'" : "SELECT * FROM image";

// run query
$rowsResult = $con->query($allImages);

// get tebal rows
$rows = $rowsResult->num_rows;

// get round number
$totalPages = ceil($rows/$numbersPerPage);

// restrincting the page above total pages
if($page > $totalPages){
    $page = 1;
}

/*
01. In this section I have defined how many numbers there are per pre / post page by variable name $link.
02. Get the past page number, assigning $totalPages to variable name $last
03. Defined start pagination number by $startLink
04. Defined end pagination number by $endLink
*/

$link = 1;

$last = (isset($_POST['search'])) ? $searchRow : $totalPages ;

$startLink = (($page - $link) > 0 ) ? $page - $link : 1;

$endLink = (($page + $link) < $last) ? $page + $link : $last;

// assign the value for the variable last page - link amount
(int)$lastPreNumber = ((int)($totalPages - $link) == $page) ? $page : $totalPages - $link;

// define page number
$html .= '<input type="hidden" id="page_id" name="page_id" value="'.(int)$page.'" class="d-none">';

if($search !== ""){
    // images
    $html .= '<div class="row">';
    while($resultRow = $searchResult->fetch_assoc()){
        // image col
        $html .=  '<div class="col-lg-4 card border-0 p-0">'.
            '<img id="image_'.$resultRow['id'].'"  alt="" class="card-image-top h-100 btn border-0" src="'. $resultRow['image_url'] .'">'.
            '<ul class="d-inline-flex z-index-1 mt-3 me-3">
                <li class="btn btn-info mx-1" id="img_'.$resultRow['id'].'">
                    <i class="fa fa-eye"></i>
                </li>
                <li class="btn btn-danger mx-1" id="delete_btn_'.$resultRow['id'].'">
                    <i class="fa fa-trash"></i>
                </li>
            </ul>'.
            '<p>'. $resultRow['uid'] .'</p>'.
        '</div>';
        // end image col

        // full screen image
        $html .='<script>
        $(document).ready(()=>{
            $("#delete_btn_'.$resultRow['id'].'").on("click",()=>{
                let image_'.$resultRow['id'].' = '.$resultRow['id'].';

                $.ajax({
                    url:"infor.php",
                    method:"POST",
                    data:{image_id: image_'.$resultRow['id'].'},
                    dataType:"html",
                    success:(data)=>{
                        $("#mydiv").html(data);
                    },
                });
            });
            $("#img_'.$resultRow['id'].'").on("click",()=>{
                let image = $("#image_'.$resultRow['id'].'").get(0);
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
}
else{
    // images
    $html .= '<div class="row">';
    while($resultRow = $result->fetch_assoc()){
        // image col
        $html .=  '<div class="col-lg-4 card border-0 p-0">'.
            '<img id="image_'.$resultRow['id'].'" alt="" class="card-image-top h-100 btn border-0" src="'. $resultRow['image_url'] .'">'.
            '<ul class="d-inline-flex z-index-1 mt-3 me-3">
                <li class="btn btn-info mx-1" id="img_'.$resultRow['id'].'">
                    <i class="fa fa-eye"></i>
                </li>
                <li class="btn btn-danger mx-1" id="delete_btn_'.$resultRow['id'].'">
                    <i class="fa fa-trash"></i>
                </li>
            </ul>'.
            '<p>'. $resultRow['uid'] .'</p>'.
        '</div>';
        // end image col

        // full screen image
        $html .='<script>
        $(document).ready(()=>{
            $("#delete_btn_'.$resultRow['id'].'").on("click",()=>{
                let image_'.$resultRow['id'].' = '.$resultRow['id'].';

                $.ajax({
                    url:"infor.php",
                    method:"POST",
                    data:{image_id: image_'.$resultRow['id'].'},
                    dataType:"html",
                    success:(data)=>{
                        $("#mydiv").html(data);
                    },
                });
            });

            $("#img_'.$resultRow['id'].'").on("click",()=>{
                let image = $("#image_'.$resultRow['id'].'").get(0);
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
}




if($rows !== 0){
    
    // pagination
    $html .= '</div><div class="d-flex justify-content-end my-3"><ul class="d-inline-flex" id="pagination">';

    // left arrow, page one and, left more indicator 
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
                let search = $("#search").val();
                
                $.ajax({
                    url:"infor.php",
                    method:"POST",
                    data:{count: page,search:search},
                    dataType:"html",
                    success:(data)=>{
                        $("#mydiv").html(data);
                    },
                });
            });
        });
        </script>';
        //end left arrow function

        //page number one
        $html .= '<li class="list-group-item border-0 p-0">
        <button class="btn btn-outline-dark mx-2" id="btn_1">1</button>
        <input type="hidden" id="btn_input_1" value="1">
        </li>';
        
        // page number one script function
        $html .= '<script> 
        $(document).ready(()=>{
            

            $("#btn_1").on("click",function(){
                
                let page = $("#btn_input_1").val();
                let search = $("#search").val();
                
                $.ajax({
                    url:"infor.php",
                    method:"POST",
                    data:{count: page,search:search},
                    dataType:"html",
                    success:(data)=>{
                        $("#mydiv").html(data);
                    },
                });
            });

            
        });
        </script>';
        //end page number one
        
        // defined left side more indicator
        $html .= '<li class="list-group-item border-0 p-0">
                <button class="btn btn-outline-dark mx-2">....</button>
                </li>';
        // end defined left side more indicator
        
    }
    // end left arrow, page one and, left more indicator 


    // pagination for loop
    for($i=$startLink; $i <= $endLink; $i++){
        // if $i equal to one this condition will skip
        if(((int)$page !== 1) && ($i == 1)){
            continue;
        }
        // if $i equal to max number this condition will end the loop
        if(((int)$page !== $totalPages) && ($i == $totalPages)){
            break;
        }

        // if $page equal to $i then page indicator background will be dark
        if($i == $page){
            $html .= '<li class="list-group-item border-0 p-0">
            <button class="btn btn-dark mx-2" id="btn_'.$i.'">'.$i.'</button>
            <input type="hidden" id="btn_input_'.$i.'" value="'.$i.'">
            </li>
            ';
        }
        // else page indicator border will be dark and background will be transparent
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
                let search = $("#search").val();
                
                $.ajax({
                    url:"infor.php",
                    method:"POST",
                    data:{count: page,search:search},
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
    // end pagination for loop


    // checking whether $lastPreNumber is smaller than last page number and $lastPreNumber smaller than and equal to current page number
    if(($lastPreNumber < (int)$totalPages) && ($lastPreNumber <= $page)){
        $html .= '<li class="list-group-item border-0 p-0">
        <button class="btn btn-outline-dark mx-2" id="btn_'.$totalPages.'">'.$totalPages.'</button>
        <input type="hidden" id="btn_input_'.$totalPages.'" value="'.$totalPages.'">
        </li>';

        $html .= '<script> 
        $(document).ready(()=>{
            

            $("#btn_'.$totalPages.'").on("click",function(){
                
                let page = $("#btn_input_'.$totalPages.'").val();
                let search = $("#search").val();
                
                $.ajax({
                    url:"infor.php",
                    method:"POST",
                    data:{count: page,search:search},
                    dataType:"html",
                    success:(data)=>{
                        $("#mydiv").html(data);
                    },
                });
            });

            
        });
        </script>';
    }


    // right arrow, page one and, left more indicator 
    if(((int)($lastPreNumber) > (int)$page)){
    // right more indicator
        $html .= '<li class="list-group-item border-0 p-0">
            <button class="btn btn-outline-dark mx-2">....</button>
            </li>';
    // end right more indicator

    // last page button
        $html .= '<li class="list-group-item border-0 p-0">
            <button class="btn btn-outline-dark mx-2" id="btn_'.$totalPages.'">'.$totalPages.'</button>
            <input type="hidden" id="btn_input_'.$totalPages.'" value="'.$totalPages.'">
            </li>';
        
        $html .= '<script> 
        $(document).ready(()=>{
            

            $("#btn_'.$totalPages.'").on("click",function(){
                
                let page = $("#btn_input_'.$totalPages.'").val();
                let search = $("#search").val();
                
                $.ajax({
                    url:"infor.php",
                    method:"POST",
                    data:{count: page,search:search},
                    dataType:"html",
                    success:(data)=>{
                        $("#mydiv").html(data);
                    },
                });
            });

            
        });
        </script>';
        // end page button

        // right arrow button
        $html .= '<li class="list-group-item border-0 p-0">
                <button class="btn btn-outline-dark mx-2" id="btn_right"><i class="fa fa-angle-right"></i></button>
                </li>';
        //end right arrow button

        //right arrow button ajax function
        $html .= '<script> 
        $(document).ready(()=>{
            let paginationCount;

            $("#btn_right").on("click",function(){
                
                let page = '.$page.'+1;
                let search = $("#search").val();
                
                $.ajax({
                    url:"infor.php",
                    method:"POST",
                    data:{count: page,search:search},
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
    // end right arrow, page one and, left more indicator 

    $html .= '</ul></div>';
    // end pagination
}

// print output
echo $html;





