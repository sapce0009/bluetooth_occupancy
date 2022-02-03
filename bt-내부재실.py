#!/usr/bin/python

# import RPi.GPIO as GPIO 

import bluetooth

import time



import mysql.connector

mydb = mysql.connector.connect(

    host="SQL SERVER ADDRESS",

    port = 3306,

    user="ID",

    passwd="PASSWORD",

    database="smarthome" 

)



mc = mydb.cursor()



# relay_1 = 21



# GPIO.setmode(GPIO.BCM)

# GPIO.setup(relay_1, GPIO.OUT)



print("첫 실행 재실 탐지중...")



first_start = "OK"



try:



    while True:

        

        #처음 시작시 정보수집

        if(first_start == "OK"):

            sql = "INSERT INTO system_log SET system_info = %s, log_time = %s, message = %s"
            mc.execute(sql, ('내부 재실센서', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), '내부 재실센서가 시작되었습니다.'))
            mydb.commit()

            print ("Checking " + time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()))

            #아이폰 재실 첫 재실 처리

            result = bluetooth.lookup_name('블루투스 MAC ID', timeout=5)

            if (result != None):

                occupancy = "YES"

            else:

                occupancy = "NO"



                

            #sql = "INSERT INTO occupancy_info (user, occupancy, in_time) VALUES (%s, %s, %s)"

            #val = ("iPhone", "재실", time.strftime("%Y-%m-%d %H:%M:%S", time.gmtime()))



            #mc.execute(sql, val)



            #mydb.commit()

            sql = "UPDATE occupancy_info SET occupancy = %s, in_time = %s, out_time = %s, real_in_time = %s, real_out_time = %s , occupancy2 = %s, out_time2 = %s WHERE id = '1'"

            mc.execute(sql, (occupancy, format(time.time()), format(time.time()), time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), occupancy, time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())))



            mydb.commit()

            #갤럭시 노트 첫 재실 처리

            result2 = bluetooth.lookup_name('블루투스 MAC ID', timeout=5)

            if (result2 != None):

                occupancy2 = "YES"

            else:

                occupancy2 = "NO"



            

            sql = "UPDATE occupancy_info SET occupancy = %s, in_time = %s, out_time = %s, real_in_time = %s, real_out_time = %s, occupancy2 = %s, out_time2 = %s WHERE id = '2'"

            mc.execute(sql, (occupancy2, format(time.time()), format(time.time()), time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), occupancy2, time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())))



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
            mc.execute(sql, ('내부 재실센서', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), '첫 재실 확인을 완료 하였습니다. iPhone 13 PRO MAX : ' + occupancy + ' | GALAXY NOTE : ' + occupancy2))
            mydb.commit()

            time.sleep(2)

        else:

            #아이폰 재실 처리

            result = bluetooth.lookup_name('블루투스 MAC ID', timeout=5)

            if (result != None):

                

                sql = "SELECT * FROM `smarthome`.`occupancy_info` WHERE id = 1;"

                mc.execute(sql)

                select = mc.fetchall()

                mydb.commit()

                

                occupancy = select[0][2]

                if occupancy == "NO":

                #occupancy = "YES"

                    sql = "INSERT INTO system_log SET system_info = %s, log_time = %s, message = %s"
                    mc.execute(sql, ('내부 재실센서', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'iPhone 13 PRO MAX 가 탐지되어 재실정보를 업데이트 하였습니다.'))
                    mydb.commit()

                    

                    sql = "UPDATE occupancy_info SET occupancy = %s, in_time = %s, real_in_time = %s, occupancy2 = %s WHERE id = '1'"

                    mc.execute(sql, ('YES', format(time.time()), time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'YES'))



                    mydb.commit()
                      
                else:

                    sql = "UPDATE occupancy_info SET occupancy = %s, in_time = %s, real_in_time = %s, occupancy2 = %s WHERE id = '1'"

                    mc.execute(sql, ('YES', format(time.time()), time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()),'YES'))



                    mydb.commit()
              
            else:

                sql = "SELECT * FROM `smarthome`.`occupancy_info` WHERE id = 1;"

                mc.execute(sql)

                select = mc.fetchall()

                mydb.commit()

                

                occupancy = select[0][7]
                intime = float(select[0][3])
                outtime = float(select[0][4])
                
                celtime = intime - outtime
                

                if occupancy == "YES":

                    sql = "UPDATE occupancy_info SET occupancy2 = %s, out_time2 = %s WHERE id = '1'"

                    mc.execute(sql, ('NO', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())))

                    mydb.commit()

                    print(time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()) + " >> iPhone 13 PRO MAX 블루투스 신호 탐지 실패! 재실 여부 업데이트 완료")
                    
                    sql = "INSERT INTO system_log SET system_info = %s, log_time = %s, message = %s"
                    mc.execute(sql, ('내부 재실센서', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'iPhone 13 PRO MAX 의 상태가 재실에서 외출 상태로 변경 되었습니다.'))
                    mydb.commit()
 
                    

            #갤럭시 노트 재실 처리

                    

            result = bluetooth.lookup_name('블루투스 MAC ID', timeout=5)

            if (result != None):

                

                sql = "SELECT * FROM `smarthome`.`occupancy_info` WHERE id = 2;"

                mc.execute(sql)

                select = mc.fetchall()

                mydb.commit()

                

                occupancy = select[0][2]

                if occupancy == "NO":

                #occupancy = "YES"
                    sql = "INSERT INTO system_log SET system_info = %s, log_time = %s, message = %s"
                    mc.execute(sql, ('내부 재실센서', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'GALAXY NOTE 가 탐지되어 재실정보를 업데이트 하였습니다.'))
                    mydb.commit()

                    

                    sql = "UPDATE occupancy_info SET occupancy = %s, in_time = %s, real_in_time = %s, occupancy2 = %s WHERE id = '2'"
                    mc.execute(sql, ('YES', format(time.time()), time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'YES'))
                    mydb.commit()

                else:

                    sql = "UPDATE occupancy_info SET occupancy = %s, in_time = %s, real_in_time = %s, occupancy2 = %s WHERE id = '2'"
                    mc.execute(sql, ('YES', format(time.time()), time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'YES'))
                    mydb.commit()

            else:

                sql = "SELECT * FROM `smarthome`.`occupancy_info` WHERE id = 2;"
                mc.execute(sql)
                select = mc.fetchall()
                mydb.commit()

                

                occupancy = select[0][7]
                intime = float(select[0][3])
                outtime = float(select[0][4])
                
                celtime = intime - outtime

                if occupancy == "YES":

                    sql = "UPDATE occupancy_info SET occupancy2 = %s, out_time2 = %s WHERE id = '2'"

                    mc.execute(sql, ('NO', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())))

                    mydb.commit()

                    print(time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()) + " >> GALAXY NOTE 블루투스 신호 탐지 실패! 재실 여부 업데이트 완료")
                    sql = "INSERT INTO system_log SET system_info = %s, log_time = %s, message = %s"
                    mc.execute(sql, ('내부 재실센서', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), 'GALAXY NOTE 의 상태가 재실에서 외출 상태로 변경 되었습니다.'))
                    mydb.commit()            

            #time.sleep(2)

except KeyboardInterrupt:
    sql = "INSERT INTO system_log SET system_info = %s, log_time = %s, message = %s"
    mc.execute(sql, ('내부 재실센서', time.strftime("%Y-%m-%d %H:%M:%S", time.localtime()), '내부 재실센서가 종료되었습니다.'))
    mydb.commit()
    #GPIO.cleanup()

