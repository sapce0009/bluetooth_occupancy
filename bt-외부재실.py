#!/usr/bin/python
import RPi.GPIO as GPIO 
import bluetooth
import time

import smtplib
from email.mime.text import MIMEText

import mysql.connector
mydb = mysql.connector.connect(

    host="SQL SERVER ADDRESS",

    port = 3306,

    user="ID",

    passwd="PASSWORD",

    database="smarthome" 

)
mc = mydb.cursor()

relay_1 = 21

GPIO.setmode(GPIO.BCM)
GPIO.setup(relay_1, GPIO.OUT)

print("첫 실행 재실 탐지중...")

first_start = "OK"

def email_send(device, time):
    s = smtplib.SMTP('smtp.gmail.com', 587)
    s.starttls()
    s.login('GOOGLE ID', '서드파티 로그인 패스워드')
    msg = MIMEText('재실 시간 : ' + time)
    msg['Subject'] = '디바이스(' + device + ')가 탐지되어 도어락이 제어 되었습니다. '
    msg['From'] = '도어락 제어 안내'
    msg['To'] = '상대 이메일'
    s.sendmail("보낸이(이메일형식)", "수신상대(이메일형식)", msg.as_string())
    s.quit()

#email_send('iPhone 13 PRO MAX', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()))
#email_send('아이폰','12:11')

