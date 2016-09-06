HOSTNAME = "skeleton.vagrant.test"

unless Vagrant.has_plugin?("landrush")
  raise 'Landrush is required: vagrant plugin install landrush'
end

Vagrant.configure("2") do |config|
	config.vm.box = "hashicorp/precise64"
	config.vm.box_url = "http://files.vagrantup.com/precise64.box"

	config.landrush.enabled = true
	config.vm.hostname = HOSTNAME

	config.vm.provision :shell, :path => "vagrant-setup.sh"
	config.vm.provision :shell, :path => "vagrant-script.sh", run: "always"

	config.vm.synced_folder ".", "/var/www", :mount_options => ['dmode=777,fmode=777']
end


# SSH Host:   <hostname>
# SSH User:   vagrant
# SSH Pass:   vagrant
# MySQL Host: 127.0.0.1
# MySQL User: root
# MySQL Pass: root
