#!/usr/bin/python3
from datetime import datetime
import os
import pytz

timeZ_At = pytz.timezone('Europe/Kiev')

# Get the current time in UTC
current_time_utc = datetime.now(timeZ_At)

print("Current time in UTC:", current_time_utc)

def convert_date(timestamp):
    d = datetime.utcfromtimestamp(timestamp)
    formated_date = d.strftime('%d %b %Y - %H:%M:%S')
    return formated_date

def get_files():
    dir_downloads = os.path.expanduser('~/Downloads')
    dir_entries = os.scandir(dir_downloads)
    for entry in dir_entries:
        if entry.is_file():
            info = entry.stat()
            print(f'{entry.name}\t Last Modified: {convert_date(info.st_mtime)}')

get_files()


def humanReadableTime(time):
    hours = time // 3600
    minutes = (time % 3600) // 60
    seconds = time % 60
    return f'{hours:02}:{minutes:02}:{seconds:02}'