try:

    while True:
        
        #처음 시작시 정보수집
        if(first_start == "OK"):

            sql = "INSERT INTO system_log SET system_info = %s, log_time = %s, message = %s"
            mc.execute(sql, ('외부 재실센서', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), '외부 재실센서가 시작되었습니다.'))
            mydb.commit()

            print ("Checking " + time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()))
            #아이폰 재실 첫 재실 처리
            result = bluetooth.lookup_name('블루투스 MAC ID', timeout=3)
            if (result != None):
                occupancy = "YES"
            else:
                occupancy = "NO"

                
            #sql = "INSERT INTO occupancy_info (user, occupancy, in_time) VALUES (%s, %s, %s)"
            #val = ("iPhone", "재실", time.strftime("%Y-%m-%d %H:%M:%S", time.gmtime()))

            #mc.execute(sql, val)

            #mydb.commit()
            sql = "UPDATE occupancy_info SET occupancy = %s, in_time = %s, out_time = %s, real_in_time = %s, real_out_time = %s, occupancy3 = %s WHERE id = '1'"
            mc.execute(sql, (occupancy, format(time.time()), format(time.time()), time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), occupancy))

            mydb.commit()
            #갤럭시 노트 첫 재실 처리
            result2 = bluetooth.lookup_name('블루투스 MAC ID', timeout=3)
            if (result2 != None):
                occupancy2 = "YES"
            else:
                occupancy2 = "NO"

            
            sql = "UPDATE occupancy_info SET occupancy = %s, in_time = %s, out_time = %s, real_in_time = %s, real_out_time = %s, occupancy3 = %s WHERE id = '2'"
            mc.execute(sql, (occupancy2, format(time.time()), format(time.time()), time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), occupancy2))

            mydb.commit()
                
            #sql = "INSERT INTO occupancy_info (user, occupancy, in_time) VALUES (%s, %s, %s)"
            #val = ("LG WING", "재실", time.strftime("%Y-%m-%d %H:%M:%S", time.gmtime()))

            #mc.execute(sql, val)

            #mydb.commit()
            first_start = "NO"
            print("첫 실행 재실 탐지를 완료 하였습니다.")
            print ("iPhone 13 PRO MAX 재실 여부 : ", occupancy)
            print ("GALAXY NOTE 재실 여부 : ", occupancy2)
            sql = "INSERT INTO system_log SET system_info = %s, log_time = %s, message = %s"
            mc.execute(sql, ('외부 재실센서', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), '첫 재실 확인을 완료 하였습니다. iPhone 13 PRO MAX : ' + occupancy + ' | GALAXY NOTE : ' + occupancy2))
            mydb.commit()
            time.sleep(2)
        else:
            #아이폰 재실 처리
            result = bluetooth.lookup_name('블루투스 MAC ID', timeout=2)
            if (result != None):
                
                sql = "SELECT * FROM `smarthome`.`occupancy_info` WHERE id = 1;"
                mc.execute(sql)
                select = mc.fetchall()
                mydb.commit()
                
                occupancy = select[0][7]
                if occupancy == "NO":

                #occupancy = "YES"
                    
                    sql = "UPDATE occupancy_info SET occupancy = %s, in_time = %s, real_in_time = %s, occupancy2 = %s, occupancy3 = %s WHERE id = '1'"
                    mc.execute(sql, ('YES', format(time.time()), time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'YES', 'YES'))

                    mydb.commit()
                
                    sql = "SELECT * FROM `smarthome`.`occupancy_info` WHERE id = 1;"
                    mc.execute(sql)
                    select = mc.fetchall()
                    mydb.commit()
                    
                    intime = float(select[0][3])
                    outtime = float(select[0][4])
                    
                    celtime = intime - outtime
                    #print(celtime)
                    #if(celtime > 1200):
                    if(celtime > 300):
                        sql = "INSERT INTO system_log SET system_info = %s, log_time = %s, message = %s"
                        mc.execute(sql, ('외부 재실센서', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'iPhone 13 PRO MAX 외출후 복귀 5분 이상 소요 되었습니다.'))
                        mydb.commit()
                        print (time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()) + " >> iPhone 13 PRO MAX 외출후 복귀 5분 이상 걸렸음.", celtime)
                        GPIO.output(relay_1, GPIO.HIGH)
                        time.sleep(1)
                        GPIO.output(relay_1, GPIO.LOW)
                        
                        sql = "INSERT INTO control_info SET control_info = %s, control_time = %s"
                        mc.execute(sql, ('iPhone 13 PRO MAX 외출후 재실 LOCK OPEN', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())))
                        mydb.commit()
                        
                        sql = "INSERT INTO occupancy_log SET device_name = %s, state = %s, time = %s, state_time = %s"
                        mc.execute(sql, ('iPhone 13 PRO MAX', '재실', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), celtime))
                        mydb.commit()

                        email_send('iPhone 13 PRO MAX', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()))
                        
                        #sql = "UPDATE occupancy_info SET occupancy = %s, occupancy2 = %s, in_time = %s, real_in_time = %s WHERE id = '1'"
                        #mc.execute(sql, ('YES', 'YES', format(time.time()), time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())))
                        #mydb.commit()
                    else:
                        sql = "INSERT INTO system_log SET system_info = %s, log_time = %s, message = %s"
                        mc.execute(sql, ('외부 재실센서', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'iPhone 13 PRO MAX 가 탐지 되었으나, 외출 시간이 5분 이하 입니다.'))
                        mydb.commit()
                        
                else:
                    sql = "UPDATE occupancy_info SET occupancy = %s, in_time = %s, real_in_time = %s, occupancy3 = %s WHERE id = '1'"
                    mc.execute(sql, ('YES', format(time.time()), time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'YES'))

                    mydb.commit()
                    sql = "INSERT INTO system_log SET system_info = %s, log_time = %s, message = %s"
                    mc.execute(sql, ('외부 재실센서', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'iPhone 13 PRO MAX 가 탐지 되었으나, 내부 재실센서가 이미 재실로 표시 하였습니다.'))
                    mydb.commit()
                    #print(outtime - intime)
                    
                    #print(intime - outtime)
                    #if(format(intime - outtime) > 
                    #print(select[0][3])
                
            else:
                sql = "SELECT * FROM `smarthome`.`occupancy_info` WHERE id = 1;"
                mc.execute(sql)
                select = mc.fetchall()
                mydb.commit()
                
                occupancy = select[0][2]
                #intime = float(select[0][3])
                #outtime = float(select[0][4])
                    
                #celtime = intime - outtime
                if occupancy == "YES":
                    sql = "UPDATE occupancy_info SET occupancy = %s, out_time = %s, real_out_time = %s, occupancy3 = %s WHERE id = '1'"
                    mc.execute(sql, ('NO', format(time.time()), time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'NO'))
                    mydb.commit()
                    print(time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()) + " >> iPhone 13 PRO MAX 블루투스 신호 탐지 실패! 재실 여부 업데이트 완료")
                    
                    sql = "INSERT INTO system_log SET system_info = %s, log_time = %s, message = %s"
                    mc.execute(sql, ('외부 재실센서', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'iPhone 13 PRO MAX 의 상태가 재실에서 외출 상태로 변경 되었습니다.'))
                    mydb.commit()
                    #print(celtime)
                    #if(celtime > 1199):
                        #sql = "INSERT INTO occupancy_log SET device_name = %s, state = %s, time = %s"
                        #mc.execute(sql, ('iPhone 13 PRO MAX', '외출', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())))
                        #mydb.commit()
                    
            
            #갤럭시 노트 재실 처리
                    
            result = bluetooth.lookup_name('블루투스 MAC ID', timeout=2)
            if (result != None):
                
                sql = "SELECT * FROM `smarthome`.`occupancy_info` WHERE id = 2;"
                mc.execute(sql)
                select = mc.fetchall()
                mydb.commit()
                
                occupancy = select[0][7]
                if occupancy == "NO":
                #occupancy = "YES"
                    
                    sql = "UPDATE occupancy_info SET occupancy = %s, in_time = %s, real_in_time = %s, occupancy2 = %s, occupancy3 = %s WHERE id = '2'"
                    mc.execute(sql, ('YES', format(time.time()), time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'YES', 'YES'))

                    mydb.commit()
                
                    sql = "SELECT * FROM `smarthome`.`occupancy_info` WHERE id = 2;"
                    mc.execute(sql)
                    select = mc.fetchall()
                    mydb.commit()
                    
                    intime = float(select[0][3])
                    outtime = float(select[0][4])
                    
                    celtime = intime - outtime
                    #print(celtime)
                    if(celtime > 300):
                        sql = "INSERT INTO system_log SET system_info = %s, log_time = %s, message = %s"
                        mc.execute(sql, ('외부 재실센서', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'GALAXY NOTE 가 외출후 복귀 5분 이상 소요 되었습니다.'))
                        mydb.commit()
                        print (time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()) + " >> GALAXY NOTE 외출후 복귀 5분 이상 걸렸음.", celtime)
                        GPIO.output(relay_1, GPIO.HIGH)
                        time.sleep(1)
                        GPIO.output(relay_1, GPIO.LOW)
                        
                        sql = "INSERT INTO control_info SET control_info = %s, control_time = %s"
                        mc.execute(sql, ('GALAXY NOTE 외출후 재실 LOCK OPEN', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())))
                        mydb.commit()
                        
                        sql = "INSERT INTO occupancy_log SET device_name = %s, state = %s, time = %s, state_time = %s"
                        mc.execute(sql, ('GALAXY NOTE', '재실', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), celtime))
                        mydb.commit()

                        email_send('GALAXY NOTE', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()))
                        
                        #sql = "UPDATE occupancy_info SET occupancy = %s, occupancy2 = %s, in_time = %s, real_in_time = %s WHERE id = '2'"
                        #mc.execute(sql, ('YES', 'YES', format(time.time()), time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())))
                        #mydb.commit()
                    else:
                        sql = "INSERT INTO system_log SET system_info = %s, log_time = %s, message = %s"
                        mc.execute(sql, ('외부 재실센서', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'GALAXY NOTE 가 탐지 되었으나, 외출 시간이 5분 이하 입니다.'))
                        mydb.commit()
                else:
                    sql = "UPDATE occupancy_info SET occupancy = %s, in_time = %s, real_in_time = %s, occupancy3 = %s WHERE id = '2'"
                    mc.execute(sql, ('YES', format(time.time()), time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'YES'))

                    mydb.commit()

                    sql = "INSERT INTO system_log SET system_info = %s, log_time = %s, message = %s"
                    mc.execute(sql, ('외부 재실센서', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'GALAXY NOTE 가 탐지 되었으나, 내부 재실센서가 이미 재실로 표시 하였습니다.'))
                    mydb.commit()
                    #print(outtime - intime)
                    
                    #print(intime - outtime)
                    #if(format(intime - outtime) > 
                    #print(select[0][3])
                
            else:
                sql = "SELECT * FROM `smarthome`.`occupancy_info` WHERE id = 2;"
                mc.execute(sql)
                select = mc.fetchall()
                mydb.commit()
                
                occupancy = select[0][2]
                
                #intime = float(select[0][3])
                #outtime = float(select[0][4])
                    
                #celtime = intime - outtime
                if occupancy == "YES":
                    sql = "UPDATE occupancy_info SET occupancy = %s, out_time = %s, real_out_time = %s, occupancy3 = %s WHERE id = '2'"
                    mc.execute(sql, ('NO', format(time.time()), time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'NO'))
                    mydb.commit()
                    print(time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()) + " >> GALAXY NOTE 블루투스 신호 탐지 실패! 재실 여부 업데이트 완료")
                    #if(celtime > 1199):
                        #sql = "INSERT INTO occupancy_log SET device_name = %s, state = %s, time = %s"
                        #mc.execute(sql, ('GALAXY NOTE', '외출', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())))
                        #mydb.commit()

                    sql = "INSERT INTO system_log SET system_info = %s, log_time = %s, message = %s"
                    mc.execute(sql, ('외부 재실센서', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'GALAXY NOTE 의 상태가 재실에서 외출 상태로 변경 되었습니다.'))
                    mydb.commit()
                                
            #time.sleep(1)
except KeyboardInterrupt:
    sql = "INSERT INTO system_log SET system_info = %s, log_time = %s, message = %s"
    mc.execute(sql, ('외부 재실센서', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), '외부 재실센서가 종료되었습니다.'))
    mydb.commit()
    GPIO.cleanup()
