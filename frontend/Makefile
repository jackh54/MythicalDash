.PHONY: build watch install

# Default target
all: build

# Install dependencies
install:
	yarn install

# Build the project
build: install
	yarn build
	
# Clean build artifacts (optional)
clean:
	rm -rf dist
	rm -rf node_modules