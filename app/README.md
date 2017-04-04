# SageOne Brasil Programming Exercises


########################## ATENÇÃO ##############################
# 	OBS: Estas configurações estão no arquivo boostrap.sh,	# 
# basta executa-lo para configurar a máquina para a aplicação.	#
# Caso o acesso ao banco de dados for remoto, basta alterar o	#
# o arquivo ./app/sageone/modules/database/config/database.php	#
# com as informações de acesso ao banco de dados.		#
#################################################################


Construindo a aplicação

* A aplicação foi construida no sistema operaional Ubuntu 14.04 LTS
* Realizar a instalção do mysql-server
* Configurar o MySQL
	- No arquivo de configuração do banco de dados da aplicação a senha do usuário root é 'root'
	- Criar o banco de dados 'sageone'
	- Importar a estrutura do banco de dados (arquivo database.sql) para o schema 'sageone'
* Realizar a instalação do apache
* Realizar a instalação das dependencia do PHP e Banco de dados
* Apagar os arquivos de configuração padrões do apache
* Habilitar os hosts virtuais
* Habilitar o Mod Rewrite
* Adicionar alisa para sageone no arquivos hosts
* Reiniciar o apache
* Configurar o hostaname da máquina
