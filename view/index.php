<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        .z-index-1{
            position: absolute;
            top: 0;
            right: 0;
            z-index: 1;
        }
        .z-index-0{
            position: absolute;
            z-index: 0;
        }
    </style>
    <script>
        // fetching image data

        // define page as 1
        let count = 1;
        //using ajax function getting data for first page
        $.ajax({
            url:"infor.php",
            method:"POST",
            data:{count: count},
            dataType:"html",
            success:(data)=>{
                $("#mydiv").html(data);
            },
        });
        // end
        
    </script>
</head>
<body>
    <!-- image uploading -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="d-flex justify-content-center">
                        <form action="" method="post" enctype="multipart/form-data" id="image_form">
                            <div class="form-group my-4">
                                <div class="input-group">
                                    <label for="image" class="btn btn-outline-primary rounded" id="select_img_btn">Select Image</label>
                                    <input type="file" name="image" id="image" class="form-control d-none rounded" placeholder="Email" accept="image/*">
                                    <div class="input-group-text border-0 bg-white pe-0 pt-0 pb-0 m-0">
                                        <button type="submit" id="submit" class="btn btn-outline-success rounded-right">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end uploading -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto d-flex justify-content-center" id="imagepre"></div>
            </div>
        </div>
    </section>
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto my-3">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search...">
                </div>
            </div>
        </div>
    </section>

    <!-- display images -->
    <section class="mt-5">
        <!-- ajax result showing container -->
        <div class="container" id="mydiv"></div>
        <!-- end container -->
    </section>
    <!-- end -->
    
</body>
<script>
    // form submitting using ajax
    $(document).ready(function(){
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
        // search script
        $("#search").keyup(()=>{
            let search = $("#search").val();

            $.ajax({
                url:'infor.php',
                method:'POST',
                dataType:'html',
                data:{search:search},
                beforeSend:(data)=>{
                    console.log('beforeSend => '+ data);
                },
                success:(data)=>{
                    $('form').get(0).reset();
                    $('#mydiv').html(data);
                },
                error:(data)=>{
                    console.log('error => '+data)
                }
            });
        })

        $("#image").on("change",()=>{
            let file = $("#image")[0].files[0];
            let fileLength = $("#image").get(0).files.length;
            let fileName = file.name;
            let reader = new FileReader();
            if(fileLength === 1){
                $("#submit").attr('disabled',false);
                $("#select_img_btn").removeClass("btn-outline-primary");
                $("#select_img_btn").addClass("btn-primary");
                $("#select_img_btn").text("Image has been selected file name is " + fileName);
                reader.onload = (e)=>{
                    let url = e.target.result;
                    console.log(url);
                    $("#imagepre").html('<img class="card-top-image w-50 mx-auto" alt="image preview" src="'+ url +'">');
                }
                reader.onerror = function(e) {
                    alert("I AM ERROR: " + e.target.error.code);
                };
                reader.readAsDataURL(file);
            }
            
        });

        // image uploading
        $('#image_form').submit(function(e){

            e.preventDefault();
            let formData = new FormData(this);
            let file = $("#image")[0].files[0];
            let fileLength = $("#image").get(0).files.length;
            let fileName = file.name;
            formData.append('image',$('#image').get(0).files);
            if(fileLength !== 0){
                $.ajax({
                    url:'infor.php',
                    method:'POST',
                    dataType:'html',
                    data:formData,
                    processData:false,
                    contentType:false,
                    cache:false,
                    beforeSend:(data)=>{
                        console.log('beforeSend => '+data);
                    },
                    success:(data)=>{
                        $('#mydiv').html(data);
                        $("#imagepre").html("");
                        $("#select_img_btn").removeClass("btn-outline-primary btn-primary");
                        $("#select_img_btn").addClass("btn-success");
                        $("#select_img_btn").text("Image has been uploaded!");
                        let reset = $('form')[0].reset();
                        let timeOut = setTimeout(()=>{
                            
                            $("#select_img_btn").removeClass("btn-primary btn-success");
                            $("#select_img_btn").addClass("btn-outline-primary");
                            $("#select_img_btn").text("Select Image");
                            if(reset){
                                $("#submit").attr('disabled',false);
                            
                                console.log(fileLength);
                            }
                            else{
                                $("#submit").attr('disabled',true);
                            }
                        },3000);
                        // $('#image_form').get(0).reset();
                        
                    },
                    error:(data)=>{
                        console.log('error => '+data)
                    }
                });
            }
            
        });
    });
    // end
</script>
</html>