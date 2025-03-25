<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';

class MailModel {

   protected $smtpMail;
   protected $smtpPassword;
   
   public function __construct()
   {
    $this->smtpMail = ""; // smtp mail kullanıcı adı 
    $this->smtpPassword = ""; // smtp mail şifre 
   }
    // Ben Gmail'i kullandım, ancak isterseniz kendi SMTP protokolünüzü de kullanabilirsiniz.
    // Eğer Gmail kullanacaksanız, kullanıcı adı olarak Gmail adresinizi ve şifre alanına ise
    // Gmail hesabınıza gidip bir uygulama şifresi oluşturmalı ve o şifreyi kullanmalısınız.
    public function sendMail($name, $email, $subject, $message) {
        $mail = new PHPMailer(true);

        if(!$this->smtpMail || !$this->smtpPassword){
            return ['success'=>false,'message'=>'Bu foksiyonu kullanabilmek için SMTP mail kullanıcı adı ve şifrenizi girmelisiniz'];
        }

        try {
            
            
            $mail->SMTPDebug = 0;
            $mail->Debugoutput = 'html'; 
            // SMTP Ayarları
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $this->smtpMail; 
            $mail->Password = $this->smtpPassword; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // E-posta Gönderen Bilgileri
            $mail->setFrom($email, $name);
            $mail->addAddress(''); // Buraya formun gönderileceği email adresini yazını 

            // İçerik
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = "<p><strong>Ad Soyad:</strong> $name</p>
                           <p><strong>E-Posta:</strong> $email</p>
                           <p><strong>Mesaj:</strong> $message</p>";

            $mail->send();
            return ['success'=>true,'message'=>'E-posta başarıyla gönderildi!'];
        } catch (Exception $e) {
            return ['success'=>false,'message'=>'E-posta gönderilirken hata oluştu!'];
        }
    }
}
?>
