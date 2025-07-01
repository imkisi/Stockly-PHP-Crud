# Stockly - Inventory Management

---

Stockly is a simple web-based **CRUD** (Create, Read, Update, Delete) application built with **PHP** and **SQL** for managing product inventory. It allows you to keep track of your stock data, including adding new items, viewing existing ones, updating their details, and removing them when necessary.

---

## Features

* **Add New Item**: Easily add new products to your inventory with details like product name, quantity, and price.
* **View Stock**: Browse a table of all your current stock items.
* **Edit Item**: Update the details of any existing product in your inventory.
* **Delete Item**: Remove products from your stock that are no longer needed.
* **Search and Filter**: (Optional - you can add this later!) Implement search or filter functionality to quickly find specific items.

---

## Technologies Used

* **PHP**: Server-side scripting language for handling application logic.
* **SQL**: For database management.
* **HTML/CSS**: For the front-end structure and styling.
* **JavaScript**: (Optional) For enhanced interactivity.

---

## Getting Started

Follow these steps to get Stockly up and running on your local machine.

### Prerequisites

* A web server with PHP support (e.g., Apache, Nginx).
* A SQL database server (e.g., MySQL, MariaDB).
* Composer (optional, if you plan to use any PHP libraries).

### Installation

1.  **Clone the repository:**
    ```bash
    git clone [https://github.com/your-username/stockly.git](https://github.com/your-username/stockly.git)
    cd stockly
    ```
    (Replace `kisi` with your actual GitHub username and `stockly` with your repository name if different.)

2.  **Database Setup:**
    * Create a new SQL database (e.g., `stockly_db`).
    * Import the provided SQL schema (e.g., `database.sql`) into your new database. This file will create the necessary tables.
        ```sql
        -- Example of database.sql content for a 'products' table
        CREATE TABLE products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_name VARCHAR(255) NOT NULL,
            quantity INT NOT NULL,
            price DECIMAL(10, 2) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
        ```
    * Update the database connection details in `config.php` (or similar file) to match your database credentials.

3.  **Configure PHP:**
    * Ensure your web server is configured to serve the `stockly` directory.
    * Open `config.php` (or the equivalent file) and adjust the database connection parameters:
        ```php
        <?php
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'your_db_username');
        define('DB_PASSWORD', 'your_db_password');
        define('DB_NAME', 'stockly');

        // Attempt to connect to MySQL database
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        // Check connection
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        ?>
        ```
        (Replace `your_db_username` and `your_db_password` with your actual database credentials.)

4.  **Access the application:**
    * Open your web browser and navigate to the URL where you've deployed Stockly (e.g., `http://localhost/stockly`).

---

## Usage

Once the application is running, you can:

* Navigate to the **"Add New Product"** section to input new stock items.
* View all your products on the **main inventory list**.
* Click **"Edit"** next to any item to modify its details.
* Click **"Delete"** next to any item to remove it from your inventory.

---

## Project Structure
stockly/
├── index.php             # Main page for viewing and managing products
├── add.php               # Page for adding new products
├── edit.php              # Page for editing existing products
├── delete.php            # Script for handling product deletion
├── config.php            # Database connection and configuration
├── css/
│   └── style.css         # Custom CSS for styling
├── js/
│   └── script.js         # (Optional) JavaScript for interactivity
└── database.sql          # SQL schema for database setup

---

## Contributing

Contributions are welcome! If you'd like to improve Stockly, please follow these steps:

1.  Fork the repository.
2.  Create a new branch (`git checkout -b feature/your-feature-name`).
3.  Make your changes and commit them (`git commit -m 'Add new feature'`).
4.  Push to the branch (`git push origin feature/your-feature-name`).
5.  Create a Pull Request.

---

## License

This project is open-source and available under the [MIT License](LICENSE).

---
