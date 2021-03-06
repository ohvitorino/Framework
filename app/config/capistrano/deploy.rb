set :client,  ""
set :project, ""
set :repo_url, ""
set :production_url, ""

### DO NOT EDIT BELOW ###
lock "3.8.0"

append :linked_files, "app/config/parameters.yml"
append :linked_dirs, "app/logs"

set :application, "#{fetch :project}"
set :symfony_console_path, "app/console"

set :deploytag_utc, false
set :deploytag_time_format, "%Y%m%d-%H%M%S"

namespace :deploy do
  after :check, "framework:symlink:document_root"

  after :starting, "composer:install_executable"
  after :starting, "opcache:phpfpm:install_executable"

  before :publishing, "assets:upload"

  after :published, "opcache:phpfpm:reset"
  after :published, "migrations:migrate"

  after :finished, "sumo:notifications:deploy"

  after :failed, "maintenance:disable"
end

namespace :assets do
  after :upload, "assets:update_assets_version"
end

namespace :migrations do
  before :migrate, "maintenance:enable"
  after :migrate, "maintenance:disable"
end
