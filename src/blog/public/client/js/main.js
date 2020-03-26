$(document).ready(function(){
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('#go-to-top').fadeIn();
        } else {
            $('#go-to-top').fadeOut();
        }
    });
    $('#go-to-top').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
    $(".input").focus(function() {
        $(this).parent().addClass("focus");
    })
});

$(function() {
    $("#upload-img").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onload = function(e){ // set image data as background of div

              $("#img-preview-block").css({'background-image': 'url('+e.target.result +')', "background-size": "cover"});
            }
        }
    });
});

function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}
    // console.log(document.getElementById("defaultOpen").val());
  // Get the element with id="defaultOpen" and click on it
//   document.getElementById("defaultOpen").click();
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-142314870-1');
