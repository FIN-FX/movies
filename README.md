#Setup

Setup at Amazon Instance with Amazon Linux AMI 2018.03

sudo -s

yum install docker

service docker start

usermod -a -G docker ec2-user

curl -L https://github.com/docker/compose/releases/download/1.21.0/docker-compose-`uname -s`-`uname -m` | sudo tee /usr/local/bin/docker-compose > /dev/null

chmod +x /usr/local/bin/docker-compose

ln -s /usr/local/bin/docker-compose /usr/bin/docker-compose

yum install -y git

git clone https://github.com/FIN-FX/movies.git

cd movies

docker-compose up -d

docker-compose exec movies php app/migrations/up.php

#Admin
admin@example.com

123qweasd

URL: http://127.0.0.1