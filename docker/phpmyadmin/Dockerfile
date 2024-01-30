FROM phpmyadmin

#RUN apt-get update && apt-get upgrade -y && apt-get install -y ssh && mkdir /root/.ssh
RUN apt-get update && apt-get upgrade -y && mkdir /root/.ssh

COPY laurentino_svn_rsa /root/.ssh/
RUN apt-get install -y ssh && ssh-keyscan -H 83.169.34.195 >> ~/.ssh/known_hosts

#CMD /usr/bin/ssh  -4 -i ~/.ssh/laurentino_svn_rsa -f  -oServerAliveInterval=60 -N -L 6666:127.0.0.1:3306 mysqlgast@83.169.34.195


