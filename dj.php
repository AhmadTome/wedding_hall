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
                            <label for="driver_name">اسم الفرقة</label>

                            <?php

                            $dj= getdj();
                            echo '<select class="form-control" id="dj_select">';
                            echo '<option>-- اختر اسم الديجي --</option>';
                            foreach ($dj as $item) {
                                echo "<option data-price='". $item['price'] ."' data-rate='". $item['rate'] ."' value='" . $item['id'] . "'>" . $item['name'] . "</option>";
                            }
                            echo '</select>';

                            ?>
                        </div>

                        <div class="row form-group">
                            <div class="col-6">
                                <label >أفراد الفرقة</label>
                                <select class="form-control" id="dj_type_select">
                                    <option >-- اختر --</option>
                                    <option value='mans'>شباب</option>
                                    <option value='girls'>بنات</option>
                                    <option value='mix'>شباب & بنات</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label>التقييم</label>
                                <input type="text" class="form-control" name="rate" id="rate" readonly >
                            </div>
                        </div>

                    <div class=" form-group">
                        <label>السعر</label>
                        <input type="text" class="form-control" id="price" name="price" readonly>
                    </div>


                        <div class="row form-group">
                            <label for="driver_name">صور من عملهم</label>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <img src="imgs/dj1.jpg" style="width: 100%; height: 100%">
                            </div>
                            <div class="col-4">
                                <img src="imgs/dj2.jpg" style="width: 100%; height: 100%">
                            </div>
                            <div class="col-4">
                                <img src="imgs/dj3.jpg" style="width: 100%; height: 100%">
                            </div>

                        </div>

                        <div class="row form-group">
                            <div class="col-6">
                                <label for="start_at">وقت بداية الحجز</label>
                                <input type="datetime-local" class="form-control" id="start_at"  name="start_at" required>
                            </div>
                            <div class="col-6">
                                <label for="end_at">وقت نهاية الحجز</label>
                                <input style="text-align: left" type="datetime-local" class="form-control" id="end_at" name="end_at" required >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cost">ملاحظات</label>
                            <textarea class="form-control" rows="3" id="note"></textarea>
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
            $('#dj_select').on('change', function () {
                var rate = $("#dj_select  option:selected").attr('data-rate');
                var price = $("#dj_select  option:selected").attr('data-price');
                $('#rate').val(rate);
                $('#price').val(price);
            });

            $('#reserve').on('click', function () {

                var content = {
                    'اسم ألزبون' : $("#username").val(),
                    'اسم الفرقة' : $("#dj_select option:selected").text(),
                    'أفراد الفرقة' : $("#dj_type_select option:selected").text(),
                    'التقييم' : $("#rate").val(),
                    'وقت بداية الحجز' : $('#start_at').val(),
                    'وقت نهاية الحجز' : $('#end_at').val(),
                    'ملاحظات' : $('#note').val(),
                };

                $.ajax({
                    url: 'database/createReservation.php',
                    type: "post",
                    data: {
                        "type": "dj",
                        "type_id": $('#dj_select').val(),
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
function getdj()
{

    require_once('database/connection.php');
    $conn = getConnection();

    $query = "SELECT * FROM `dj`;";

    $result = $conn->query($query);
    $dj = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($dj,
                [
                    "id" => $row["id"],
                    "name" => $row["name"],
                    "rate" => $row["rate"],
                    "price" => $row["price"],
                ]
            );
        }
    }
    return $dj;
}
?>