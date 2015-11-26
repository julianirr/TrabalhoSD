##NOTA DE LIBERAÇÃO: PROJETO ANÁLISE CPF	

Nome | RA
---- | ----
Juliani Rosa Reguini | 519243
Gustavo Luiz da Costa Rosa | 519626

###INTRODUÇÃO

Este documento provê uma visão geral da versão do sistema de Análise CPF que está sendo liberada. As funcionalidades são descritas como reconhecimento dos padrões de idade das pessoas portadoras do CPF, agrupando por parte do CPF. 

####1.	NOTA DE RELEASE A SER PUBLICADO
  
  •	Realizar uma análise com base nas informações do banco de dados para verificar a data de emissão do CPF, evitando possíveis fraudes.

####2.	PROBLEMAS CONHECIDOS E LIMITAÇÕES

**Limitação**
  
  •	Não foi descoberta nenhuma limitação até o momento.

####3.	DATAS IMPORTANTES

Segue abaixo as datas importante do desenvolvimento:

Data       | Evento
---------- | -----------
01/08/2015 | Início do planejamento
15/08/2015 |	Início do desenvolvimento
15/11/2015 |	Entrega para teste
20/11/2015 |	Fim do teste
24/11/2015 |	Liberação para produção

####4.	COMPATIBILIDADE

Segue abaixo os requisitos:

Requisitos  | Ferramentas
----------  | -----------
Navegadores Browser |  Mozila Firefox e Chrome
Sistema operacional |	Windows 7 e 8

  | Tecnologias
----------  | ---------
Linguagem de programação | PHP 
Framework WEB	| Não utilizado 
IDE |	Sublime 
Design pattern |	Não utilizado 
Servidor Web | Wamp Server 

####5.	PROCEDIMENTO E ALTERAÇÃO DE CONFIGURAÇÃO DO AMBIENTE
 
  O procedimento foi feito com o PHP 5.3 e o MySQL 5.6 para o desenvolvimento do serviço. E para a simulação do servidor Web foi utilizado o Wamp Server 2.5.

####6.	ATIVIDADES REALIZADAS NO PERÍODO
  
  Nessa liberação foram contemplados os seguintes itens:

Cód  | Título | Tarefa | Situação | Observação 
---------- | ----------- | ----------- | ----------- | -----------
1 | Consultar CPF | Foi feito um Web Service disponibilizando o serviço via post para realizar as consultas em nosso banco de dados. | Concluído | 
2 |	Cadastro de Usuários | Realizar um cadastro/alterar/visualizar/excluir de usuários para acesso ao sistema. | Concluído |
3 |	Painel Administrativo | Foi feito uma página inicial com um gráfico de tipos de retorno das consultas e um gráfico por usuários. | Concluído |



