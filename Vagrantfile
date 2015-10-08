# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure(2) do |config|
    config.vm.box = "scotch/box"
    config.vm.network "private_network", ip: "192.168.33.10"
    config.vm.hostname = "scotchbox"
    config.vm.synced_folder ".", "/var/www", :nfs => { :mount_options => ["dmode=777","fmode=666"] }

    config.ssh.shell = "bash -c 'BASH_ENV=/etc/profile exec bash'"

    config.vm.provision "shell", inline: <<-SHELL
        sudo apt-get install php5-xdebug
        sudo service apache2 restart
    SHELL

    config.vm.provision "shell", inline: <<-SHELL
        sudo sed -i s,/var/www/public,/var/www,g /etc/apache2/sites-available/000-default.conf
        sudo sed -i s,/var/www/public,/var/www,g /etc/apache2/sites-available/scotchbox.local.conf
        sudo service apache2 restart
    SHELL

    config.vm.provision "shell", inline: <<-SHELL

        export PATH="~/.composer/vendor/bin:$PATH" 
        composer self-update

    SHELL

    config.vm.provision "shell", inline: <<-SHELL
        mysqladmin -u root -proot password ''
        mysql -u root -e "CREATE DATABASE IF NOT EXISTS mercado CHARACTER SET utf8 COLLATE utf8_general_ci;"
        mysql -u root mercado < /var/www/bd_bkp/mercado.sql
    SHELL

end
