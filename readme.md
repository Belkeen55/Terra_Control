Installation de Terra_Control
==
#### Installation du systeme (Fait sur Raspbian jessie lite 2017 03 02) 
	sudo raspi-config 
		Expand SD card 
		Internationalisation 
		HostName Terra_Control 
		Activation SSH

#### Mise à jour du systeme 
	sudo apt update 
	sudo apt upgrade 

#### Securisation de connexion 
	sudo adduser "utilisatteur" 
	sudo visudo 
	Ajouter "Utilisateur" ALL=(ALL) NOPASSWD: ALL 
	logout 
	login avec "Utilisateur" 
	sudo visudo 
	retirer la ligne pi ALL=(ALL) NOPASSWD: ALL 
	ajouter la ligne www-data ALL=(ALL) NOPASSWD:/opt/vc/bin/vcgencmd measure_temp,/usr/bin/apt update 
	sudo deluser --remove-home pi 
	sudo passwd 
	
#### Installation des packages 
	sudo apt install git 
	sudo apt install apache2 
	sudo chown -R www-data:"utilisateur" /var/www 
	sudo chmod -R 770 /var/www/html 
	sudo apt install php5 
	sudo apt install mysql-server php5-mysql 
	sudo apt install phpmyadmin 

#### Creation Key SSH 
	ssh-keygen -t rsa -b 4096 -C "adresse_mail" 
	cd ~/.ssh 
	eval `ssh-agent -s` 
	eval `ssh-agent -c` 
	ssh-add id_rsa 
	more id_rsa.pub 
		copier/collé dans gitHub 

#### Mise en place des gits 
	cd /var/www/html/
	git init
	sudo git remote add hub git@github.com:Belkeen55/"deposit".git 

#### Configuration réseau
	sudo nano /etc/network/interfaces 
	auto lo 
	iface lo inet loopback 
	auto eth0 
	iface eth0 inet dhcp 
    allow-hotplug wlan0 
	auto wlan0 
	iface wlan0 inet dhcp 
	wpa-ssid "" 
	wpa-psk "" 
	
#### Installation outils de clonage
	git clone https://github.com/billw2/rpi-clone.git 
	cd rpi-clone 
	sudo cp rpi-clone /usr/local/sbin 
	sudo blkid 
	sudo rpi-clone "sdX" 
	
#### Installation driver/soft DHT 22
	cd /var/www/html/ 
	git clone https://github.com/adafruit/Adafruit_Python_DHT.git  
	cd Adafruit_Python_DHT 
	sudo python setup.py install 
	cd examples 
	sudo ./AdafruitDHT.py 22 4 
	4 étant le GPIO de donnée 

#### mise en place des Cron	
	crontab -e 
	1 7 * * * php /var/www/html/daily.php >/dev/null 2>&1 