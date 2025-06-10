# Invoice Monorepo

This is a monorepo containing a Laravel API backend and a Nuxt.js frontend application.

## Project Structure

```
├── docker-compose.yml          # Docker composition for all services
├── .env                        # Environment variables for all services
├── .env.example               # Example environment file
├── api/                       # Laravel backend API
│   ├── artisan
│   ├── composer.json
│   └── ...
└── app/                       # Nuxt.js frontend
    ├── nuxt.config.ts
    ├── package.json
    └── ...
```

## Services

-   **API**: Laravel backend running on port 8080
-   **App**: Nuxt.js frontend running on port 3000
-   **MySQL**: Database server running on port 3306

## Getting Started

### Prerequisites

-   Docker and Docker Compose
-   Git

### Installation

1. Clone the repository:

    ```bash
    git clone <repository-url>
    cd invoice
    ```

2. Copy the environment file:

    ```bash
    cp .env.example .env
    ```

3. Generate Laravel application key:

    ```bash
    docker-compose run --rm api php artisan key:generate
    ```

4. Install dependencies and start the services:

    ```bash
    docker-compose up -d
    ```

5. Run database migrations:
    ```bash
    docker-compose exec api php artisan migrate
    ```

### Accessing the Applications

-   **Frontend (Nuxt.js)**: http://localhost:3000
-   **Backend API (Laravel)**: http://localhost:8080
-   **Database**: localhost:3306

### Development Commands

#### Laravel API Commands

```bash
# Access Laravel container
docker-compose exec api bash

# Run Artisan commands
docker-compose exec api php artisan migrate
docker-compose exec api php artisan make:controller ExampleController
docker-compose exec api php artisan tinker

# Install Composer packages
docker-compose exec api composer install
docker-compose exec api composer require package-name
```

#### Nuxt.js App Commands

```bash
# Access Nuxt container
docker-compose exec app sh

# Install NPM packages
docker-compose exec app npm install package-name

# Run development mode
docker-compose exec app npm run dev
```

### Environment Variables

The `.env` file in the root directory contains configuration for both services:

-   **Shared variables**: Ports, Docker configuration
-   **Laravel API**: Database, cache, mail, etc.
-   **Nuxt.js**: API endpoints and frontend configuration

### Stopping the Services

```bash
docker-compose down
```

### Troubleshooting

1. **Permission Issues**: Make sure WWWGROUP and WWWUSER in .env match your system:

    ```bash
    id -g  # Get your group ID
    id -u  # Get your user ID
    ```

2. **Port Conflicts**: Change the ports in .env if they're already in use:

    ```
    API_PORT=8080
    APP_PORT=3000
    FORWARD_DB_PORT=3306
    ```

3. **Database Connection**: Ensure DB_HOST is set to "mysql" (the service name) in .env

## Contributing

1. Make your changes in the appropriate directory (`api/` or `app/`)
2. Test your changes locally using Docker Compose
3. Submit a pull request

## 📚 Documentation

-   **[DEVELOPMENT.md](DEVELOPMENT.md)** - Development workflow and commands
-   **[ENV_SETUP.md](ENV_SETUP.md)** - Environment configuration details
-   **[ENV_GUIDE.md](ENV_GUIDE.md)** - Environment variables reference
-   **[GITIGNORE.md](GITIGNORE.md)** - Git ignore patterns and best practices

## License

[Your License Here]
