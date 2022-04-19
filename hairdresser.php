<?php
include ('nav-bar.php');
?>

    <div class="" >
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

                    <form action="database/add_appointment.php" method="post">

                        <div class="row form-group">
                                <label for="driver_name">اسم الفرقة</label>

                                <?php

                                $hairdresser= gethairdresser();
                                echo '<select class="form-control" id="band_select">';
                                echo '<option>-- اختر اسم الكوافيرة --</option>';
                                foreach ($hairdresser as $item) {
                                    echo "<option value='" . $item['id'] . "'>" . $item['name'] . "</option>";
                                }
                                echo '</select>';

                                ?>
                            </div>


                        <div class="row form-group">
                            <label for="driver_name">صور من عملهم</label>
                        </div>
                        <div class="row form-group">
                            <div class="col-2">
                                <img src="imgs/hairdresser1.jpg" style="width: 100%; height: 100%">
                            </div>
                            <div class="col-2">
                                <img src="imgs/hairdresser2.jpg" style="width: 100%; height: 100%">
                            </div>
                            <div class="col-2">
                                <img src="imgs/hairdresser3.jpg" style="width: 100%; height: 100%">
                            </div>
                            <div class="col-2">
                                <img src="imgs/hairdresser4.jpg" style="width: 100%; height: 100%">
                            </div>
                            <div class="col-2">
                                <img src="imgs/hairdresser5.jpg" style="width: 100%; height: 100%">
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
                            <textarea class="form-control" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">تسجيل الحجز</button>
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
            $('#photographer_select').on('change', function () {
                var phone = $("#photographer_select  option:selected").attr('data-phone');
                $('#phone').val(phone);
            })
        })
    </script>

<?php
function gethairdresser()
{

    require_once('database/connection.php');
    $conn = getConnection();

    $query = "SELECT * FROM `hairdresser`;";

    $result = $conn->query($query);
    $hairdresser = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($hairdresser,
                [
                    "id" => $row["id"],
                    "name" => $row["name"],
                ]
            );
        }
    }
    return $hairdresser;
}
?>