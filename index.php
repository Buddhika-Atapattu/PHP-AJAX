<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
    <?php
    

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        else{
            $page = 1;
        }
        $number = 4;
        $start = ($page - 1) * $number;
    ?>
</head>
<body>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <h1 id="text"></h1>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group my-4">
                            <input type="file" name="image" id="image" class="form-control" placeholder="Email" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-outline-success">Submit</button>
                        <!-- <input type="submit" value="submit" name="submit" id="submit" class="btn btn-outline-success"> -->
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-5">
        <div class="container" id="mydiv">
        </div>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>
    function submit(){
        alert("Hi")
    }

    $(document).ready(function(){
        <?php 
        if(isset($_GET['page'])){
            $count = $_GET['page'];
        }    
        else{
            $count = 1;
        }
        ?>
        let count = <?php echo $count?>;
        
        $.ajax({
            url:'infor.php',
            method:'POST',
            data:{count: count},
            dataType:'html',
            // processData:false,
            // contentType:false,
            // cache:false,
            success:(data)=>{
                
                // let item = JSON.parse(data);
                $('#mydiv').html(data);
                // console.log(data);
            },
        });
        $('form').submit(function(e){
            e.preventDefault();
            let formData = new FormData(this);
            formData.append('image',$('#image').get(0).files);
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
                    // console.log(data);
                    $('form').get(0).reset();
                    $('#mydiv').html(data);
                },
                error:(data)=>{
                    console.log('error => '+data)
                }
            });
        })
    })
</script>
</html>