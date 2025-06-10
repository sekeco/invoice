# 🧾 Invoice Management Application

A modern, full-stack invoice management application built with Laravel API backend and Nuxt.js frontend, containerized with Docker for seamless development.

## 🚀 Tech Stack

-   **🔧 Laravel 11** - API backend with PHP 8.4
-   **🎨 Nuxt.js 4** - Modern Vue.js frontend
-   **🐳 Docker** - Containerized development environment
-   **📊 MySQL 8.0** - Database
-   **⚡ Automated Scripts** - Helper tools for development

## 📂 Project Structure

```
invoice/
├── 🔧 Development Scripts
│   ├── dev.sh                 # Main development helper
│   ├── setup.sh              # Complete project setup
│   └── env-setup.sh          # Environment setup
├── 🐳 Docker Configuration
│   ├── docker-compose.yml    # Full stack
│   └── docker-compose.dev.yml # Backend only
├── 🔧 api/ (Laravel)
│   ├── app/                  # Application logic
│   ├── database/             # Migrations, seeders
│   └── routes/               # API routes
└── 🎨 app/ (Nuxt.js)
    ├── app/                  # Vue components, pages
    ├── nuxt.config.ts        # Nuxt configuration
    └── package.json          # Frontend dependencies
```

## ⚡ Quick Start

### 🆕 First Time Setup

```bash
# Clone repository
git clone <repository-url>
cd invoice

# Complete automated setup
./setup.sh

# OR manual setup
./env-setup.sh              # Setup environment
./dev.sh backend            # Start backend services
./dev.sh frontend           # Start frontend (new terminal)
```

### 📅 Daily Development (Recommended)

**Hybrid Mode: Local Frontend + Docker Backend**

```bash
# Terminal 1: Start backend services (API + MySQL)
./dev.sh backend

# Terminal 2: Start frontend with hot reload
./dev.sh frontend
```

**Why this setup?**

-   ✅ Hot module replacement for frontend
-   ✅ Faster frontend rebuilds
-   ✅ Better debugging experience
-   ✅ Native IDE integration

### 🐳 Alternative: Full Docker Mode

```bash
# Start everything in Docker
./dev.sh full
```

## 🌐 Service URLs

| Service  | URL                   | Description |
| -------- | --------------------- | ----------- |
| Frontend | http://localhost:3000 | Nuxt.js app |
| API      | http://localhost:8080 | Laravel API |
| Database | localhost:3306        | MySQL       |

## 🛠️ Development Commands

### Main Helper Script (`./dev.sh`)

| Command             | Description                 |
| ------------------- | --------------------------- |
| `./dev.sh backend`  | Start API + MySQL only      |
| `./dev.sh frontend` | Start Nuxt locally with HMR |
| `./dev.sh full`     | Start everything in Docker  |
| `./dev.sh stop`     | Stop backend services       |
| `./dev.sh logs`     | Show all logs               |
| `./dev.sh status`   | Show service status         |

### Laravel Commands

```bash
./dev.sh laravel migrate                    # Run migrations
./dev.sh laravel migrate:fresh --seed       # Fresh database with seeds
./dev.sh laravel tinker                     # Laravel REPL
./dev.sh laravel make:controller UserController
./dev.sh laravel make:model Invoice -m      # Create model with migration
```

### NPM Scripts (Alternative)

```bash
npm run dev           # Start backend only
npm run dev:frontend  # Start frontend only
npm run dev:full      # Full Docker stack
npm run setup         # Complete setup with migrations
npm run stop          # Stop services
```

## 🔧 Development Workflow

### Typical Development Day

```bash
# 1. Start your day
./dev.sh backend

# 2. Start frontend (in another terminal)
./dev.sh frontend

# 3. Develop your features...

# 4. End of day
./dev.sh stop
```

### Database Operations

```bash
# Reset database
./dev.sh laravel migrate:fresh --seed

# Create migration
./dev.sh laravel make:migration create_invoices_table

# Create model
./dev.sh laravel make:model Invoice -m

# Check migration status
./dev.sh laravel migrate:status
```

## 🔍 Troubleshooting

### Common Issues

**Port conflicts:**

```bash
# Check what's using ports
lsof -i :8080
lsof -i :3000

# Kill process if needed
kill -9 <PID>
```

**MySQL connection issues:**

```bash
# Check if local MySQL is running
brew services list | grep mysql

# Stop local MySQL if running
brew services stop mysql
```

**Frontend won't start:**

```bash
# Clear Nuxt cache
cd app && rm -rf .nuxt .output

# Reinstall dependencies
cd app && rm -rf node_modules && npm install
```

**Docker issues:**

```bash
# Clean up Docker
docker system prune -f

# Rebuild containers
./dev.sh stop
docker-compose -f docker-compose.dev.yml build --no-cache
./dev.sh backend
```

## 🎯 Architecture Benefits

### Development Modes

#### 🚀 Recommended: Hybrid Development

-   **Backend**: Docker containers (API + MySQL)
-   **Frontend**: Local development (`npm run dev`)
-   **Benefits**: Hot reload, fast builds, easy debugging

#### 🐳 Full Docker Development

-   **All services**: Running in Docker containers
-   **Benefits**: Production-like environment, consistency

### Key Features

-   ✅ **Single source of truth** - Centralized environment config
-   ✅ **Automated setup** - One-command project initialization
-   ✅ **Hot reload support** - Fast frontend development
-   ✅ **Volume persistence** - Database data preservation
-   ✅ **Helper scripts** - Simplified common tasks

## 🤝 Contributing

1. Use the development helper script: `./dev.sh`
2. Follow the recommended hybrid development workflow
3. Test both frontend modes before submitting
4. Ensure all migrations work correctly

## 📚 Resources

-   [Laravel Documentation](https://laravel.com/docs)
-   [Nuxt.js Documentation](https://nuxt.com)
-   [Docker Compose Documentation](https://docs.docker.com/compose/)

---

**🎉 Happy coding!**
