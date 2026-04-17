{ pkgs, ... }: {
  channel = "stable-24.05";
  packages = [
    pkgs.php
    pkgs.mariadb        # Adds the local database
  ];
  env = {};
  idx = {
    extensions = [
      "google.gemini-cli-vscode-ide-companion"
      "mrmlnc.vscode-apache" # Optional: useful for PHP
    ];
    previews = {
      enable = true;
      previews = {
        web = {
          command = ["php" "-S" "0.0.0.0:9002" "-t" "."];
          manager = "web";
        };
      };
    };
    workspace = {
      onCreate = {
        # Setup the database folder and initialize it
        setup-db = ''
          mysql_install_db --datadir=$HOME/.mysql --basedir=${pkgs.mariadb} --auth-root-authentication-method=normal
          mkdir -p $HOME/.mysql/run
        '';
        default.openFiles = ["index.php"];
      };
      onStart = {
        # Start the database server automatically
        start-mysql = "mysqld --datadir=$HOME/.mysql --socket=$HOME/.mysql/mysql.sock --pid-file=$HOME/.mysql/mysql.pid --skip-networking=0 &";
      };
    };
  };
}