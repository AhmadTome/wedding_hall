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
                        <label for="driver_name">نوع الاكسسوار</label>

                        <?php

                        $accessories = getAccessories();
                        echo '<select class="form-control" id="type">';
                        echo '<option>-- اختر نوع الاكسسوار --</option>';
                        foreach ($accessories as $item) {
                            echo "<option value='" . $item['id'] . "' data-price='". $item['price'] ."' value='". $item['name'] ."'>" . $item['name'] . "</option>";
                        }
                        echo '</select>';

                        ?>




                    </div>

                    <div class="form-group col-6">
                        <label for="driver_name">الطرحة</label>
                        <select class="form-control" id="veil">
                            <option>-- اختر الطرحة --</option>
                            <option>طويلة</option>
                            <option>قصيرة</option>
                            <option>وسط</option>
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="form-group col-6">
                        <label for="driver_name">المسكة</label>
                        <select class="form-control" id="grab">
                            <option>-- اختر المسكة --</option>
                            <option>كبيرة</option>
                            <option>صغيرة</option>
                            <option>وسط</option>
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="driver_name">الكعب</label>
                        <select class="form-control" id="heel">
                            <option>-- اختر الكعب --</option>
                            <option>عالي</option>
                            <option>قصير</option>
                            <option>وسط</option>
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="form-group col-6">
                        <label for="driver_name">النفاش</label>
                        <select class="form-control" id="bloating">
                            <option>-- اختر النفاش --</option>
                            <option>3</option>
                            <option>4</option>
                            <option>2</option>
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="driver_name">التاج</label>
                        <select class="form-control" id="crown">
                            <option>-- اختر التاج --</option>
                            <option>ذهبي</option>
                            <option>فضي</option>
                            <option>زركون</option>
                        </select>
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
                    <div class="col-3">
                        <img src="imgs/accesoroes1.jpg" style="width: 100%; height: 300px">
                    </div>
                    <div class="col-3">
                        <img src="imgs/accesoroes2.jpg" style="width: 100%; height: 300px">
                    </div>
                    <div class="col-3">
                        <img src="imgs/accesoroes3.jpg" style="width: 100%; height: 300px">
                    </div>
                    <div class="col-3">
                        <img src="imgs/accesoroes4.jpg" style="width: 100%; height: 300px">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-3">
                        <img src="imgs/accesoroes5.jpg" style="width: 100%; height: 300px">
                    </div>
                    <div class="col-3">
                        <img src="imgs/accesoroes6.jpg" style="width: 100%; height: 300px">
                    </div>
                    <div class="col-3">
                        <img src="imgs/accesoroes7.jpg" style="width: 100%; height: 300px">
                    </div>
                    <div class="col-3">
                        <img src="imgs/accesoroes8.jpg" style="width: 100%; height: 300px">
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
        $('#type').on('change', function () {
            var price = $("#type  option:selected").attr('data-price');
            $('#price').val(price);
        });

        $('#reserve').on('click', function () {

            var content = {
                'اسم ألزبون': $("#username").val(),
                'نوع الاكسسوارات': $("#type option:selected").text(),
                'الطرحة': $("#veil option:selected").text(),
                'المسكة': $("#grab option:selected").text(),
                'الكعب': $("#heel option:selected").text(),
                'النفاش': $("#bloating option:selected").text(),
                'التاج': $("#crown option:selected").text(),
                'وقت بداية الحجز': $('#start_at').val(),
                'وقت نهاية الحجز': $('#end_at').val(),
                'ملاحظات': $('#note').val(),
            };

            $.ajax({
                url: 'database/createReservation.php',
                type: "post",
                data: {
                    "type": "accessories",
                    "type_id": 0,
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
function getAccessories()
{

    require_once('database/connection.php');
    $conn = getConnection();

    $query = "SELECT * FROM `accessories`;";

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