<?php
include ('nav-bar.php');
?>

<div class="" >
    <div class="main-section">
        <div class="row">

            <?php
            if (isset($_SESSION['Name'])) {
                echo '<input type="hidden" id="username" value="'. $_SESSION['Name'] .'">';
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
                            <label for="driver_name">نوع الورد</label>

                            <?php

                            $adornment = getAdornment();
                            echo '<select class="form-control" id="flower_type">';
                            echo '<option>-- اختر نوع الورد --</option>';
                            foreach ($adornment as $item) {
                                echo "<option value='" . $item['id'] . "' data-price='". $item['price'] ."' value='". $item['name'] ."'>" . $item['name'] . "</option>";
                            }
                            echo '</select>';

                            ?>


<!--                            <select class="form-control" id="flower_type">-->
<!--                                <option>-- اختر نوع الورد --</option>-->
<!--                                <option value="مجفف" data-price="150">مجفف</option>-->
<!--                                <option value="طبيعي" data-price="300">طبيعي</option>-->
<!--                                <option value="صناعي" data-price="100">صناعي</option>-->
<!--                            </select>-->
                        </div>

                        <div class="form-group col-6">
                            <label for="driver_name">اسم الورد</label>
                            <select class="form-control" id="flower_name">
                                <option>-- اختر اسم الورد --</option>
                                <option value="جوري">جوري</option>
                                <option value="توليب">توليب</option>
                                <option value="أقحوان">أقحوان</option>
                                <option value="العنبر">العنبر</option>
                                <option value="الياسمين">الياسمين</option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="form-group col-6">
                            <label for="driver_name">شكل الورد</label>
                            <select class="form-control" id="flower_shape">
                                <option>-- اختر شكل الورد --</option>
                                <option value="مفتح">مفتح</option>
                                <option value="مسكر">مسكر</option>
                                <option value="منقط">منقط</option>
                            </select>
                        </div>

                        <div class="form-group col-6">
                            <label for="driver_name">اللون</label>
                            <select class="form-control" id="color">
                                <option>-- اختر اللون --</option>
                                <option value="زهري">زهري</option>
                                <option value="أصفر">أصفر</option>
                                <option value="برتقالي">برتقالي</option>
                                <option value="أحمر">أحمر</option>
                                <option value="أبيض">أبيض</option>
                                <option value="أسود">أسود</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="start_at">وقت الحجز</label>
                        <input type="datetime-local" class="form-control" id="start_at" name="start_at"
                               required>
                    </div>

                    <div class=" form-group">
                        <label>السعر</label>
                        <input type="text" class="form-control" id="price" name="price" readonly>
                    </div>

                    <div class="form-group">
                        <label for="cost">ملاحظات</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>

                    <div class="row form-group">
                        <label for="driver_name">صور من أعمالنا</label>
                    </div>
                    <div class="row form-group">
                        <div class="col-4">
                            <img src="imgs/adornment1.jpg" style="width: 100%; height: 300px">
                        </div>
                        <div class="col-4">
                            <img src="imgs/adornment2.jpg" style="width: 100%; height: 300px">
                        </div>
                        <div class="col-4">
                            <img src="imgs/adornment3.jpg" style="width: 100%; height: 300px">
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
    $(document).ready(function (){
        $('#flower_type').on('change', function () {
            var price = $("#flower_type  option:selected").attr('data-price');
            $('#price').val(price);
        });




        $('#reserve').on('click', function () {

            var content = {
                'اسم ألزبون' : $("#username").val(),
                'نوع الورد' : $("#flower_type option:selected" ).text(),
                'اسم الورد' : $("#flower_name option:selected" ).text(),
                'شكل الورد' : $("#flower_shape option:selected" ).text(),
                'اللون' : $("#color option:selected" ).text(),
                'وقت الحجز' : $('#start_at').val(),
                'ملاحظات' : $('#note').val(),
            };

            $.ajax({
                url: 'database/createReservation.php',
                type: "post",
                data: {
                    "type": "adornment",
                    "type_id": $('#cake_select').val(),
                    "price": $('#price').val(),
                    "content": JSON.stringify(content),
                },
                success: function (data) {
                    alert(data)
                }
            });
        });

    })
</script>

<?php
function getAdornment()
{

    require_once('database/connection.php');
    $conn = getConnection();

    $query = "SELECT * FROM `adornment`;";

    $result = $conn->query($query);
    $cake = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($cake,
                [
                    "id" => $row["id"],
                    "name" => $row["name"],
                    "price" => $row["price"],
                ]
            );
        }
    }
    return $cake;
}

?>