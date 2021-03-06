set :branch, "staging"

### DO NOT EDIT BELOW ###

set :document_root, "/home/sites/php71/#{fetch :client}/#{fetch :project}"
set :deploy_to, "/home/sites/apps/#{fetch :client}/#{fetch :project}"
set :keep_releases,  2
set :url, "http://#{fetch :project}.#{fetch :client}.php71.sumocoders.eu"
set :fcgi_connection_string, "/var/run/php_71_fpm_sites.sock"
set :php_bin, "php7.1"

server "dev02.sumocoders.eu", user: "sites", roles: %w{app db web}

SSHKit.config.command_map[:composer] = "#{fetch :php_bin} #{shared_path.join("composer.phar")}"
SSHKit.config.command_map[:php] = fetch(:php_bin)
