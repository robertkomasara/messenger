Vagrant.configure("2") do |config|
  
  config.vm.provider "virtualbox" do |vb|
    vb.cpus = 4; vb.memory = 2048
  end

  config.vm.box = "generic/ubuntu2204"
  config.vm.synced_folder ".", "/home/vagrant/src"

  config.vm.define "app" do |subconfig|
    
    subconfig.vm.hostname = 'msg.app.local'
    subconfig.vm.post_up_message = 'Messenger server host'
    subconfig.vm.network "private_network", ip: '192.168.56.101'
    subconfig.vm.network "forwarded_port", guest: 2210, host: 3210

    subconfig.vm.provision "shell", path: "vagrant/provisions/hosts/app/install.sh", privileged: true

    subconfig.trigger.after :up do |trigger|
      trigger.info = "Starting trigger after up..."
      trigger.run_remote = { path: "vagrant/triggers/hosts/app/after-up.sh", privileged: false }
    end
    subconfig.trigger.before :destroy, :halt do |trigger|
      trigger.info = "Starting trigger before down..."
      trigger.run_remote = { path: "vagrant/triggers/hosts/app/before-down.sh", privileged: false }
    end

  end

end
