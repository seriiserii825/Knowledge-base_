### create filter

```typescript
// src/common/filters/database-exception.filter.ts
import { ExceptionFilter, Catch, ArgumentsHost, HttpStatus, HttpException } from "@nestjs/common";
import { Response } from "express";
import { QueryFailedError } from "typeorm";

@Catch(QueryFailedError) // Catches TypeORM database errors
export class DatabaseExceptionFilter implements ExceptionFilter {
  catch(exception: any, host: ArgumentsHost) {
    const ctx = host.switchToHttp();
    const response = ctx.getResponse<Response>();
    const request = ctx.getRequest();

    let status = HttpStatus.INTERNAL_SERVER_ERROR;
    let message = "Internal server error";
    let error = "Database Error";

    // PostgreSQL Foreign Key Constraint
    if (exception.code === "23503") {
      status = HttpStatus.BAD_REQUEST;
      message = "Cannot delete record due to existing references in related tables";
      error = "Foreign Key Constraint Violation";
    }

    // PostgreSQL Unique Constraint
    else if (exception.code === "23505") {
      status = HttpStatus.CONFLICT;
      message = "Record with this value already exists";
      error = "Unique Constraint Violation";

      // Extract field name from error detail
      const detail = exception.detail || "";
      const match = detail.match(/Key \((.*?)\)=/);
      if (match) {
        message = `${match[1]} already exists`;
      }
    }

    // PostgreSQL Not Null Constraint
    else if (exception.code === "23502") {
      status = HttpStatus.BAD_REQUEST;
      message = "Required field is missing";
      error = "Not Null Constraint Violation";
    }

    // MySQL Foreign Key Constraint
    else if (exception.code === "ER_ROW_IS_REFERENCED_2" || exception.errno === 1451) {
      status = HttpStatus.BAD_REQUEST;
      message = "Cannot delete record due to existing references";
      error = "Foreign Key Constraint Violation";
    }

    // MySQL Duplicate Entry
    else if (exception.code === "ER_DUP_ENTRY" || exception.errno === 1062) {
      status = HttpStatus.CONFLICT;
      message = "Record with this value already exists";
      error = "Duplicate Entry";
    }

    // SQLite Foreign Key Constraint
    else if (exception.message?.includes("FOREIGN KEY constraint failed")) {
      status = HttpStatus.BAD_REQUEST;
      message = "Cannot delete record due to existing references";
      error = "Foreign Key Constraint Violation";
    }

    // Log error for debugging
    console.error("Database Error:", {
      code: exception.code,
      errno: exception.errno,
      message: exception.message,
      detail: exception.detail,
    });

    response.status(status).json({
      statusCode: status,
      timestamp: new Date().toISOString(),
      path: request.url,
      method: request.method,
      message,
      error,
    });
  }
}
```

### 2. Apply globally in main.ts

```ts
typescript; // src/main.ts
import { NestFactory } from "@nestjs/core";
import { AppModule } from "./app.module";
import { DatabaseExceptionFilter } from "./common/filters/database-exception.filter";

async function bootstrap() {
  const app = await NestFactory.create(AppModule);

  // Apply filter globally
  app.useGlobalFilters(new DatabaseExceptionFilter());

  await app.listen(3000);
}
bootstrap();
```

### 3. Or apply in specific module

```ts
typescript// src/app.module.ts
import { Module } from '@nestjs/common';
import { APP_FILTER } from '@nestjs/core';
import { DatabaseExceptionFilter } from './common/filters/database-exception.filter';

@Module({
imports: [...],
providers: [
{
provide: APP_FILTER,
useClass: DatabaseExceptionFilter,
},
],
})
export class AppModule {}
```

### 4. Or apply to specific controller

```ts
typescript; // src/products/products.controller.ts
import { Controller, UseFilters } from "@nestjs/common";
import { DatabaseExceptionFilter } from "../common/filters/database-exception.filter";

@Controller("products")
@UseFilters(DatabaseExceptionFilter) // Apply to entire controller
export class ProductsController {
  // ...
}
```

### 5. Enhanced version with all error types

