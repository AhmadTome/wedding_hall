<?php
include('nav-bar.php');
?>

    <div class="">
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

                        <div class="form-group">
                            <label for="driver_name">الطعم</label>
                            <?php

                            $cakes = getCakes();
                            echo '<select class="form-control" id="cake_select">';
                            echo '<option>-- اختر الطعم --</option>';
                            foreach ($cakes as $item) {
                                echo "<option value='" . $item['id'] . "' data-price='". $item['price'] ."'>" . $item['taste'] . "</option>";
                            }
                            echo '</select>';

                            ?>

                        </div>

                        <div class="form-group">
                            <label for="driver_name">عدد الطبقات</label>
                            <select class="form-control" id="number_of_layer">
                                <option selected value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="driver_name">اللون</label>
                            <select class="form-control" id="color">
                                <option value="">-- اختر اللون --</option>
                                <option value="ابيض">ابيض</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="driver_name">العدد</label>
                            <input class="form-control" type="number" id="number" value="1"/>
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
                            <textarea class="form-control" rows="3" id="note"></textarea>
                        </div>

                        <div class="row form-group">
                            <label for="driver_name">صور من أعمالنا</label>
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <img src="imgs/cake1.jpg" style="width: 100%; height: 300px">
                            </div>
                            <div class="col-4">
                                <img src="imgs/cake2.jpg" style="width: 100%; height: 300px">
                            </div>
                            <div class="col-4">
                                <img src="imgs/cake3.jpg" style="width: 100%; height: 300px">
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
        $('#cake_select').on('change', function () {
            var price = $("#cake_select  option:selected").attr('data-price');
            $('#price').val(price);
        });


        $('#number').on('keyup', function (){

            var price = $("#cake_select  option:selected").attr('data-price');
            var number = $('#number').val() || 1;
            var number_of_layer = $('#number_of_layer').val() || 1;
            $('#price').val(price*number*number_of_layer);
        })

        $('#number_of_layer').on('change', function (){

            var price = $("#cake_select  option:selected").attr('data-price');
            var number = $('#number').val() || 1;
            var number_of_layer = $('#number_of_layer').val() || 1;
            $('#price').val(price*number*number_of_layer);
        })


        $('#reserve').on('click', function () {

            var content = {
                'اسم ألزبون' : $("#username").val(),
                'الطعم' : $( "#cake_select option:selected" ).text(),
                'عدد الطبقات' : $('#number_of_layer').val(),
                'العدد' : $('#number').val(),
                'اللون' : $('#color').val(),
                'وقت الحجز' : $('#start_at').val(),
                'ملاحظات' : $('#note').val(),
            };

            $.ajax({
                url: 'database/createReservation.php',
                type: "post",
                data: {
                    "type": "cake",
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
function getCakes()
{

    require_once('database/connection.php');
    $conn = getConnection();

    $query = "SELECT * FROM `cake`;";

    $result = $conn->query($query);
    $cake = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($cake,
                [
                    "id" => $row["id"],
                    "taste" => $row["taste"],
                    "price" => $row["price"],
                ]
            );
        }
    }
    return $cake;
}

?>