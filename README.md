# Project Title

Online Book Store

## Getting Started

### Dependencies

- Composer
- PHP >= 8.1
- MySQL
- Node.js & npm

Clone the repository

    git clone https://github.com/njmani007/online-store.git

Switch to the repo folder

    cd online-store

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Configure database in .env

    DB_CONNECTION=mysql
    DB_DATABASE=online_bookstore
    DB_USERNAME=root
    DB_PASSWORD=

Generate hyper link from storage folder to public folder

    php artisan storage:link

Install node dependencies

    npm install
    npm run build

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate:fresh

Start the local development server

    compoer run dev

You can now access the server at http://localhost:8000


### Google Books API Setup

#### Documentation : [Google Books API Reference](https://developers.google.com/books/docs/v1/reference/?apix=true).

##### Get a Google Books API Key from [Google Cloud Console](https://console.cloud.google.com).

##### Enable Books API in [Google Cloud Console](https://console.cloud.google.com).

##### Add the key to your .env file
    
    GOOGLE_BOOKS_API_KEY=api_key


