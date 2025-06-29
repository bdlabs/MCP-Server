# MCP Server - Modular Communication Protocol Server

## Overview

MCP Server is a powerful and flexible server solution that enables easy integration and management of various tools and communication methods. Designed according to SOLID principles, it offers a modular architecture allowing rapid extension of functionality without modifying existing code.

## Project Structure

```plaintext
mcp-server/
├── Server/
│   ├── Registry/
│   │   ├── MethodRegistry.php      # Registry of available API methods
│   │   └── ToolRegistry.php        # Registry of available tools
│   │
│   ├── ResponseFormatter/
│   │   ├── ResponseFormatterInterface.php  # Response formatter interface
│   │   ├── JsonResponseFormatter.php       # JSON response formatter
│   │   └── EventStreamResponseFormatter.php # Event stream formatter
│   │
│   └── Response/
│       ├── TextContentResponse.php         # Text response
│       ├── ImageContentResponse.php        # Image response
│       ├── AudioContentResponse.php        # Audio response
│       └── ResourceContentResponse.php     # Resource response
│
├── Tool/
│   └── AbstractTool.php            # Abstract for tools
│
├── MCPServer.php                   # Main server class
├── MCPServerBuilder.php            # Builder for easy server creation
└── MCPServerMethodParams.php       # Server method parameters
```

## Core Components

### MCPServer

The main server class responsible for processing requests and managing tool and method registration. It uses the facade pattern to simplify complex internal logic.

### Registries

- **ToolRegistry** - manages the collection of available tools
- **MethodRegistry** - manages available API methods

### Response Formatters

Implement the strategy pattern, enabling flexible response formatting:

- **JsonResponseFormatter** - formats responses as JSON
- **EventStreamResponseFormatter** - formats responses as event streams

### Response Types

A set of classes representing different types of tool responses:

- **TextContentResponse** - text responses
- **ImageContentResponse** - responses containing images
- **AudioContentResponse** - responses containing audio
- **ResourceContentResponse** - responses containing various resources

## Usage Example

```php
<?php

use MCP\MCPServer;
use MCP\MCPServerBuilder;
use MCP\Tool\MyCustomTool\Tool as MyCustomTool;

// Creating a server using the builder
$server = (new MCPServerBuilder())
    ->addTool(new MyCustomTool())
    ->build();

// Running the server
$server->handleRequest();
```

## Creating Custom Tools

To create a new tool:

1. Create a class implementing the `ToolInterface`
2. Register the tool using `MCPServerBuilder::addTool()`

```php
<?php

namespace MCP\Tool\MyCustomTool;

use MCP\Tool\Response\ToolResponsable;

class Tool extends AbstractTool
{
    public function __construct()
    {
        $this->name = '';
        $this->description = '';
        $this->inputSchema = [];
    }
    
    public function execute(array $params): ToolResponsable
    {
        // Tool logic implementation
        return new TextContentResponse('Tool execution result');
    }
}
```

## License

This project is licensed under the GNU General Public License v3.0 (GPL-3.0). See the LICENSE file for details.

## Requirements

- PHP 8.1 or newer

## Contributing

We welcome contributions to this project! Please review our contribution guidelines in the CONTRIBUTING.md file.

## Contact

If you have any questions or issues, please create an issue in our GitHub repository.