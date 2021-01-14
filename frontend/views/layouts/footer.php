<?php
use yii\helpers\Url;

?>
<section id="footer">
  <div class="container mb-3 mt-3">
    <div class="row">
      <div class="col-lg-3 col-sm-3 col-6">
        <h3>About Us</h3>
        <p>As a result of 40 years of research we ahve with our formally approved injection can cure piles, anal Fistula & Rectal prolapse.</p>
        <p><a href="<?=Yii::getAlias('@root') . DIRECTORY_SEPARATOR?>site/about" class="">Read More...</a></p>
      </div>
      <div class="col-lg-3 col-sm-3 col-6">
        <h3>Quick links</h3>
        <ul>
          <li><a href="<?=Yii::getAlias('@root')?>">HOME</a></li>
          <li><a href="<?=Yii::getAlias('@root') . DIRECTORY_SEPARATOR?>site/about">ABOUT US</a></li>
          <li><a href="<?=Yii::getAlias('@root') . DIRECTORY_SEPARATOR?>site/our-specifications">OUR SPECIFICATIONS</a></li>
          <li><a href="<?=Yii::getAlias('@root') . DIRECTORY_SEPARATOR?>site/our-gallery">OUR GALLERY</a></li>
          <li><a href="<?=Yii::getAlias('@root') . DIRECTORY_SEPARATOR?>site/our-branches">OUR BRANCHES</a></li>
          <li> <a href="<?=Yii::getAlias('@root') . DIRECTORY_SEPARATOR?>site/contact">CONTACT US</a></li>
        </ul>
      </div>
      <div class="col-lg-3  col-sm-3 col-xs-12">
        <h3>Contact Us</h3>
        <p> <i class="fa fa-map-marker"></i> Plot No. P.A.P. / G. /60, <br />
          Thermax Chowk, Behind Kasturi Market,<br />
          Majjid Road, Sambhaji Nagar, <br />
          Chinchwad, Pune - 411019.</p>
        <p><i class="fa fa-phone-square"></i> +91 9112675901 / 7038569384</p>
        <p><i class="fa fa-envelope"></i> info@pilesfreeworld.com</p>
      </div>
      <div class="col-lg-3 social col-sm-3 col-xs-12">
        <h3>Fallow Us</h3>
        <a href="https://www.facebook.com/pilesfreeworld"> <i class="fa fa-facebook-square"></i> </a> <a href=""> <i class="fa fa-twitter-square"></i> </a> <a href=""> <i class="fa  fa-google-plus-square"></i></a> <a href=""> <i class="fa fa-linkedin-square"></i></a>
      </div>
    </div>
  </div>
  <div class="copywrite"> <span>Copyright © pilesfreeworld 2020</span> </div>
</section>
<?php
if (class_exists('yii\debug\Module')) {
  $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}
?>

<script type="text/javascript">
$(document).ready(function(){ 
  
  
  // setTimeout(function(){
  //   // $('#player_audio').play;
  //   $('#player_audio')[0].play();
  //   // $('#player_audio').get(0).play();
  //   // $('#player_audio').pause;
  //   console.log("hi");
  // }, 3000);
    $(".booking-form").on('click', '#input-group-append-popup', function () {
      // $('#player_audio')[0].play();
        var branch_id = $("#branch_name").val();
        var doctor_id = $("#doctor_name").val();
        var patient_name = $("#patient_name").val();
        var patient_email = $("#patient_email").val();
        var patient_contact_no = $("#patient_contact_no").val();

        // var reservationDate = $("#book-time-slot").val();
        if(branch_id == "" || doctor_id == "" || patient_name == "" || patient_email == "" || patient_contact_no == "") {
            alert("All Book Appointment Form Fields Are Compulsary.");
            return false;
        }
        var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
        if(!$('#patient_contact_no').val().match('[0-9]{10}'))  {
            alert("Please put 10 digit mobile number");
            return false;
        }  

        if (typeof $("input:radio[name='book-time-slot']:checked").val() === 'undefined') {
            alert('Please select appointment date & time slot.');
            return false;
        }
        return true;
    });

    $(".booking-form").on('change', '#reservationDatePopup', function () {
        var reservationDate = $(this).val();
        var branch_id = $("#branch_name").val();
        var doctor_id = $("#doctor_name").val();
        $('#available-time-slots-div').empty();
        $.ajax({
            url: '<?php echo Yii::$app->getUrlManager()->createUrl('site/collect-available-slots') ?>',
            type: 'POST',
            data: {reservationDate: reservationDate, branch_id: branch_id, doctor_id: doctor_id},
            dataType: 'json',
            success: function (result) {
                if (result.status == "success") {
                    $tmp = 1;
                    $.each(result.outputdata, function (index, timeSlotDetail) {
                        //'id' => $availableDetail->id, 'slot_time' => $availableDetail->available_time_slot, 'booking_status' => $availableDetail->booking_status];
                        // myArray.push([timeSlotDetail.id, timeSlotDetail.slot_time, timeSlotDetail.booking_status]);
                        var newAttr = '';//btn-success
                        var newClass = 'btn-success';
                        if(timeSlotDetail.booking_status == 'Yes') {
                            newAttr = "disabled='disabled'";
                            newClass = 'btn-secondary';
                        }
                        $('#available-time-slots-div').append('<label class="btn '+newClass+'">'+
                        '<input type="radio" '+newAttr+' name="book-time-slot" id="book-time-slot" autocomplete="off" value="'+timeSlotDetail.id+'"> '+timeSlotDetail.slot_time+'</label>');
                        $tmp++;
                    });
                } else {
                    // alert("Doctors are not available.");
                    $('#available-time-slots-div').append('<lable style="color:red;" >Doctors are not available.</lable>');
                }
            },
            complete: function (result) {
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#available-time-slots-div').append('<lable style="color:red;" >Try again after some time.</lable>');
            }
        });
    });
    
});
</script>