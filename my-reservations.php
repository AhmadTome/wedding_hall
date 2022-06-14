<?php
include ('nav-bar.php');
?>

    <div class="" >
        <div class="main-section">
            <div class="row">

                <div class="container" style="color: white; text-align: right; padding-top: 35px;" dir="rtl">
                    <?php
                    $reservations = getReservations();
                    $summation = 0;
                    foreach ($reservations as $reservation)
                    {
                        $content = '';
                        $a = json_decode($reservation['content'], true);
                        $keys = array_keys($a);
                        foreach ($keys as $key)
                        {
                            $content = $content . '<div class="col-6">
                                        <label>'. $key .'</label>
                                        <input type="text" class="form-control" readonly value="'. $a[$key] .'">
                                    </div>';
                        }
                        $summation = $summation + $reservation['price'];


                        echo '<div class="w3-panel w3-card w3-white" style="padding: 25px;">
                                <div class="row form-group">
                                    <div class="col-6">
                                        <label>نوع الحجز</label>
                                        <input type="text" class="form-control" readonly value="'. $reservation['type'] .'">
                                    </div>
                                    
                                    <div class="col-6">
                                        <label>السعر</label>
                                        <input type="text" class="form-control" readonly value="'. $reservation['price'] .'">
                                    </div>
                                </div>
                                
                                <h3>تفاصيل الحجز</h3>
                                <div class="row form-group">
                                
                                   '. $content .'
                                    
                                
                                </div>
                              </div>';
                    }
                    ?>


                  <div class="w3-panel w3-card w3-white" style="padding: 25px;">
                        <div class="row form-group">
                            <div class="col-6">
                                <label>مجموع السعر</label>
                                <input type="text" class="form-control" readonly value=" <?php echo $summation ?>">
                            </div>
                        </div>
                    </div>
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
function getReservations()
{

    $Naming = [
        'wedding_hall' => 'صالة أفراح',
        'cake' => 'كيك',
        'adornment' => 'تزيين',
        'photographer' => 'تصوير',
        'band' => 'فرقة',
        'dj' => 'ديجي',
        'hairdresser' => 'كوافيرة',
        'dress' => 'الفستان',
        'accessories' => 'الاكسسوارات',
    ];
    require_once('database/connection.php');
    $conn = getConnection();

    $query = "SELECT * From `reservation` where user_id = ". $_SESSION['id'] ." order by id desc";

    $result = $conn->query($query);

    $reservations = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($reservations,
                [
                    "id" => $row["id"],
                    "type" => $Naming[$row["type"]],
                    "type_id" => $row["type_id"],
                    "content" => $row["content"],
                    "price" => $row["price"]
                ]
            );
        }
    }

    return $reservations;
}
?>