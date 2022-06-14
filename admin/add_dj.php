<?php
include('admin-nav-bar.php');
?>

<div class="">
    <div class="main-section">
        <div class="row">


            <div class="container" style="color: white; text-align: right; padding-top: 35px;" dir="rtl">




                <div class="row form-group">
                    <label for="driver_name">اسم الفرقة</label>
                    <input type="text" class="form-control" id="name" name="name" />
                </div>

                <div class="row form-group">
                    <label for="driver_name">التقييم</label>
                    <input type="text" class="form-control" id="rate" name="rate" />
                </div>

                <div class="row form-group">
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
                'rate' : $("#rate").val(),
                'price' : $("#price").val(),
            };

            $.ajax({
                url: '../database/admin/add_dj.php',
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