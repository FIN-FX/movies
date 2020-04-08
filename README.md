# movies

sudo yum install docker

sudo service docker start

sudo usermod -a -G docker ec2-user

sudo curl -L https://github.com/docker/compose/releases/download/1.21.0/docker-compose-`uname -s`-`uname -m` | sudo tee /usr/local/bin/docker-compose > /dev/null

sudo chmod +x /usr/local/bin/docker-compose

ln -s /usr/local/bin/docker-compose /usr/bin/docker-compose

sudo yum install -y git

git clone https://github.com/FIN-FX/movies.git

cd movies

docker-compose up -d

docker-compose exec movies php app/migrations/up.php

