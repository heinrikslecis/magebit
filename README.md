# Web Developer Test for Magebit 2021 by Heinriks Lecis

## Installation

1. Clone the repo
   ```sh
   git clone https://github.com/slavisto/magebit.git
   ```
2. import database from included sql file `magebit.sql`

## Usage

Configure database params at "app/config/config.php"
If you are not using localhost as host, you should change URLROOT at "app/config/config.php" to your Root URL

To access index page type URL root "http://localhost/magebit/"

To access all saved data from database type "http://localhost/magebit/data"

## Compile yourself
I have included composer and compiled scss stylesheet in repo but
If you wish to install autoloader and compile sass yourself:
1. Install Composer autoloader
   ```sh
   composer install
   ```
2. Compile sass to css
   ```sh
   sass --watch app/sass/main.scss public/css/style.css
   ```
