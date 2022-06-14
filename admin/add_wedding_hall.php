<?php
include('admin-nav-bar.php');
?>

<div class="">
    <div class="main-section">
        <div class="row">


            <div class="container" style="color: white; text-align: right; padding-top: 35px;" dir="rtl">

                <form action="../database/admin/add_wedding_hall.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="driver_name">اسم الصالة</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="form-group">
                        <label for="driver_name">صور الصالة الداخلي</label>
                        <input type="file" id="in" name="in[]" multiple>
                    </div>

                    <div class="form-group">
                        <label for="driver_name">صور الصالة الخارجي</label>
                        <input type="file" id="out" name="out[]" multiple>
                    </div>


                    <div class="row form-group">
                        <div class="col-6">
                            <label>عدد الكراسي</label>
                            <input type="number" class="form-control" id="number_of_chair" name="number_of_chair">
                        </div>
                        <div class="col-6">
                            <label>المساحة</label>
                            <input style="text-align: left" type="text" class="form-control" id="area"
                                   name="area">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-6">
                            <label>السعر</label>
                            <input type="text" class="form-control" id="price" name="price">
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary" value="إضافة">

<!--                    <button class="btn btn-primary" id="add">أضافة</button>-->
                </form>
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


            var data = new FormData();
            data.append('name', $("#name").val());
            data.append('number_of_chair', $("#number_of_chair").val());
            data.append('area', $("#area").val());
            data.append('price', $("#price").val());
            data.append('in', document.getElementById("in").files);
            data.append('out', $("#out").val());


            $.ajax({
                url: '../database/admin/add_wedding_hall.php',
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                success: function () {
                    alert("تمت الاضافة بنجاح")
                }, error: function (err) {
                    alert('فشلت العملية')
                }
            });
        });
    })
</script>