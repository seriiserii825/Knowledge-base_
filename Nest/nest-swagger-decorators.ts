// Install
// npm i @nestjs/swagger

// swagger.ts
import { INestApplication } from '@nestjs/common';
import { DocumentBuilder, SwaggerModule } from '@nestjs/swagger';

export function setupSwagger(app: INestApplication) {
  const config = new DocumentBuilder()
    .setTitle('API')
    .setVersion('1.0')
    .addBearerAuth()
    .build();

  SwaggerModule.setup(
    'api/docs',
    app,
    SwaggerModule.createDocument(app, config),
  );
}

// main.ts
setupSwagger(app);

// http://localhost:3000/api/docs


// DTO
import { ApiProperty } from '@nestjs/swagger';

export class UserResponseDto {
  @ApiProperty()
  id: string;

  @ApiProperty()
  email: string;
}


// Service
async findOne(id: string) {
  const user = await this.userRepository.findOne({
    where: { id },
    relations: {
      stores: true,
      favorites: true,
      orders: true,
    },
  });

  if (!user) {
    throw new NotFoundException('User not found');
  }

  return user;
}


// Controller
import {
  ApiTags,
  ApiOkResponse,
  ApiNotFoundResponse,
  ApiBearerAuth,
} from '@nestjs/swagger';

@ApiTags('users')
@Controller('users')
export class UserController {
  @Get(':id')
  @ApiOkResponse({ type: UserResponseDto })
  @ApiNotFoundResponse({ description: 'User not found' })
  findOne(@Param('id') id: string) {
    return this.userService.findOne(id);
  }
}


// Useful:
// @ApiOkResponse()          // 200
// @ApiCreatedResponse()     // 201
// @ApiNotFoundResponse()    // 404
// @ApiBearerAuth()          // JWT
// @ApiProperty()            // DTO field
// @ApiPropertyOptional()    // optional field
