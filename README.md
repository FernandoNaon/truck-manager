# Truck Manager - Tech Challenge

This application is a simple truck purchasing platform built using Laravel 10, Vue.js 3, and Vite. It allows users to browse available trucks, filter them and purchase them. Additionally, users can sell their owned trucks and view their remaining cash balance.

## Features

- View available trucks for purchase
- Purchase trucks and deduct the cost from the user's cash balance
- Sell owned trucks to increase the user's cash balance
- Input and state validation
- Seeders for generating sample data
- Frontend filtering of vehicles based on maximum price
- Responsive design

## Requirements

- PHP >= 8.1
- Laravel 10.10
- MySQL database
- Node.js
- npm

## Installation

1. Clone the repository:

    ```bash
    git clone
    ```

2. Navigate to the project directory:

    ```bash
    cd truck-manager
    ```

3. Install PHP dependencies using Composer:

    ```bash
    composer install
    ```

4. Install Node.js dependencies using npm:

    ```bash
    npm install
    ```

5. Run database migrations and seeders to generate sample data:

    ```bash
    php artisan migrate
    php artisan db:seed
    ```

6. Start the development server:

    ```bash
    php artisan serve
    npm run dev
    ```

    This will start both the Laravel server and the Vite frontend development server.

## Usage

- Upon visiting the application, you will be prompted to select a user.
- Once a user is selected, you can view available trucks for purchase.
- Click on the "Buy" button to purchase a truck. You will be prompted to confirm the purchase.
- You can also customize the attributes of a truck by clicking on the "Customize" button.
- After making any customizations, confirm the changes to update the truck's attributes.
- You can view your owned trucks and remaining cash balance by clicking on the "My Trucks" link.
- To sell a truck, navigate to the "My Trucks" section and click on the "Sell" button for the desired truck.


## Time Tracking

1) Backend part
- [x] - A database with a “user”, “vehicle” and “user vehicle” tables ---> 45 min
- [x] - Controller function for fetching user data (ie cash) ---> 30 min
- [x] - Controller function for fetching vehicles ---> 30 min
- [x] - Controller function for saving vehicle on user ---> 1 hour


2) Frontend part
- [x] Amount of cash remaining ---> 1 hour
- [x] Owned trucks ---> 30 min
- [x]  List of trucks available for purchase ---> 30 min
- [x]  Purchase of selected truckOptional - if time allows (in whatever order you choose): ---> 45 min


2) Optional
- [x]  Option to sell trucks ---> 45 min
- [ ]  Option to customize truck before/after purchase 
- [x]  Input and state validation (valid truck purchase, user has enough cash etc) ---> 1 hour
- [ ]  User login/create/logout 
- [x]  Seeders for generating data (users, vehicles) ---> 45 min
- [x]  Option for frontend to ask backend for filtered data ---> 1 hour 
- [ ]  Animations when going through menus
- [ ]  Loading spinners when waiting for backend to fetch data

Total = 10 hours


## License

This project is open-source and available under the [MIT License](LICENSE).
