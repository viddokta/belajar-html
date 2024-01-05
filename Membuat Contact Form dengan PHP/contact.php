<?php
$notify = '';
$notifyClass = '';

if(isset($_POST['submit'])){
    // Membuat variabl untuk menerima data dari form
    $email = $_POST['email'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Cek apakah ada data yang belum diisi
    if(!empty($email) && !empty($name) && !empty($subject) && !empty($message)){

        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $notify = 'Email Anda salah. Silakan ketikan alamat email yang benar.';
            $notifyClass = 'errordiv';
        }else{
            // Pengaturan penerima email dan subjek email
            $toEmail = 'davidokta56@gmail.com'; // Ganti dengan alamat email yang Anda inginkan
            $emailSubject = 'Pesan website dari '.$name;
            $htmlContent = '<h2>Via Form Kontak Website</h2>
                <h4>Nama</h4><p>'.$name.'</p>
                <h4>Email</h4><p>'.$email.'</p>
                <h4>Subject</h4><p>'.$subject.'</p>
                <h4>Pesan</h4><p>'.$message.'</p>';

            // Mengatur Content-Type header untuk mengirim email dalam bentuk HTML
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // Header tambahan
            $headers .= 'From: '.$name.'<'.$email.'>'. "\r\n";

            // Kirim email
            if(mail($toEmail,$emailSubject,$htmlContent,$headers)){
                $notify = 'Pesan Anda sudah terkirim dengan sukses !';
                $notifyClass = 'succdiv';
            }else{
                $notify = 'Maaf pesan Anda gagal terkirim, silahkan ulangi lagi.';
                $notifyClass = 'errordiv';
            }
        }
    }else{
        $notify = 'Harap mengisi semua field data';
        $notifyClass = 'errordiv';
    }
}
?>

<html>
<head>
    <title>Membuat Contact Form dengan PHP - ePlusGo</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <form id="contact" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <?php if(!empty($notify)){ ?>
                <p class="notify <?php echo !empty($notifyClass)?$notifyClass:''; ?>"><?php echo $notify; ?></p>
            <?php } ?>
            <h3>Contact Form</h3>
            <h4>Hubungi kami dengan mengisi isian dibawah</h4>
            <fieldset>
                <input placeholder="Nama Anda" type="text" name="name" tabindex="1" required autofocus>
            </fieldset>
            <fieldset>
                <input placeholder="Email Anda" type="text" name="email" tabindex="2" required>
            </fieldset>
            <fieldset>
                <input placeholder="Subject (optional)" type="text" name="subject" tabindex="4" required>
            </fieldset>
            <fieldset>
                <textarea placeholder="Ketikan pesan Anda" name="message" tabindex="5" required></textarea>
            </fieldset>
            <fieldset>
                <button name="submit" type="submit" id="contact-submit" data-submit="...Mengirim pesan">Kirim</button>
            </fieldset>
        </form>
    </div>
</body>
</html>