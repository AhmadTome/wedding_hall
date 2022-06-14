<?php
include ('nav-bar.php');
?>

<div class="" >
    <div class="main-section">

        <div class="row">



            <div class="container" style="color: white; text-align: right; padding-top: 35px;" dir="rtl">

                <div class="row form-group">
                    <div class="col-6">
                        <button class="btn btn-primary" onclick="printDiv()">طباعة تقرير</button>
                    </div>
                </div>


                <div class="row form-group">
                    <div class="col-6">
                        <label for="start_at">من تاريخ</label>
                        <input type="datetime-local" class="form-control" id="start_at"  name="start_at" required>
                    </div>
                    <div class="col-6">
                        <label for="end_at">إلى تاريخ</label>
                        <input style="text-align: left" type="datetime-local" class="form-control" id="end_at" name="end_at" required >
                    </div>
                </div>


<div id="content">


                <?php
                    $reservations = getReservations();
                    $summation = 0;
                    $start_at = !isset($_GET['start_at']) ? '1970-01-01' : $_GET['start_at'];
                    $end_at = !isset($_GET['end_at']) ? '2099-01-01' : $_GET['end_at'];

                    foreach ($reservations as $reservation)
                    {
                        $content = '';
                        $a = json_decode($reservation['content'], true);
                        $keys = array_keys($a);




                        if (isset($a['وقت الحجز'])) {
                            $date = date('Y-m-d', strtotime($a['وقت الحجز']));

                            if (($date < $start_at) || ($date > $end_at)){
                                continue;
                            }


                        } else {
                            $start = date('Y-m-d', strtotime($a['وقت بداية الحجز']));
                            $end = date('Y-m-d', strtotime($a['وقت نهاية الحجز']));

                            if (($start < $start_at) || ($start > $end_at)){
                                continue;
                            }
                        }




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
</div>

</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>

    function printDiv() {
        var divContents = document.getElementById("content").innerHTML;
        var a = window.open('', '');
        a.document.write('<html>');
        a.document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">' +
            '<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">' +
            '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">' +
            '<body style="text-align: right" dir="rtl" > <h1>التقرير<br>');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.print();
    }

    $(document).ready(function (){

        $('#start_at, #end_at').on('change', function (){


            var start_at = $('#start_at').val() == '' ? '1970-01-01' : $('#start_at').val();
            var end_at = $('#end_at').val() == '' ? '2099-01-01' : $('#end_at').val();


            if ($('#start_at').val() != "" && $('#end_at').val() != "") {
                window.location.href = window.location.origin + window.location.pathname + "?start_at=" + start_at + "&end_at=" + end_at;
            }


        });

    })
</script>


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

    $query = "SELECT * From `reservation` order by id desc;";

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