<!DOCTYPE html>
<html lang="ko">
    <?php #리러퍼 체크하여 접속경로 확인
    $ref = "/(주소 HOST를 입력하세요.)/";
    if(!preg_match($ref, $_SERVER["HTTP_REFERER"])) {

    echo '<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>관리페이지</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
            font:600 16px/18px "Open Sans",sans-serif;
        }
        :after,:before{box-sizing:border-box}
        .clearfix:after,.clearfix:before{content:"";display:table}
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
            content:"";
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
    </style>
    </head>
    <body>
        <div class="login-wrap" data-role="login-wrap">
            <div class="login-html">
                <h4 class="text-center">올바른 접근이 아닙니다.</h4><br>
                
                <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">돌아가기</label>
                <input id="tab-2" type="radio" name="tab" class="for-pwd"><label for="tab-2" class="tab">이 메세지가 왜 뜨나요?</label>
                <div class="login-form">
                    <div class="sign-in-htm">
                        <div class="group">
                            <button type="button" id="button" class="button" onClick="location.href=\'index\'">돌아가기</button>
                        </div>
                    </div>
                    <div class="for-pwd-htm">
                        <p class="text-center">올바르지 않은 경로로 접근시에</p>
                        <p class="text-center">발생되는 메세지 입니다.</p>
                        <p class="text-center">정상적인 경로로 인증후 이용해주세요.</p>
                        <div class="hr"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    ';
    echo exit;
    } 
    
    ?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>시스템 로그</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        
        <style type="text/css"> 
            a:link { color: gray; text-decoration: none;}
            a:visited { color: gray; text-decoration: none;}
            a:hover { color: gray; text-decoration: none;}

            body {
                margin:0;
                background:#c8c8c8;
                background:url(image/wallpaper.jpg) fixed;
                background-size: cover;
            }

            .bigPictureWrapper {
                position: fixed;
                display: none;
                justify-content: center;
                align-items: center;
                top:0%;
                width:100%;
                height:100%;
                background-color: gray; 
                z-index: 100;
                background:rgba(255,255,255,0.5);
            }
            .bigPicture {
                position: relative;
                display: contents;
                justify-content: center;
                align-items: center;
            }
            
            .bigPicture img {
                width: 640px;
                height: 480px;
            }

            #myInput, #myInput2 {
                background-position: 10px 10px;
                background-repeat: no-repeat;
                width: 100%;
                font-size: 16px;
                padding: 12px 20px 12px 40px;
                border: 1px solid #ddd;
                border-radius:5px;
                margin-bottom: 5px;
                /* margin-top: 15px; */
            }

            Table {
                border-collapse: collapse;
                width: 100%;
                border: 1px solid #ddd;
                font-size: 18px;
                margin-bottom: 15px;
            }

            Table tr {
                background-color: white;
            }

            Table th, Table td {
                text-align: left;
                padding: 12px;
            }

            Table tr {
                border-bottom: 1px solid #ddd;
            }

            Table tr.header, Table tr:hover {
                background-color: #f1f1f1;
            }

            .preview img {
                filter: blur(3px);
                transition: .3s ease-in-out;
            }

            .preview img:hover {
                filter: blur(0);
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
    </head>
    <body>
        <?php #SHA256으로 암호화 된 값
            if($_GET['key'] == '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4') {
                $join_key = $_GET['key'];
            

            error_reporting(E_ALL);	// error reporting on

            $ip = "서버상태 체크";	// my localhost ip
            $port = 13388;			// 26354 my opened port in modem
            $timeout = 1;			// connection timeout in seconds 

            if (fsockopen($ip, $port, $errno, $errstr, $timeout)) {
                $pi_server1 = "OK";
            } else {
                $pi_server1 = "FAIL";
            }

            error_reporting(E_ALL);	// error reporting on

            $ip = "192.168.1.24";	// my localhost ip
            $port = 13388;			// 26354 my opened port in modem
            $timeout = 1;			// connection timeout in seconds 

            if (fsockopen($ip, $port, $errno, $errstr, $timeout)) {
                $pi_server2 = "OK";
            } else {
                $pi_server2 = "FAIL";
            }

            ?>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">시스템 로그</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- 여기에 버튼 작성. -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#" onclick="location.href='./admin?key=<?php echo $join_key ?>'">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <!-- <li class="nav-item active">
                            <a class="nav-link" href="#" onclick="location.href='./admin?key=<?php echo $join_key ?>'; loader();">Home <span class="sr-only">(current)</span></a>
                        </li> -->
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                        <a class="nav-link" href="#" onclick="location.href='./index'"><img src="image/logout.png" style="width: 15px; height: 15px;"> 로그아웃</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container" style="margin-top: 15px;">
                <h3 class="text-center">재실센서 상태</h3>
                <table id="server_state">
                    <tr class="header">
                        <th style="width:50%;">센서</th>
                        <th style="width:50%;">상태</th>
                    </tr>

                    <?php
                    if($pi_server1 === 'OK') {
                        $pi_state = '<font style="color:blue">●</font> 정상';
                    } else {
                        $pi_state = '<font style="color:red">●</font> 연결 끊어짐';
                    }
                    ?>
                    <tr>
                        <td>
                            외부 재실센서
                        </td>
                        <td>
                            <?php echo $pi_state ?>
                        </td>
                    </tr>

                    <?php
                    if($pi_server2 === 'OK') {
                        $pi_state = '<font style="color:blue">●</font> 정상';
                    } else {
                        $pi_state = '<font style="color:red">●</font> 연결 끊어짐';
                    }
                    ?>
                    <tr>
                        <td>
                            내부 재실센서
                        </td>
                        <td>
                            <?php echo $pi_state ?>
                        </td>
                    </tr>
                </table>
            </div>
            <?php
                $mysql_host = 'SQL ADDREESS';
                $mysql_user = 'id';
                $mysql_password = '비밀번호';
                $mysql_db = 'smarthome';
                //connetc 설정(host,user,password)
                $conn = mysql_connect($mysql_host,$mysql_user,$mysql_password);
                //db 연결
                $dbconn = mysql_select_db($mysql_db,$conn);
                //charset UTF8
                mysql_query("set names utf8");
                $query = "SELECT * FROM system_log";
                $result = mysql_query($query);
                $data_rows = mysql_num_rows($result);

                // $query = "UPDATE setting SET log_read_last_count='$data_rows'";
                // $result = mysql_query($query);
            ?>
            <div class="container" style="margin-top: 15px;">
                <h3 class="text-center">시스템 로그</h3>
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="데이터베이스에서 <?php echo $data_rows ?>개의 시스템 로그가 검색됨 (센서 기준 검색)" title="검색할 내용을 입력하세요.">
                <input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="데이터베이스에서 <?php echo $data_rows ?>개의 시스템 로그가 검색됨 (메세지 기준 검색)" title="검색할 내용을 입력하세요.">
                <table id="occpancy_info">
                    <tr class="header">
                        <th style="width:20%;">시간</th>
                        <th style="width:15%;">재실센서</th>
                        <th style="width:65%;">MESSAGE</th>
                    </tr>
            <?php
                $query = "select * from system_log ORDER BY log_time DESC limit 10000";
                $result = mysql_query($query);
                while($row = mysql_fetch_array($result)) {
                    $system_info = $row['system_info'];
                    $log_time = $row['log_time'];
                    $message = $row['message'];
                    ?>
                    <tr>
                        <td>
                            <?php echo $log_time ?>
                        </td>
                        <td>
                            <?php echo $system_info ?>
                        </td>
                        <td>
                            <?php echo $message ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </table>
                </div>
            </div>
            <script type="text/javascript">

                function myFunction() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("occpancy_info");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                    }       
                }
                }

                function myFunction2() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myInput2");
                filter = input.value.toUpperCase();
                table = document.getElementById("occpancy_info");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[2];
                    if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                    }       
                }
                }
            </script>
        </body>
    </html>
    <?php
        } else {
            echo '<head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>관리페이지</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
                    font:600 16px/18px "Open Sans",sans-serif;
                }
                :after,:before{box-sizing:border-box}
                .clearfix:after,.clearfix:before{content:"";display:table}
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
                    content:"";
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
            </style>
            </head>
            <body>
                <div class="login-wrap" data-role="login-wrap">
                    <div class="login-html">
                        <h4 class="text-center">인증에 실패하였습니다.</h4>
                        <h4 class="text-center">다시 시도하여 주세요.</h4><br>
                        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">돌아가기</label>
                        <input id="tab-2" type="radio" name="tab" class="for-pwd"><label for="tab-2" class="tab">이 메세지가 왜 뜨나요?</label>
                        <div class="login-form">
                            <div class="sign-in-htm">
                                <div class="group">
                                    <button type="button" id="button" class="button" onClick="location.href=\'index\'">돌아가기</button>
                                </div>
                            </div>
                            <div class="for-pwd-htm">
                                <p class="text-center">인증코드가 맞지 않아 발생된 문제입니다.</p>
                                <p class="text-center">인증코드를 다시한번 확인후 시도하세요.</p>
                                <div class="hr"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </html>';
            echo exit;
        }
        ?>
    </body>
</html>