```typescript
typescript; // src/common/filters/database-exception.filter.ts
import { ExceptionFilter, Catch, ArgumentsHost, HttpStatus, Logger } from "@nestjs/common";
import { Response, Request } from "express";
import { QueryFailedError } from "typeorm";

interface ErrorResponse {
  statusCode: number;
  timestamp: string;
  path: string;
  method: string;
  message: string;
  error: string;
  details?: any;
}

@Catch(QueryFailedError)
export class DatabaseExceptionFilter implements ExceptionFilter {
  private readonly logger = new Logger(DatabaseExceptionFilter.name);

  catch(exception: any, host: ArgumentsHost) {
    const ctx = host.switchToHttp();
    const response = ctx.getResponse<Response>();
    const request = ctx.getRequest<Request>();

    const errorResponse: ErrorResponse = {
      statusCode: HttpStatus.INTERNAL_SERVER_ERROR,
      timestamp: new Date().toISOString(),
      path: request.url,
      method: request.method,
      message: "Database operation failed",
      error: "Database Error",
    };

    // PostgreSQL Errors
    switch (exception.code) {
      case "23503": // Foreign key violation
        errorResponse.statusCode = HttpStatus.BAD_REQUEST;
        errorResponse.message = "Cannot perform this operation due to existing references";
        errorResponse.error = "Foreign Key Constraint";
        errorResponse.details = {
          constraint: exception.constraint,
          table: exception.table,
        };
        break;

      case "23505": // Unique violation
        errorResponse.statusCode = HttpStatus.CONFLICT;
        errorResponse.error = "Duplicate Entry";

        // Extract field from detail
        const detailMatch = exception.detail?.match(/Key \((.*?)\)=/);
        if (detailMatch) {
          errorResponse.message = `${detailMatch[1]} already exists`;
        } else {
          errorResponse.message = "This record already exists";
        }
        break;

      case "23502": // Not null violation
        errorResponse.statusCode = HttpStatus.BAD_REQUEST;
        errorResponse.message = `Field '${exception.column}' is required`;
        errorResponse.error = "Missing Required Field";
        break;

      case "22P02": // Invalid text representation
        errorResponse.statusCode = HttpStatus.BAD_REQUEST;
        errorResponse.message = "Invalid data format";
        errorResponse.error = "Invalid Input";
        break;

      case "23514": // Check constraint violation
        errorResponse.statusCode = HttpStatus.BAD_REQUEST;
        errorResponse.message = "Data validation failed";
        errorResponse.error = "Constraint Violation";
        break;
    }

    // MySQL Errors
    if (exception.errno) {
      switch (exception.errno) {
        case 1451: // Foreign key constraint
        case 1217:
          errorResponse.statusCode = HttpStatus.BAD_REQUEST;
          errorResponse.message = "Cannot delete record due to existing references";
          errorResponse.error = "Foreign Key Constraint";
          break;

        case 1062: // Duplicate entry
          errorResponse.statusCode = HttpStatus.CONFLICT;
          errorResponse.message = "This record already exists";
          errorResponse.error = "Duplicate Entry";
          break;

        case 1048: // Column cannot be null
          errorResponse.statusCode = HttpStatus.BAD_REQUEST;
          errorResponse.message = "Required field is missing";
          errorResponse.error = "Missing Required Field";
          break;

        case 1452: // Foreign key constraint fails
          errorResponse.statusCode = HttpStatus.BAD_REQUEST;
          errorResponse.message = "Referenced record does not exist";
          errorResponse.error = "Invalid Reference";
          break;
      }
    }

    // SQLite Errors
    if (exception.message) {
      if (exception.message.includes("FOREIGN KEY constraint failed")) {
        errorResponse.statusCode = HttpStatus.BAD_REQUEST;
        errorResponse.message = "Cannot perform this operation due to existing references";
        errorResponse.error = "Foreign Key Constraint";
      } else if (exception.message.includes("UNIQUE constraint failed")) {
        errorResponse.statusCode = HttpStatus.CONFLICT;
        errorResponse.message = "This record already exists";
        errorResponse.error = "Duplicate Entry";
      } else if (exception.message.includes("NOT NULL constraint failed")) {
        errorResponse.statusCode = HttpStatus.BAD_REQUEST;
        errorResponse.message = "Required field is missing";
        errorResponse.error = "Missing Required Field";
      }
    }

    // Log the error
    this.logger.error(`Database Error: ${errorResponse.error} - ${errorResponse.message}`, {
      code: exception.code,
      errno: exception.errno,
      detail: exception.detail,
      constraint: exception.constraint,
      table: exception.table,
      originalMessage: exception.message,
    });

    response.status(errorResponse.statusCode).json(errorResponse);
  }
}
```
