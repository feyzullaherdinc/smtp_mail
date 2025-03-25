<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/ladda-themeless.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .bl-6{
            border-left:4px solid #0d6efd;
        }
        .smtp_form{
            width: 600px;
            padding: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        
    </style>
</head>
<body>
    <div class="container mt-5 smtp_form">
        <h2>İletişim Formu</h2>
        <form id="contactForm" method="POST" action="javascript:void(0);">
            <div class="mb-3">
                <label for="name" class="form-label">Ad Soyad</label>
                <input type="text" class="form-control bl-6" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-posta</label>
                <input type="email" class="form-control bl-6" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Konu</label>
                <input type="text" class="form-control bl-6" id="subject" name="subject" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Mesaj</label>
                <textarea class="form-control bl-6" id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary ladda-button" data-style="expand-right">
                <span class="ladda-label">Gönder</span>
            </button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/spin.js/2.3.2/spin.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/ladda.min.js"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    
    <script>
$(document).ready(function(){
    history.replaceState(null, null, window.location.pathname);

    $('#contactForm').submit(function(event){
        event.preventDefault();
        
        let formData = new FormData(this);
        let submitButton = document.querySelector('.ladda-button');
        let l = Ladda.create(submitButton);
        l.start();

        $.ajax({
            type: "POST",
            url: "send-mail",
            data: formData,
            dataType: "json",
            contentType: false, 
            processData: false, 
            success: function(res){
                l.stop();  
                
                if(res.success === true){
                    Swal.fire({
                        icon: 'success',
                        title: 'Başarılı!',
                        text: res.message,
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Hata!',
                        text: res.message,
                    });
                }
            },
            error: function(xhr, status, error){
                l.stop();
                Swal.fire({
                    icon: 'error',
                    title: 'Hata!',
                    text: 'E-posta gönderilirken bir hata oluştu.',
                });
                console.error('Hata:', error);
            }
        });
    });
});

    </script>
</body>
</html>
