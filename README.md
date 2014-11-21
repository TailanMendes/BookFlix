Tópicos Especiais Engenharia da Computação
===========


BookFlix WebService - PHP
------------------------
 O webservice está em PHP e o BD em Mysql, portanto, para usar o mesmo deve-se povoar os dados no banco
 utilizando os scripts da pasta script.
 
 As regras para enviar as informações para o webservice está descrita nos arquivos, por exemplo,
 no arquivo fucntion.php descreve como deve ser a passagem de dados para cada função, quais regras devem 
 ser seguidas, etc.
 
 A validação das regras deve ser realizada na aplicação que estará utilizando o webservice,por exemplo,
 SITE consome um cliente com o webservice BookFlix, o site deverá tratar os dados conforme as regras.
 
 As regras do banco de dados devem ser obecidas.Atributos NOT NULL, por exemplo.
 
 Alterações e Regras:
 -----------------
 *Campo 'limite' do tipo de dado Search está depreciado para uso sozinho, somente permitido 
  em conjunto com ou o campo 'nomeAprox' ou 'nomeExato'
 * Os dados que não forem preenchidos, devem ser NULL, explicitamente.
 * O tipo de imagem para o thumb do livro ( capa ) deverá ser somente *.jpg