#!/bin/bash

# Environment setup script
# Copies .env.example to .env and generates APP_KEY

echo "🔧 Setting up environment configuration..."

# Check if .env already exists
if [ -f ".env" ]; then
    echo "⚠️  .env file already exists!"
    read -p "Do you want to overwrite it? (y/N): " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        echo "❌ Setup cancelled."
        exit 1
    fi
fi

# Copy .env.example to .env
if [ ! -f ".env.example" ]; then
    echo "❌ .env.example file not found!"
    exit 1
fi

echo "📋 Copying .env.example to .env..."
cp .env.example .env

echo "🔑 Generating Laravel application key..."
# Start backend if not running
if ! docker-compose -f docker-compose.dev.yml ps | grep -q "Up"; then
    echo "🐳 Starting backend services to generate key..."
    ./dev.sh backend
    sleep 5
fi

# Generate the key
./dev.sh laravel key:generate

echo ""
echo "✅ Environment setup complete!"
echo ""
echo "📋 Next steps:"
echo "1. Review and update .env file if needed"
echo "2. Start development: ./dev.sh backend && ./dev.sh frontend"
echo ""
echo "📚 Documentation:"
echo "- DEVELOPMENT.md - Development workflow"
echo "- ENV_SETUP.md - Environment configuration"
echo ""
