import openai
import mysql.connector
from tokens import getToken
openai.api_key = getToken()

conexion1=mysql.connector.connect(host="localhost", user="root", passwd="", database = "chatbot")
cursor1=conexion1.cursor()
cursor1.execute("SELECT `mensaje` FROM `chatbot` ORDER BY id_msg DESC LIMIT 1")

msg = cursor1.fetchall()

#print (msg)

mensajes = ""


pregunta = msg
respuesta = openai.Completion.create(
    engine = "text-davinci-003",
    prompt = pregunta,
    max_tokens = 256,
    temperature = 0.9,
    top_p=1
)
       
respuesta_chatbot = respuesta.choices[0].text.strip()
#print(respuesta_chatbot)

cursor1.execute("UPDATE `chatbot` SET `respuesta`='%s' ORDER BY id_msg DESC LIMIT 1"%respuesta_chatbot)
conexion1.commit()
conexion1.close()
    
    
    
    