<?php
include('nav-bar.php');
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

                    <?php
                    if (isset($_SESSION['Name'])) {
                        echo '<input type="hidden" id="username" value="'. $_SESSION['Name'] .'">';
                    }
                    ?>


                        <div class="form-group">
                            <label for="driver_name">اسم الصالة</label>
                            <?php
                            $weddingHall = getWeddingHall();
                            echo '<select class="form-control" id="weddingHallSelect">';
                            echo '<option>-- اختر اسم الصالة --</option>';
                            foreach ($weddingHall as $item) {
                                echo "<option data-content='" . $item['imgs_details'] . "' value='" . $item['id'] . "' data-area='". $item['area'] ."' data-number_of_chair='". $item['number_of_chair'] ."' data-price='". $item['price'] ."'>" . $item['name'] . "</option>";
                            }
                            echo '</select>';
                            ?>
                        </div>


                        <div class="form-group ">
                            <label for="driver_name">الجزء من الصالة</label>
                            <select class="form-control" id="in_out_select">
                                <option value="غير محدد">-- اختر --</option>
                                <option value="داخلي">داخلي</option>
                                <option value="خارجي">خارجي</option>
                            </select>
                        </div>

                        <div class="row" id="imgs">
                            <!--                        <div class="col-6">-->
                            <!--                            <img src="imgs/weddinghall_in.jpg" style="width: auto; height: 300px">-->
                            <!--                        </div>-->

                        </div>

                        <div class="row form-group">
                            <div class="col-6">
                                <label>عدد الكراسي</label>
                                <input type="number" class="form-control" id="number_of_chair" name="number_of_chair" readonly>
                            </div>
                            <div class="col-6">
                                <label>المساحة</label>
                                <input style="text-align: left" type="text" class="form-control" id="area"
                                       name="area" readonly>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-6">
                                <label>السعر</label>
                                <input type="text" class="form-control" id="price" name="price" readonly>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-6">
                                <label for="start_at">وقت بداية الحجز</label>
                                <input type="datetime-local" class="form-control" id="start_at" name="start_at"
                                       required>
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

                        <?php
                        if (isset($_SESSION['email'])) {
                            echo '<button class="btn btn-primary" id="reserve">تسجيل الحجز</button>';
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

            $('#in_out_select').on('change', function () {
                var val = $(this).val();

                $('#imgs').empty();

                var imgs = JSON.parse($("#weddingHallSelect  option:selected").attr('data-content'));
                for (var i = 0; i < imgs.length; i++) {
                    if (imgs[i]['type'] == val) {
                        $('#imgs').append('<div class="col-6"><img src="imgs/' + imgs[i]['name'] + '" style="width: auto; height: 300px"></div>');
                    }
                }

            });

            $('#weddingHallSelect').on('change', function () {
                var area = $("#weddingHallSelect  option:selected").attr('data-area');
                var number_of_chair = $("#weddingHallSelect  option:selected").attr('data-number_of_chair');
                var price = $("#weddingHallSelect  option:selected").attr('data-price');
                $('#area').val(area);
                $('#number_of_chair').val(number_of_chair);
                $('#price').val(price);
                $('#imgs').empty();
            });

            $('#reserve').on('click', function () {

                var content = {
                  'اسم ألزبون' : $("#username").val(),
                  'اسم الصالة' : $( "#weddingHallSelect option:selected" ).text(),
                  'المساحة' : $('#area').val(),
                  'عدد الكراسي' : $('#number_of_chair').val(),
                  'الجزء من الصالة' : $('#in_out_select').val(),
                  'وقت بداية الحجز' : $('#start_at').val(),
                  'وقت نهاية الحجز' : $('#end_at').val(),
                  'ملاحظات' : $('#note').val(),
                };

                $.ajax({
                    url: 'database/createReservation.php',
                    type: "post",
                    data: {
                        "type": "wedding_hall",
                        "type_id": $('#weddingHallSelect').val(),
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
function getWeddingHall()
{

    require_once('database/connection.php');
    $conn = getConnection();

    $query = "SELECT * FROM `wedding_hall`;";

    $result = $conn->query($query);
    $WeddingHall = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($WeddingHall,
                [
                    "id" => $row["id"],
                    "name" => $row["name"],
                    "number_of_chair" => $row["number_of_chair"],
                    "area" => $row["area"],
                    "imgs_details" => $row["imgs_details"],
                    "price" => $row["price"]
                ]
            );
        }
    }

    return $WeddingHall;
}
?>