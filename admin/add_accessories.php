<?php
include('admin-nav-bar.php');
?>

<div class="">
    <div class="main-section">
        <div class="row">


            <div class="container" style="color: white; text-align: right; padding-top: 35px;" dir="rtl">
                <p class="text-right" style="color: greenyellow">
                    <?php
                    if (isset($_SESSION['Success'])) {
                        echo $_SESSION['Success'];
                        unset($_SESSION['Success']);

                    }
                    ?>
                </p>

                <p class="text-right" style="color: red">
                    <?php
                    if (isset($_SESSION['Error'])) {
                        echo $_SESSION['Error'];
                        unset($_SESSION['Error']);

                    }
                    ?>
                </p>


                <div class="row form-group">
                    <div class="form-group col-12">
                        <label for="driver_name">نوع الاكسسوار</label>
                        <input type="text" class="form-control" id="name" name="name" />
                    </div>

                </div>



                <div class=" form-group">
                    <label>السعر</label>
                    <input type="text" class="form-control" id="price" name="price" />
                </div>



                <button  class="btn btn-primary" id="add">أضافة</button>

            </div>
        </div>
    </div>
</div>

</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {

        $('#add').on('click', function () {

            var content = {
                'name' : $("#name").val(),
                'price' : $("#price").val(),
            };

            $.ajax({
                url: '../database/admin/add_accessories.php',
                type: "post",
                data: content,
                success: function () {
                    alert("تمت الاضافة بنجاح")
                }, error: function (err) {
                    alert('فشلت العملية')
                }
            });
        });
    })
</script>