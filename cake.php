<?php
include ('nav-bar.php');
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

                <form action="database/add_appointment.php" method="post">

                    <div class="form-group">
                        <label for="driver_name">الطعم</label>
                        <?php

                        $cakes = getCakes();
                        echo '<select class="form-control" id="cake_select">';
                        echo '<option>-- اختر الطعم --</option>';
                        foreach ($cakes as $item) {
                            echo "<option value='" . $item['id'] . "'>" . $item['taste'] . "</option>";
                        }
                        echo '</select>';

                        ?>

                    </div>

                    <div class="form-group">
                        <label for="driver_name">عدد الطبقات</label>
                        <select class="form-control">
                            <option>-- اختر عدد الطبقات --</option>
                            <option value="1">1</option>
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
                        <select class="form-control">
                            <option>-- اختر اللون --</option>
                            <option value="احمر">احمر</option>
                            <option value="ابيض">ابيض</option>
                            <option value="ازرق">ازرق</option>
                        </select>
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
                            <img src="imgs/cake1.jpg" style="width: 100%; height: 300px">
                        </div>
                        <div class="col-4">
                            <img src="imgs/cake2.jpg" style="width: 100%; height: 300px">
                        </div>
                        <div class="col-4">
                            <img src="imgs/cake3.jpg" style="width: 100%; height: 300px">
                        </div>
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
                ]
            );
        }
    }
    return $cake;
}
?>