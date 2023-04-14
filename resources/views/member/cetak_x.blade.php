<!DOCTYPE html> 
<html>  
<head> 
    <title> 
       Cara Convert HTML ke Image
    </title> 
    <script src="{{ asset('theme/js/jquery.min.js') }}"></script>    
    <script src="{{ asset('theme/js/html2canvas.js') }}"></script> 
</head> 
<body> 
  
    <center>  
    <h2 style="color:purple"> 
        Convert Bagian HTML ke IMAGE
    </h2> 
       
    <div id="html-content-holder" style="background-color: #e2c6c6;  
                color: brown; width: 500px;  
                padding: 10px;"> 
        <strong> 
            Tutorial Convert HTML ke Image
        </strong> 
        <hr style='color:black'/> 
        <h3 style="color: #3e4b51;"> 
            Tentang Kami 
        </h3> 
        <p style="color: #3e4b51;">  
        <img src='sistemit.png'/><br>
            <b>SistemIT.com</b> adalah website software development, sharing informasi, tutorial dan info teknologi lainnya     
        </p> 
        <p style="color: #3e4b51;"> 
            Anda juga dapat melakukan pemesanan web atau pemesanan pembuatan sistem informasi secara custom. Banyak dari klien atau pelanggan 
            kami sangat terbantu dalam project mereka. Tuggu Apalagi silahkan kontak admin web SistemIT.com
            <br>
            <img src='no_hp.png'/>
        </p> 
    </div> 
   
    <input id="btn-Preview-Image" type="button" value="Preview" />  
           
    <a id="btn-Convert-Html2Image" href="#">Download</a> 
 
    <h3>Preview Berikut adalah Gambar:</h3> 
       
    <div id="previewImage"></div> 
       
    <script> 
        $(document).ready(function() { 
           
            // Global variable 
            var element = $("#html-content-holder");  
           
            // Global variable 
            var getCanvas;  
            // $("#btn-Preview-Image").on('click', function() { 
            //     html2canvas(element, { 
            //     onrendered: function(canvas) { 
            //             $("#previewImage").append(canvas); 
            //             getCanvas = canvas; 
            //         } 
            //     }); 
            // }); 
            $("#btn-Preview-Image").on('click', function() { 
                html2canvas(element, {
                    onrendered: function(canvas) {
                        var myImage = canvas.toDataURL("image/png",1);
                        var tWindow = window.open("");
                        $(tWindow.document.body)
                            .html("<img id='Image' src=" + myImage + " style='width:100%;'></img>")
                            .ready(function() {
                                tWindow.focus();
                                tWindow.print();
                            });
                    }
                });
            }); 
            $("#btn-Convert-Html2Image").on('click', function() { 
                var imgageData =  
                    getCanvas.toDataURL("image/png",1); 
               
                // Now browser starts downloading  
                // it instead of just showing it 
                var newData = imgageData.replace( 
                /^data:image\/png/, "data:application/octet-stream"); 
               
                $("#btn-Convert-Html2Image").attr( 
                "download", "SistemITImage.png").attr( 
                "href", newData); 
            }); 
        }); 
    </script> 
    </center> 
</body> 
</html>