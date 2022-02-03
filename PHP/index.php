<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>재실확인 페이지</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    <body>
        <style type="text/css"> 
            a:link { color: gray; text-decoration: none;}
            a:visited { color: gray; text-decoration: none;}
            a:hover { color: gray; text-decoration: none;}

            body {
                margin:0;
                color:#edf3ff;
                background:#c8c8c8;
                background:url(image/wallpaper.jpg) fixed;
                background-size: cover;
                font:600 16px/18px 'Open Sans',sans-serif;
            }
            :after,:before{box-sizing:border-box}
            .clearfix:after,.clearfix:before{content:'';display:table}
            .clearfix:after{clear:both;display:block}
            a{color:inherit;text-decoration:none}

            .login-wrap{
                width: 100%;
                margin:auto;
                max-width:510px;
                min-height:510px;
                position:relative;
                background:url(image/login-frm.jpg) no-repeat center;
                background-size: cover;
                box-shadow:0 12px 15px 0 rgba(0,0,0,.24),0 17px 50px 0 rgba(0,0,0,.19);
            }
            .login-html{
                width:100%;
                height:100%;
                position:absolute;
                padding:90px 70px 50px 70px;
                background:rgba(0,0,0,0.5);
            }
            .login-html2{
                width:100%;
                height:100%;
                position:absolute;
                padding:90px 70px 50px 70px;
                background:rgba(0,0,0,0.5);
            }
            .login-html .sign-in-htm,
            .login-html .for-pwd-htm{
                top:0;
                left:0;
                right:0;
                bottom:0;
                position:absolute;
                -webkit-transform:rotateY(180deg);
                        transform:rotateY(180deg);
                -webkit-backface-visibility:hidden;
                        backface-visibility:hidden;
                -webkit-transition:all .4s linear;
                transition:all .4s linear;
            }
            .login-html .sign-in,
            .login-html .for-pwd,
            .login-form .group .check{
                display:none;
            }
            .login-html .tab,
            .login-form .group .label,
            .login-form .group .button{
                text-transform:uppercase;
            }
            .login-html .tab{
                font-size:12px;
                margin-right:15px;
                padding-bottom:5px;
                margin:0 15px 10px 0;
                display:inline-block;
                border-bottom:2px solid transparent;
            }
            .login-html .sign-in:checked + .tab,
            .login-html .for-pwd:checked + .tab{
                color:#fff;
                border-color:#1161ee;
            }
            .login-form{
                min-height:345px;
                position:relative;
                -webkit-perspective:1000px;
                        perspective:1000px;
                -webkit-transform-style:preserve-3d;
                        transform-style:preserve-3d;
            }
            .login-form .group{
                margin-bottom:15px;
            }
            .login-form .group .label,
            .login-form .group .input,
            .login-form .group .button{
                width:100%;
                color:#fff;
                display:block;
            }
            .login-form .group .input::placeholder{
                color:#fff;
            }
            .login-form .group .input,
            .login-form .group .button{
                border:none;
                padding:15px 20px;
                border-radius:5px;
                background:rgba(255,255,255,.1);
            }
            .login-form .group .label{
                color:#aaa;
                font-size:12px;
            }
            .login-form .group .button{
                background:#1161ee;
            }
            .login-form .group label .icon{
                width:15px;
                height:15px;
                border-radius:2px;
                position:relative;
                display:inline-block;
                background:rgba(255,255,255,.1);
            }
            .login-form .group label .icon:before,
            .login-form .group label .icon:after{
                content:'';
                width:10px;
                height:2px;
                background:#fff;
                position:absolute;
                -webkit-transition:all .2s ease-in-out 0s;
                transition:all .2s ease-in-out 0s;
            }
            .login-form .group label .icon:before{
                left:3px;
                width:5px;
                bottom:6px;
                -webkit-transform:scale(0) rotate(0);
                        transform:scale(0) rotate(0);
            }
            .login-form .group label .icon:after{
                top:6px;
                right:0;
                -webkit-transform:scale(0) rotate(0);
                        transform:scale(0) rotate(0);
            }
            .login-form .group .check:checked + label{
                color:#fff;
            }
            .login-form .group .check:checked + label .icon{
                background:#1161ee;
            }
            .login-form .group .check:checked + label .icon:before{
                -webkit-transform:scale(1) rotate(45deg);
                        transform:scale(1) rotate(45deg);
            }
            .login-form .group .check:checked + label .icon:after{
                -webkit-transform:scale(1) rotate(-45deg);
                        transform:scale(1) rotate(-45deg);
            }
            .login-html .sign-in:checked + .tab + .for-pwd + .tab + .login-form .sign-in-htm{
                -webkit-transform:rotate(0);
                        transform:rotate(0);
            }
            .login-html .for-pwd:checked + .tab + .login-form .for-pwd-htm{
                -webkit-transform:rotate(0);
                        transform:rotate(0);
            }

            .hr{
                height:2px;
                margin:60px 0 50px 0;
                background:rgba(255,255,255,.2);
            }
            .foot-lnk{
                text-align:center;
            }

            #circle {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%,-50%);
                width: 150px;
                height: 150px;	
            }

            .loader {
                width: calc(100% - 0px);
                height: calc(100% - 0px);
                border: 8px solid #162534;
                border-top: 8px solid #09f;
                border-radius: 50%;
                animation: rotate 5s linear infinite;
            }

            @keyframes rotate {
                100% {transform: rotate(360deg);}
            }
        </style>
        <script>
            window.onload = function() { 

                if(document.location.protocol == 'http:'){
                    document.location.href = document.location.href.replace('http:', 'https:');

                }

            }
            function admin_page_join() {
                location.href="admin?key=" + SHA256(password_key.value) + "";
                loader();

            }
            function loader() {
                var circle = $("div.circle");
                var loader = $("div.loader");
                var loginhtml = $("div.login-html");
                var loginhtml2 = $("div.login-html2");
                loginhtml2.css("display","block");
                loginhtml.css("display","none");
                circle.css("display","block");
                loader.css("display","block");
            }
            $(document).ready(function(){
                $("#password_key").keypress(function (e) {
                    if (e.which == 13){
                        admin_page_join();  // 실행할 이벤트
                    }
                });
            });
        </script>
    </head>
    <body>
    <div class="login-wrap" data-role="login-wrap">
        <div class="login-html2" style='display:none;'>
            <h4 class="text-center">요청중 입니다.</h4>
            <h4 class="text-center">잠시만 기다리세요.</h4>
        </div>
        <div class="login-html">
            <h4 class="text-center">이 페이지에 접근하려면</h4>
            <h4 class="text-center">사전에 공유된 인증코드로 인증하세요.</h4><br>
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">인증</label>
            <input id="tab-2" type="radio" name="tab" class="for-pwd"><label for="tab-2" class="tab">인증코드를 잊으셨나요?</label>
            <div class="login-form">
                <div class="sign-in-htm">
                    <div class="group">
                        <input type="password" name="password_key" class="input" id="password_key" placeholder="사전에 공유된 인증코드" onkeyup="if(window.event.keyCode==13){admin_page_join()}" autofocus>
                    </div>
                    <div class="group">
                        <button type="button" id="button" class="button" onClick="admin_page_join()">접속</button>
                    </div>
                </div>
                <div class="for-pwd-htm">
                    <p class="text-center">관리자에게 문의하여 인증코드를 다시 받으세요.</p>
                    <div class="hr"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="circle" class="circle" data-role="circle" style='display:none;'>
        <div class="loader" data-role="loader" style='display:none;'> 
            <div class="loader" data-role="loader" style='display:none;'>
                <div class="loader" data-role="loader" style='display:none;'>
                    <div class="loader" data-role="loader" style='display:none;'>

                    </div>
                </div>
            </div>
        </div>
    </div> 
    </body>
    <script type="text/javascript">
    /**
    *
    *  Secure Hash Algorithm (SHA256)
    *  http://www.webtoolkit.info/
    *
    *  Original code by Angel Marin, Paul Johnston.
    *
    **/
      
    function SHA256(s){
      
        var chrsz   = 8;
        var hexcase = 0;
      
        function safe_add (x, y) {
            var lsw = (x & 0xFFFF) + (y & 0xFFFF);
            var msw = (x >> 16) + (y >> 16) + (lsw >> 16);
            return (msw << 16) | (lsw & 0xFFFF);
        }
      
        function S (X, n) { return ( X >>> n ) | (X << (32 - n)); }
        function R (X, n) { return ( X >>> n ); }
        function Ch(x, y, z) { return ((x & y) ^ ((~x) & z)); }
        function Maj(x, y, z) { return ((x & y) ^ (x & z) ^ (y & z)); }
        function Sigma0256(x) { return (S(x, 2) ^ S(x, 13) ^ S(x, 22)); }
        function Sigma1256(x) { return (S(x, 6) ^ S(x, 11) ^ S(x, 25)); }
        function Gamma0256(x) { return (S(x, 7) ^ S(x, 18) ^ R(x, 3)); }
        function Gamma1256(x) { return (S(x, 17) ^ S(x, 19) ^ R(x, 10)); }
      
        function core_sha256 (m, l) {
             
            var K = new Array(0x428A2F98, 0x71374491, 0xB5C0FBCF, 0xE9B5DBA5, 0x3956C25B, 0x59F111F1,
                0x923F82A4, 0xAB1C5ED5, 0xD807AA98, 0x12835B01, 0x243185BE, 0x550C7DC3,
                0x72BE5D74, 0x80DEB1FE, 0x9BDC06A7, 0xC19BF174, 0xE49B69C1, 0xEFBE4786,
                0xFC19DC6, 0x240CA1CC, 0x2DE92C6F, 0x4A7484AA, 0x5CB0A9DC, 0x76F988DA,
                0x983E5152, 0xA831C66D, 0xB00327C8, 0xBF597FC7, 0xC6E00BF3, 0xD5A79147,
                0x6CA6351, 0x14292967, 0x27B70A85, 0x2E1B2138, 0x4D2C6DFC, 0x53380D13,
                0x650A7354, 0x766A0ABB, 0x81C2C92E, 0x92722C85, 0xA2BFE8A1, 0xA81A664B,
                0xC24B8B70, 0xC76C51A3, 0xD192E819, 0xD6990624, 0xF40E3585, 0x106AA070,
                0x19A4C116, 0x1E376C08, 0x2748774C, 0x34B0BCB5, 0x391C0CB3, 0x4ED8AA4A,
                0x5B9CCA4F, 0x682E6FF3, 0x748F82EE, 0x78A5636F, 0x84C87814, 0x8CC70208,
                0x90BEFFFA, 0xA4506CEB, 0xBEF9A3F7, 0xC67178F2);
 
            var HASH = new Array(0x6A09E667, 0xBB67AE85, 0x3C6EF372, 0xA54FF53A, 0x510E527F, 0x9B05688C, 0x1F83D9AB, 0x5BE0CD19);
 
            var W = new Array(64);
            var a, b, c, d, e, f, g, h, i, j;
            var T1, T2;
      
            m[l >> 5] |= 0x80 << (24 - l % 32);
            m[((l + 64 >> 9) << 4) + 15] = l;
      
            for ( var i = 0; i<m.length; i+=16 ) {
                a = HASH[0];
                b = HASH[1];
                c = HASH[2];
                d = HASH[3];
                e = HASH[4];
                f = HASH[5];
                g = HASH[6];
                h = HASH[7];
      
                for ( var j = 0; j<64; j++) {
                    if (j < 16) W[j] = m[j + i];
                    else W[j] = safe_add(safe_add(safe_add(Gamma1256(W[j - 2]), W[j - 7]), Gamma0256(W[j - 15])), W[j - 16]);
      
                    T1 = safe_add(safe_add(safe_add(safe_add(h, Sigma1256(e)), Ch(e, f, g)), K[j]), W[j]);
                    T2 = safe_add(Sigma0256(a), Maj(a, b, c));
      
                    h = g;
                    g = f;
                    f = e;
                    e = safe_add(d, T1);
                    d = c;
                    c = b;
                    b = a;
                    a = safe_add(T1, T2);
                }
      
                HASH[0] = safe_add(a, HASH[0]);
                HASH[1] = safe_add(b, HASH[1]);
                HASH[2] = safe_add(c, HASH[2]);
                HASH[3] = safe_add(d, HASH[3]);
                HASH[4] = safe_add(e, HASH[4]);
                HASH[5] = safe_add(f, HASH[5]);
                HASH[6] = safe_add(g, HASH[6]);
                HASH[7] = safe_add(h, HASH[7]);
            }
            return HASH;
        }
      
        function str2binb (str) {
            var bin = Array();
            var mask = (1 << chrsz) - 1;
            for(var i = 0; i < str.length * chrsz; i += chrsz) {
                bin[i>>5] |= (str.charCodeAt(i / chrsz) & mask) << (24 - i%32);
            }
            return bin;
        }
      
        function Utf8Encode(string) {
            string = string.replace(/\r\n/g,"\n");
            var utftext = "";
      
            for (var n = 0; n < string.length; n++) {
      
                var c = string.charCodeAt(n);
      
                if (c < 128) {
                    utftext += String.fromCharCode(c);
                }
                else if((c > 127) && (c < 2048)) {
                    utftext += String.fromCharCode((c >> 6) | 192);
                    utftext += String.fromCharCode((c & 63) | 128);
                }
                else {
                    utftext += String.fromCharCode((c >> 12) | 224);
                    utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                    utftext += String.fromCharCode((c & 63) | 128);
                }
      
            }
      
            return utftext;
        }
      
        function binb2hex (binarray) {
            var hex_tab = hexcase ? "0123456789ABCDEF" : "0123456789abcdef";
            var str = "";
            for(var i = 0; i < binarray.length * 4; i++) {
                str += hex_tab.charAt((binarray[i>>2] >> ((3 - i%4)*8+4)) & 0xF) +
                hex_tab.charAt((binarray[i>>2] >> ((3 - i%4)*8  )) & 0xF);
            }
            return str;
        }
      
        s = Utf8Encode(s);
        return binb2hex(core_sha256(str2binb(s), s.length * chrsz));
      
    }
 
    // 암호화 확인
    //console.log(SHA256("8589")) ;
 
    </script>
</html>