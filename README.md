Ice example
===================

Informação
------------
 O que está feito:
 
	No projeto há quatro classes principais
	*client.java, responsável por enviar seu status e receber a mensagem para si
	*startServer.java, responsável por colocar o servidor no ar e monitorar o status de cada host
	*infoHostI.java, interface programada que faz referência a interface infoHost do arquivo Slice.ice
	*infoMensagemI.java, interface programada que faz referência a interface infoMensagem do arquivo Slice.ice
 
 O que falta fazer:
 
	Criar os forms (telas), havia criado mas apaguei :/
	linkar as forms com as classes
	Criar a classe Sensor, Saved,User, basicamente é copiar a classe "client.java"  e setar a linha 20 para o nome da classe correspondente
	
	Metodo que salve em arquivo a mensagem enviada para o host Saved
	
	Metodo que simule a "invasão", o método deve existir somente na classe client.java que será setada para Sensor, talvez um botão que dispare
	um evento que set a variável _msgSensorToSaved(através do método setMsgSensorToSaved encontrado na mesma) e consequentemente a classe Saved 
	receba essa informação ( basta apenas ler a variável dita anteriormente)
	e set a variável _msgSavedToUser então o User ler tal variável e dispara ou não o alarme.

	no código, como estava em ambiente de teste a cada 5 segundos o servidor reseta o status de cada host, caso o host Saved esteja "Off" na hora 
	que o Sensor mandar mensagem, ao invés da variável _msgSensorToSaved ser setada	a que deverá ser setada é _msgSavedToUser 
	( realizando então o tratamento a falha)

	
Explicação de eventos:
--------------
	
	Classe startServer - a cada 5 segundos ( 20 segundos no máximo ) deve setar para Off o status de cada host, acionando o método setOff() da classe 
	infoMensagemI.java	
	
	