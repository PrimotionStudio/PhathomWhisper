<!-- JAVASCRIPT -->
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>

<!-- Magnific Popup-->
<script src="assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- owl.carousel js -->
<script src="assets/libs/owl.carousel/owl.carousel.min.js"></script>    

<!-- page init -->
<script src="assets/js/pages/index.init.js"></script>

<script src="assets/js/app.js"></script>

<script>
    function sendmsg() {
        const input = document.getElementById("msg");
        event.preventDefault();
        const msg = input.value;
        input.value = '';
        const token = document.getElementById("token").value;
        const xhr = new XMLHttpRequest(); // create a new XML_HTTP_REQUEST object
        const url = "func/send"; // specify the URL of the PHP script
        const params = "msgtxt=" + msg + "&token=" + token; // create the parameter string
        xhr.open("POST", url, true); // set the method and URL
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // set the request header
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                if (xhr.responseText == "Message Sent") {
                    showchat();
                }
            }
        };
        xhr.send(params); // send the request with the parameters
    }
    
    function copyTextOnClick() {
        const input = document.getElementById('chatlink');
        input.addEventListener('click', function () {
            this.select();
            document.execCommand('copy');
            const tooltip = new bootstrap.Tooltip(this);
            tooltip.show();
            setTimeout(function() {
                tooltip.hide();
            }, 2000);
        });
    }

    function editprofile() {
        event.preventDefault();
        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const phone = document.getElementById("phone").value;
        const bio = document.getElementById("bio").value;
        const subbtn = document.getElementById("editprofilesubmitbtn");
        const linkstat = document.querySelectorAll('input[type="radio"][name="linkstat"]');
        let linkstatus = null;
        linkstat.forEach((stat) => {
            if (stat.checked) {
                linkstatus = stat.value;
            }
        });
        const token = document.getElementById("token").value;
        const xhr = new XMLHttpRequest(); // create a new XML_HTTP_REQUEST object
        const url = "func/editprofile"; // specify the URL of the PHP script
        const params = "name=" + name + "&email=" + email + "&phone=" + phone + "&bio=" + bio + "&linkstat=" + linkstatus + "&token=" + token; // create the parameter string
        xhr.open("POST", url, true); // set the method and URL
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // set the request header
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("alert").innerHTML = xhr.responseText;
                // setTimeout(function(){ document.getElementById("alert").innerHTML = "" },3500);
            }
        };
        xhr.send(params); // send the request with the parameters
    }

    function replymsg() {
        event.preventDefault();
        const forms = document.querySelectorAll('.replymsgbox');
        forms.forEach(function(form) {
            const formData = new FormData(form);
            const xhr = new XMLHttpRequest(); // create a new XML_HTTP_REQUEST object
            const url = "func/reply"; // specify the URL of the PHP script
            xhr.open("POST", url, true); // set the method and URL
            xhr.onload = function() {
                if (xhr.status === 200) {
                    if (xhr.responseText == "Message Sent") {
                        showchat();
                    }
                }
            };
            xhr.send(formData); // send the request with the parameters
            // form.addEventListener('submit', function(event) {});
        });
        var divElement = document.getElementsByClassName('modal-backdrop');
        divElement.remove();
    }

    function upload() {
        const input = document.getElementById("msg");
        event.preventDefault();
        const msg = input.value;
        input.value = '';
        const token = document.getElementById("token").value;
        const xhr = new XMLHttpRequest(); // create a new XML_HTTP_REQUEST object
        const url = "func/upload"; // specify the URL of the PHP script
        const params = "msgtxt=" + msg + "&token=" + token; // create the parameter string
        xhr.open("POST", url, true); // set the method and URL
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // set the request header
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText); // display the response from the PHP script
                if (xhr.responseText == "Message Sent") {
                    showchat();
                }
            }
        };
        xhr.send(params); // send the request with the parameters
    }


    // Auto Refresh Chat
    function showchat() {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("msgbox").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", "func/refreshchat", true);
        xmlhttp.send();
    }

    // Auto Refresh ChatLeftsidebar
    function sidebar() {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("getlastmsg").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", "func/getlastmsg", true);
        xmlhttp.send();
    }
    // Auto Refresh reply
    function getreplymsgs() {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("getreplymsgs").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", "func/getreplymsgs", true);
        xmlhttp.send();
    }
    // Auto Refresh deletemsg
    function getdelmsgs() {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("getdelmsgs").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", "func/getdelmsgs", true);
        xmlhttp.send();
    }

    // Find New Messages every 1 second
    setInterval(function() {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == "New message arrived") {
                    showchat();
                    getreplymsgs();
                    getdelmsgs();
                    sidebar();
                }
            }
        };
        xmlhttp.open("POST", "func/findnewmsg", true);
        xmlhttp.send();
    }, 1000);
    showchat();
    getreplymsgs();
    getdelmsgs();
    sidebar();

    function funcname() {
        alert("qwertyuio");
    }
</script>
</body>

</html>