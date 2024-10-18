import smtplib
my_email = "seriiburduja@gmail.com"
password = "" #password from google app https://myaccount.google.com/apppasswords
connection = smtplib.SMTP("smtp.gmail.com")
connection.starttls()
connection.login(user=my_email, password=password)
connection.sendmail(from_addr=my_email, to_addrs="seriiburduja@yandex.ru", msg="Subject:Hello\n\nThis is the body of my email")
connection.close()


