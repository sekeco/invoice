# 🔧 Environment Configuration Guide

## Quick Setup

```bash
# New project setup
./env-setup.sh              # Setup from .env.example
./setup.sh                  # Full project setup

# Daily development
./dev.sh backend            # Start API + MySQL
./dev.sh frontend           # Start Nuxt (another terminal)
```

## Environment Files

| File           | Purpose                     | Usage                     |
| -------------- | --------------------------- | ------------------------- |
| `.env.example` | Template with all variables | `cp .env.example .env`    |
| `.env`         | Active configuration        | Edit for your environment |
| `api/.env`     | Symbolic link               | Points to root `.env`     |
| `app/.env`     | Symbolic link               | Points to root `.env`     |

## Key Environment Variables

### 🔑 Required Setup

```bash
APP_KEY=                     # Generate with: ./dev.sh laravel key:generate
DB_DATABASE=invoice          # Database name
DB_USERNAME=sail             # Database user
DB_PASSWORD=password         # Database password
```

### 🌐 URLs & Ports

```bash
API_PORT=8080               # Laravel API port
APP_PORT=3000               # Nuxt frontend port
FORWARD_DB_PORT=3306        # MySQL port
APP_URL=http://localhost:8080
```

### 🎯 Frontend Configuration

```bash
NUXT_API_BASE_URL=http://localhost:8080
NUXT_PUBLIC_API_BASE_URL=http://localhost:8080
NUXT_PUBLIC_SANCTUM_BASE_URL=http://localhost:8080
FRONTEND_MODE=local         # 'local' or 'docker'
```

## Development Modes

### 🚀 Local Frontend (Recommended)

```bash
FRONTEND_MODE=local
# Run: ./dev.sh backend && ./dev.sh frontend
```

### 🐳 Full Docker

```bash
FRONTEND_MODE=docker
# Run: ./dev.sh full
```

## Scripts Reference

| Script           | Purpose                        |
| ---------------- | ------------------------------ |
| `./env-setup.sh` | Setup environment from example |
| `./setup.sh`     | Complete project setup         |
| `./dev.sh`       | Development helper commands    |

## Best Practices

1. **Never commit `.env`** - Keep sensitive data out of version control
2. **Update `.env.example`** - When adding new environment variables
3. **Use symbolic links** - Don't duplicate environment files
4. **Generate unique APP_KEY** - For each environment/developer
5. **Document changes** - Update this guide when adding new variables

## Troubleshooting

```bash
# Environment issues
./env-setup.sh              # Regenerate from example
./dev.sh laravel config:clear  # Clear config cache

# Missing APP_KEY
./dev.sh laravel key:generate

# Database connection issues
./dev.sh laravel migrate:status
./dev.sh logs mysql
```

---

For detailed development workflow, see [DEVELOPMENT.md](DEVELOPMENT.md)
