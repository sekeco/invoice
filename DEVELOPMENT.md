# Invoice App - Development Setup

## 🚀 Quick Start

### Option 1: Recommended Development Setup

**Frontend locally + Backend in Docker**

```bash
# 1. Start backend services (API + MySQL)
./dev.sh backend

# 2. In another terminal, start frontend locally
./dev.sh frontend
```

**Advantages:**

-   ✅ Hot module replacement for frontend
-   ✅ Faster frontend rebuilds
-   ✅ Better debugging experience
-   ✅ Native IDE integration

### Option 2: Full Docker Setup

**Everything in Docker**

```bash
# Start all services in Docker
./dev.sh full
```

## 📁 Project Structure

```
.
├── dev.sh                    # Development helper script
├── docker-compose.yml        # Full stack (production-like)
├── docker-compose.dev.yml    # Backend only (development)
├── .env                      # Centralized environment config
├── api/                      # Laravel API
│   ├── .env → ../.env       # Symbolic link to root .env
│   └── ...
└── app/                      # Nuxt.js Frontend
    ├── .env → ../.env       # Symbolic link to root .env
    └── ...
```

## 🚀 Initial Setup

### For New Developers

```bash
# Option 1: Full automated setup
./setup.sh

# Option 2: Manual setup
./env-setup.sh              # Setup environment from .env.example
./dev.sh backend            # Start backend services
./dev.sh frontend           # Start frontend (in another terminal)
```

### Environment Configuration

```bash
./env-setup.sh              # Copy .env.example and generate APP_KEY
# OR manually:
cp .env.example .env
./dev.sh laravel key:generate
```

## 🛠 Development Commands

### Backend Services (API + MySQL)

```bash
./dev.sh backend          # Start backend services
./dev.sh stop             # Stop backend services
./dev.sh logs             # Show all logs
./dev.sh logs api         # Show API logs only
./dev.sh logs mysql       # Show MySQL logs only
```

### Laravel Commands

```bash
./dev.sh laravel migrate                    # Run migrations
./dev.sh laravel migrate:fresh --seed       # Fresh database with seeds
./dev.sh laravel tinker                     # Laravel REPL
./dev.sh laravel make:controller UserController
./dev.sh laravel queue:work                 # Start queue worker
```

### Frontend Development

```bash
./dev.sh frontend         # Start Nuxt dev server locally
# OR manually:
cd app && npm run dev
```

### Full Docker Stack

```bash
./dev.sh full             # Start everything in Docker
./dev.sh status           # Show service status
```

## 🌐 Service URLs

| Service  | URL                   | Description |
| -------- | --------------------- | ----------- |
| Frontend | http://localhost:3000 | Nuxt.js app |
| API      | http://localhost:8080 | Laravel API |
| MySQL    | localhost:3306        | Database    |

## 🔧 Environment Configuration

### Single Source of Truth

All environment variables are defined in the root `.env` file:

-   `API_PORT=8080` - Laravel API port
-   `APP_PORT=3000` - Nuxt.js frontend port
-   `DB_*` - Database configuration
-   `NUXT_*` - Frontend configuration

### Development Modes

The setup supports flexible development modes via the `FRONTEND_MODE` variable:

-   `local` - Run frontend with `npm run dev` (recommended)
-   `docker` - Run frontend in Docker container

## 📋 Development Workflow

### Daily Development

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
```

### Debugging

```bash
# View logs in real-time
./dev.sh logs

# Access Laravel container
docker-compose -f docker-compose.dev.yml exec api bash

# Laravel tinker
./dev.sh laravel tinker
```

## 🔍 Troubleshooting

### Common Issues

**Port conflicts:**

```bash
# Check what's using port 8080 or 3000
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
docker volume prune -f

# Rebuild containers
./dev.sh stop
docker-compose -f docker-compose.dev.yml build --no-cache
./dev.sh backend
```

### Environment Issues

```bash
# Verify environment variables
./dev.sh laravel env

# Check database connection
./dev.sh laravel migrate:status
```

## ⚡ Performance Tips

1. **Use the recommended setup** (local frontend + Docker backend)
2. **Keep Docker volumes** for faster MySQL restarts
3. **Use .env.local** for frontend-specific overrides
4. **Leverage hot module replacement** with `npm run dev`

## 📚 Additional Resources

-   [Laravel Documentation](https://laravel.com/docs)
-   [Nuxt.js Documentation](https://nuxt.com)
-   [Docker Compose Documentation](https://docs.docker.com/compose/)
-   [Laravel Sail Documentation](https://laravel.com/docs/sail)

## 🤝 Contributing

1. Use the development helper script: `./dev.sh`
2. Follow the recommended development workflow
3. Test both frontend modes before submitting
4. Ensure all migrations and seeds work correctly

---

**Happy coding! 🎉**
