# Environment Configuration & Development Setup

## Overview

This project uses a centralized environment configuration with flexible development modes. You can run the frontend locally (`npm run dev`) or in Docker, while the backend runs in Docker containers.

## Development Modes

### 🚀 Recommended: Local Frontend Development

**Best for active frontend development with hot reload**

1. **Backend in Docker** (API + MySQL)
2. **Frontend locally** with `npm run dev`

```bash
# Start backend services only
./dev.sh backend

# In another terminal, start frontend locally
./dev.sh frontend
```

### 🐳 Full Docker Development

**Best for testing production-like environment**

```bash
# Start everything in Docker
./dev.sh full
```

## Quick Start

```bash
# 1. Start backend services (API + MySQL)
./dev.sh backend

# 2. Start frontend locally (in another terminal)
./dev.sh frontend

# Visit:
# - Frontend: http://localhost:3000
# - API: http://localhost:8080
```

## Environment Files

### Root `.env` File

Main configuration: `/Users/rasyidly/server/sekeco/invoice/.env`

### Symbolic Links

-   `api/.env` → `../.env` (Laravel reads from root)
-   `app/.env` → `../.env` (Nuxt reads from root)

## Development Helper Script

The `dev.sh` script provides convenient commands:

```bash
./dev.sh backend          # Start API + MySQL only
./dev.sh frontend         # Start frontend locally
./dev.sh stop             # Stop backend services
./dev.sh full             # Start full stack in Docker
./dev.sh logs [service]   # Show logs
./dev.sh laravel [cmd]    # Run Laravel commands
./dev.sh status           # Show service status
```

## Environment Variables

### Shared Variables

-   `WWWGROUP`, `WWWUSER` - Docker user configuration
-   `API_PORT`, `APP_PORT`, `FORWARD_DB_PORT` - Port mappings

### Laravel API Variables

-   `APP_NAME`, `APP_ENV`, `APP_KEY`, `APP_DEBUG`, `APP_URL`
-   `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
-   `SESSION_DRIVER`, `CACHE_STORE`, `QUEUE_CONNECTION`
-   `MAIL_MAILER`, `OCTANE_SERVER`

### Nuxt.js Frontend Variables

-   `NUXT_API_BASE_URL` - API endpoint for server-side requests
-   `NUXT_PUBLIC_API_BASE_URL` - API endpoint for client-side requests
-   `NUXT_PUBLIC_SANCTUM_BASE_URL` - Laravel Sanctum authentication endpoint
-   `NUXT_HOST`, `NUXT_PORT` - Development server configuration

#### App Container

Receives Nuxt-specific environment variables through Docker Compose environment mapping.

## Benefits

1. **Single Source of Truth**: All environment configuration is centralized in one file
2. **Consistency**: Both frontend and backend use the same environment values
3. **Easier Management**: Only one file to edit for environment changes
4. **Docker Integration**: Environment variables are properly passed to containers
5. **Development Efficiency**: No need to maintain multiple `.env` files

## Usage

To modify environment variables:

1. Edit the root `.env` file
2. Restart containers: `docker-compose down && docker-compose up -d`
3. Changes will be automatically applied to both API and app containers

## Important Notes

-   Do not edit `api/.env` or `app/.env` directly as they are symbolic links
-   Always edit the root `.env` file for any environment changes
-   Ensure Docker containers are restarted after environment changes
-   The symbolic links ensure both Laravel and Nuxt.js applications read from the same configuration
