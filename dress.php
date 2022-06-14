<?php
include('nav-bar.php');
?>

<div class="">
    <div class="main-section">
        <div class="row">

            <?php
            if (isset($_SESSION['Name'])) {
                echo '<input type="hidden" id="username" value="' . $_SESSION['Name'] . '">';
            }
            ?>

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
                    <div class="form-group col-6">
                        <label for="driver_name">اللون</label>
                        <select class="form-control" id="color">
                            <option>-- اختر اللون --</option>
                            <option value="احمر">احمر</option>
                            <option value="ابيض">ابيض</option>
                            <option value="اسود">اسود</option>
                            <option value="سُّكري">سُّكري</option>
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="driver_name">الحجم</label>
                        <select class="form-control" id="size">
                            <option>-- اختر الحجم --</option>
                            <option value="s">s</option>
                            <option value="m">m</option>
                            <option value="l">l</option>
                            <option value="xl">xl</option>
                            <option value="xxl">xxl</option>
                        </select>
                    </div>
                </div>


                <div class="row form-group">
                    <div class="form-group col-6">
                        <label for="driver_name">نوع القماش</label>
                        <select class="form-control" id="type">
                            <option>-- اختر نوع القماش --</option>
                            <option value="دانتيل">دانتيل</option>
                            <option value="ستان">ستان</option>
                            <option value="شيفون">شيفون</option>
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="driver_name">الصناعة</label>

                        <?php

                        $dress = getDress();
                        echo '<select class="form-control" id="industry_select">';
                        echo '<option>-- اختر الصناعة --</option>';
                        foreach ($dress as $item) {
                            echo "<option value='" . $item['id'] . "' data-price='". $item['price'] ."' value='". $item['industry'] ."'>" . $item['industry'] . "</option>";
                        }
                        echo '</select>';

                        ?>

                    </div>
                </div>

                <div class="row form-group">
                    <div class="form-group col-6">
                        <label for="driver_name">عدد مرات الاستأجار</label>
                        <input type="text" class="form-control" id="usage" name="usage" readonly>
                    </div>
                </div>

                <div class=" form-group">
                    <label>السعر</label>
                    <input type="text" class="form-control" id="price" name="price" readonly>
                </div>

                <div class="row form-group">
                    <div class="col-6">
                        <label for="start_at">وقت بداية الحجز</label>
                        <input type="datetime-local" class="form-control" id="start_at" name="start_at" required>
                    </div>
                    <div class="col-6">
                        <label for="end_at">وقت نهاية الحجز</label>
                        <input style="text-align: left" type="datetime-local" class="form-control" id="end_at"
                               name="end_at" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="cost">ملاحظات</label>
                    <textarea class="form-control" rows="3" id="note"></textarea>
                </div>

                <div class="row form-group">
                    <label for="driver_name">صور من أعمالنا</label>
                </div>
                <div class="row form-group">
                    <div class="col-4">
                        <img src="imgs/dress1.jpg" style="width: 100%; height: 300px">
                    </div>
                    <div class="col-4">
                        <img src="imgs/dress2.jpg" style="width: 100%; height: 300px">
                    </div>
                    <div class="col-4">
                        <img src="imgs/dress3.jpg" style="width: 100%; height: 300px">
                    </div>
                </div>

                <?php
                if (isset($_SESSION['email'])) {
                    echo '<button type="submit" class="btn btn-primary" id="reserve">تسجيل الحجز</button>';
                }
                ?>

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
        $('#industry_select').on('change', function () {
            var price = $("#industry_select  option:selected").attr('data-price');
            $('#price').val(price);
        });

        $('#reserve').on('click', function () {

            var content = {
                'اسم ألزبون': $("#username").val(),
                'اللون': $("#color option:selected").text(),
                'الحجم': $("#size option:selected").text(),
                'نوع القماش': $("#type option:selected").text(),
                'الصناعة': $("#industry_select option:selected").text(),
                'عدد مرات الاستأجار': 0,
                'وقت بداية الحجز': $('#start_at').val(),
                'وقت نهاية الحجز': $('#end_at').val(),
                'ملاحظات': $('#note').val(),
            };

            $.ajax({
                url: 'database/createReservation.php',
                type: "post",
                data: {
                    "type": "dress",
                    "type_id": 0,
                    "price": $('#price').val(),
                    "content": JSON.stringify(content),
                },
                success: function (data) {
                    alert(data)
                }
            });
        });


        $('#size, #color, #type, #industry_select').on('change', function () {
            var info = {
                'اللون':  $("#color option:selected").text(),
                'الحجم': $("#size option:selected").text(),
                'نوع القماش': $("#type option:selected").text(),
                'الصناعة': $("#industry_select option:selected").text(),
            }

            $.ajax({
                url: 'database/CheckUsageOfDresses.php',
                type: "post",
                data: {
                    "info": JSON.stringify(info),
                },
                success: function (data) {
                    $('#usage').val(data)
                }
            });


        });


    })
</script>

<?php
function getDress()
{

    require_once('database/connection.php');
    $conn = getConnection();

    $query = "SELECT * FROM `dress`;";

    $result = $conn->query($query);
    $cake = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($cake,
                [
                    "id" => $row["id"],
                    "industry" => $row["industry"],
                    "price" => $row["price"],
                ]
            );
        }
    }
    return $cake;
}

?>