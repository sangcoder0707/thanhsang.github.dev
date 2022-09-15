<?php
/**  
 * @author Ske Software
 * @link https://www.facebook.com/skesoftware
 * @license Free
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Bootstrap 5.2.0 css -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
   <!-- Jquery -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <!-- ClipboardJS -->
   <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
   <!-- Font Awesome Pro 6 -->
   <link href="https://kit-pro.fontawesome.com/releases/v6.1.1/css/pro.min.css" rel="stylesheet">
   <!-- SweetAlert 2 JS -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.23/dist/sweetalert2.all.min.js"></script>
   <title>Mã hóa code PHP</title>
</head>

<body>
   <div class="container-lg mt-4">
      <h4 class="text-center mb-3">Mã hóa code PHP</h4>
      <div class="row">
         <div class="col-lg-6">
            <div class="card shadow-sm">
               <div class="card-header">
                  <h3 class="card-title">Mã hóa PHP</h3>
               </div>
               <div class="card-body">
                  <div class="intro">Dán PHP cần mã hóa của bạn vào dưới đây:</div>
                  <p class="fw-bold">Lưu ý: Không cần &lt;?php ?&gt; khi dán code PHP của bạn vào bên dưới</p>
                  <b>&lt;?php</b>
                  <div class="form-group mt-2 mb-2">
                     <textarea id="php_origial" style="height: 500px" class="form-control" placeholder='echo "Dán mã PHP của bạn vào đây";'></textarea>
                  </div>
                  <b>?&gt;</b>
               </div>
               <div class="card-footer">
                  <button class="btn btn-primary" id="btn_encode"><i class="fa-thin fa-play"></i> Mã hóa ngay</button>
               </div>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="card shadow-sm">
               <div class="card-header border-bottom-0">
                  <h3 class="card-title">Kết quả</h3>
               </div>
               <div class="card-body">
                  <p class="intro">Mã PHP đã mã hóa của bạn ở dưới đây! Copy và dán nó vào tệp PHP.</p>
                  <div class="form-group">
                     <textarea id="php_encoded" readonly style="height: 500px" class="form-control" placeholder='PHP đã mã hóa sẽ hiện tại đây'></textarea>
                  </div>
               </div>
               <div class="card-footer">
                  <button class="btn btn-secondary copy" data-clipboard-action="copy" data-clipboard-target="#php_encoded"><i class="fa-thin fa-clipboard"></i> Sao chép</button>
               </div>
            </div>
         </div>
      </div>
      <footer class="bg-light text-center text-lg-start mt-3">
         <!-- Copyright -->
         <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            &copy; <?= date('Y') ?> - Đức Minh | Source code by <a href="https://www.facebook.com/skesoftware" target="_blank">Ske Software</a>
         </div>
         <!-- Copyright -->
      </footer>
   </div>
   <!-- Handlers -->
   <script>
      $(document).ready(function() {
         new ClipboardJS('.copy');
         $(".copy").click(function() {
            $(this).html("Đã sao chép !");
            setTimeout(() => {
               $(this).html('<i class="fa-thin fa-clipboard"></i> Sao chép');
            }, 500);
         });
      });
      $("#btn_encode").click(function() {
         if ($("#php_origial").val().length <= 5) {
            Swal.fire('Lỗi', 'Mã bạn nhập vào quá ngắn !', 'error');
         } else {
            $(this).html('Đang mã hóa');
            $(this).prop('disabled', true);
            $.ajax({
               type: "post",
               url: "/handlers/main.php",
               data: {
                  org_php: $("#php_origial").val()
               },
               dataType: "json",
               success: function(response) {
                  if (!response['status']) {
                     $("#btn_encode").html('<i class="fa-thin fa-play"></i> Mã hóa ngay');
                     Swal.fire('Lỗi', response['msg'], 'error');
                     $("#btn_encode").prop('disabled', false);
                  } else {
                     $("#btn_encode").html('<i class="fa-thin fa-play"></i> Mã hóa ngay');
                     Swal.fire('Thành công', response['msg'], 'success');
                     $("#btn_encode").prop('disabled', false);
                     $("#php_encoded").val(response['php_encoded']);
                  }
               }
            });
         }
      });
   </script>
</body>

</html>