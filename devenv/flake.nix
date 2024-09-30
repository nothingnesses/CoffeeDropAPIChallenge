{
  inputs = {
    devenv = {
      inputs.nixpkgs.follows = "nixpkgs-unstable";
      url = "github:cachix/devenv";
    };
    env = {
      url = "path:/home/jesse/documents/projects/php-playground/CoffeeDropAPIChallenge/env/";
    };
    nixpkgs.url = "github:NixOS/nixpkgs/nixos-24.05";
    nixpkgs-unstable.url = "github:NixOS/nixpkgs/nixpkgs-unstable";
    phps = {
      inputs.nixpkgs.follows = "nixpkgs";
      url = "github:fossar/nix-phps";
    };
  };
  nixConfig = {
    extra-trusted-public-keys = "devenv.cachix.org-1:w1cLUi8dv3hnoSPGAuibQv+f9TZLr6cv/Hm9XgU50cw= cache.nixos.org-1:6NCHdD59X431o0gWypbMrAURkbJ16ZPMQFGspcDShjY= fossar.cachix.org-1:Zv6FuqIboeHPWQS7ysLCJ7UT7xExb4OE8c4LyGb5AsE= nix-community.cachix.org-1:mB9FSh9qf2dCimDSUo8Zy7bkq5CX+/rkCWyvRCYg3Fs=";
    extra-substituters = "https://devenv.cachix.org https://cache.nixos.org https://fossar.cachix.org https://nix-community.cachix.org";
  };
  outputs = {
    env,
    devenv,
    nixpkgs,
    nixpkgs-unstable,
    phps,
    self,
    systems,
    ...
  } @ inputs: let
    for-each-system = nixpkgs.lib.genAttrs (import systems);
  in {
    packages = for-each-system (system: {
      devenv-up = self.devShells.${system}.default.config.procfileScript;
    });
    devShells = for-each-system (system: let
      pkgs = nixpkgs.legacyPackages.${system};
      pkgs-unstable = nixpkgs-unstable.legacyPackages.${system};
      make-env = {
        db-name,
        db-password,
        db-user,
        debug,
        domain,
        fpm-pool,
        php-version
      }:
        ({config, ...}: {
          certificates = [
            "*.${domain}"
          ];
          enterShell = ''
            sudo sysctl -w net.ipv4.ip_unprivileged_port_start=0
          '';
          hosts = {
            "*.${domain}" = "localhost";
          };
          languages = {
            javascript = {
              enable = true;
              npm = {
                enable = true;
              };
            };
            php = {
              enable = true;
              extensions = [
                "apcu"
                "opcache"
                "redis"
                "zlib"
              ] ++ (if debug then [
                "xdebug"
              ] else []);
              fpm = {
                pools = {
                  ${fpm-pool} = {
                    settings = {
                      "pm" = "dynamic";
                      "pm.max_children" = 8; # 2 * number of cores
                      "pm.start_servers" = 4; # max_children / 2
                      "pm.min_spare_servers" = 4; # max_children / 2
                      "pm.max_spare_servers" = 8; # min_spare_servers * 2
                    };
                  };
                };
                phpOptions = ''
                  memory_limit = -1
                  post_max_size = 256M
                  upload_max_filesize = 128M
                  zlib.output_compression = true
                '' + (if debug then ''
                  assert.exception = 1
                  display_errors = true
                  error_reporting = -1
                  log_errors_max_len = 0
                  opcache.enable = false
                  xdebug.mode = coverage,debug
                  xdebug.show_exception_trace = 0
                  xdebug.start_with_request = yes
                  zend.assertions = 1
                '' else ''
                  opcache.enable = true
                  opcache.memory_consumption = 128
                  opcache.interned_strings_buffer = 8
                  opcache.max_accelerated_files = 4000
                  opcache.revalidate_freq = 60
                  opcache.enable_cli = true
                  display_errors = false
                '');
              };
              version = php-version;
            };
          };
          packages = [pkgs.procps pkgs.toybox];
          services = {
            caddy = {
              config = ''
                {
                ${if debug then ''
                  debug
                '' else ""}
                }
              '';
              enable = true;
              package = pkgs-unstable.caddy;
              virtualHosts."adminer.${domain}" = {
                extraConfig = ''
                  root * ${pkgs.adminerevo}
                  php_fastcgi unix//${config.languages.php.fpm.pools.${fpm-pool}.socket}
                  encode gzip
                  tls ${config.env.DEVENV_STATE}/mkcert/_wildcard.${domain}.pem ${config.env.DEVENV_STATE}/mkcert/_wildcard.${domain}-key.pem
                  file_server browse
                '';
              };
            };
            postgres = {
              enable = true;
              extensions = extensions: [
                extensions.postgis
              ];
              initialDatabases = [
                {
                  name = db-name;
                }
              ];
              initialScript = ''
                CREATE USER ${db-user} SUPERUSER;
                ALTER ROLE root WITH PASSWORD '${db-password}';
              '';
              listen_addresses = "localhost";
            };
          };
        });
    in {
      default = devenv.lib.mkShell {
        inherit inputs;
        pkgs = pkgs-unstable;
        modules = builtins.map make-env [
          {
            db-name = env.db-name;
            db-password = env.db-password;
            db-user = env.db-user;
            debug = env.debug;
            domain = env.domain;
            fpm-pool = "0";
            php-version = "8.3";
          }
        ];
      };
    });
  };
}
