# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

        config.vm.box = "bento/debian-9"
        config.vm.define "xvwa"
        config.vm.hostname = "xvwa"

        databaseuser = "xvwa_database_user"
        databasepass = "damn_secret_xvwa_password"
        config.vm.provision :shell, inline: <<-END
                apt-get update -y
                apt-get install -y apache2 libapache2-mod-php php-mysql php-xml
                apt-get install -y mysql-server
                apt-get install -y git
                cd /var/www/html/
								echo '<?php header("Location: /xvwa/"); ?>' > index.php
								rm index.html
                git clone https://github.com/mgm-sp/xvwa
                chmod a+rwX -R xvwa
                cd xvwa
								cp php.ini /etc/php/7.0/apache2/conf.d/99-xvwa.ini
                sed -i '5 c $user = "#{databaseuser}";' config.php
                sed -i '6 c $pass = "#{databasepass}";' config.php
                mysql -u root -e "CREATE DATABASE IF NOT EXISTS xvwa"
                mysql -u root -e "CREATE USER '#{databaseuser}'@'%' IDENTIFIED BY '#{databasepass}';"
                mysql -u root -e "GRANT ALL PRIVILEGES ON xvwa.* TO '#{databaseuser}'@'%' WITH GRANT OPTION;"
                service apache2 force-reload
                wget --quiet http://localhost/xvwa/setup/?action=do
        END


        ### NinjaDVA specific configuration ###
        if File.exists?("../ninjadva.rb")
                require "../ninjadva"
                NinjaDVA.new(config)
        end
end

